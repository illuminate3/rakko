<?php
namespace App\Modules\Shisan\Http\Controllers;


use dflydev\markdown\MarkdownParser;

class CategoriesController extends ShisanController {

	protected $layout = 'layouts.backend';

	/**
	 * The category storage.
	 *
	 * @var  Category
	 */
	protected $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = $this->category->withDepth()->defaultOrder()->get();

        $this->layout
        	->withTitle('Manage Categories')
        	->nest('content', 'categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$parents = $this->getParents();

        $this->layout
        	->withTitle('Create a category')
        	->nest('content', 'categories.create', compact('parents'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = $this->category->preprocessData(Input::all());

		$category = new Category($data);

		if (($messages = $category->validate()) === true)
		{
			if ($category->save())
			{
				return Redirect::route('categories.index')->withSuccess('The category has been created!');
			}

			return Redirect::route('categories.create')
				->withError('Something went wrong while saving the category.')
				->withInput($data);
		}

		return Redirect::route('categories.create')->withInput($data)->withErrors($messages);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = $this->category->findOrFail($id);
		$parents = $this->getParents();

        $this->layout
        	->withTitle('Update '.$category->title)
        	->nest('content', 'categories.edit', compact('category', 'parents'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = $this->category->findOrFail($id);

		$data = $this->category->preprocessData(Input::all());

		try
		{
			$category->fill($data);
		}
		catch (Exception $e)
		{
			return Redirect::route('categories.edit', array($id))
				->withInput()
				->withError($e->getMessage());
		}

		if (($messages = $category->validate()) === true)
		{
			if ($category->save())
			{
				$response = Input::has('save')
					? Redirect::route('categories.index')
					: Redirect::route('categories.edit', array($id));

				return $response->withSuccess('The category has been updated!');
			}

			return Redirect::route('categories.edit', array($id))
				->withInput()
				->withError('Could not save the category.');
		}

		return Redirect::route('categories.edit', array($id))
			->withInput($data)
			->withErrors($messages);
	}

	/**
	 * Display destroy confirmation.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function confirm($id)
	{
		$category = $this->category->findOrFail($id);

		$message = "Are you shure to destroy {$category->title}?";

		if ($category->getDescendantCount())
		{
			$message .= " All descendants will also be destroyed!";
		}

		$this->layout
			->withTitle('Confirm destroy')
			->nest('content', 'categories.confirm', compact('message', 'category'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = $this->category->findOrFail($id);

		$response = Redirect::route('categories.index');

		if ($category->delete())
		{
			$response->withSuccess('The category has been destroyed!');
		}
		else
		{
			$response->withWarning('The category was not destroyed.');
		}

		return $response;
	}

	/**
	 * Move the specified category up.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function up($id)
	{
		return $this->move($id, 'before');
	}

	/**
	 * Move the specified category down.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function down($id)
	{
		return $this->move($id, 'after');
	}

	/**
	 * Move the category.
	 *
	 * @param  int $id
	 * @param  'before'|'after' $dir
	 *
	 * @return Response
	 */
	protected function move($id, $dir)
	{
		$category = $this->category->findOrFail($id);
		$response = Redirect::route('categories.index');

		$sibling = $dir === 'before' ? $category->getPrevSibling() : $category->getNextSibling();

		if ($sibling)
		{
			$category->$dir($sibling)->save();

			if ($category->hasMoved())
			{
				return $response->withSuccess('The category has been successfully moved!');
			}
		}

		return $response->withWarning('The category did not move.');
	}

	/**
	 * Export categories.
	 *
	 * @return Response
	 */
	public function export()
	{
		$exporter = App::make('CategoriesExporter');
		$path = storage_path('tmp/categories.tmp');

		if ($exporter->export($path))
		{
			$headers = array('Content-Type' => $exporter->getMimeType());
			$fileName = 'categories.'.$exporter->getExtension();

			return Response::download($path, $fileName, $headers);
		}

		return Redirect::route('categories.index')->withError('Failed to export categories.');
	}

	/**
	 * Get all available nodes as a list for HTML::select.
	 *
	 * @return array
	 */
	protected function getParents()
	{
		$all = $this->category->select('id', 'title')->withDepth()->defaultOrder()->get();
		$result = array();

		foreach ($all as $item)
		{
			$title = $item->title;

			if ($item->depth > 0) $title = str_repeat('—', $item->depth).' '.$title;

			$result[$item->id] = $title;
		}

		return $result;
	}
}
