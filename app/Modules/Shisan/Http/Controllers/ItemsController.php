<?php
namespace App\Modules\Shisan\Http\Controllers;


//use Datatable;
//use Bootstrap;

class ItemsController extends ShisanController {

	/**
	 * Item Repository
	 *
	 * @var Item
	 */
	protected $item;

	public function __construct(Item $item, Category $category)
	{
		$this->item = $item;
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = $this->item->all();
//		$items = $items->with('categories');
//dd($items);


		return View::make('items.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$parents = $this->getParents();

//		return View::make('items.create');
		return View::make('items.create', compact('parents'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
//		$input = Input::all();
		$input = array_except(Input::all(), '_method');
//dd($input);

		$validation = Validator::make($input, Item::$rules);

		if ($validation->passes())
		{
			$this->item->create($input);


$id = DB::getPdo()->lastInsertId();
$category_id = Input::get('category_id');
$this->item->attachItem($id, $category_id);


			return Redirect::route('items.index');
		}

		return Redirect::route('items.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = $this->item->findOrFail($id);

$assets = Item::findOrFail($item->id)->assets;
//dd($assets);

		return View::make('items.show', compact('item', 'assets'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = $this->item->find($id);

$category = $this->category->findOrFail($id);
$parents = $this->category->getParents();

/*
$this->layout
->withTitle('Update '.$category->title)
->nest('content', 'categories.edit', compact('category', 'parents'));
*/

		if (is_null($item))
		{
			return Redirect::route('items.index');
		}

		return View::make('items.edit',
			compact('item', 'category', 'parents'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
//		$input = array_except(Input::all(), '_method');
		$input = array_except(Input::all(), ['_method']);
//dd($input);


		$validation = Validator::make($input, Item::$rules);

//dd($input);

		if ($validation->passes())
		{
			$item = $this->item->find($id);
			$item->update($input);

//$product = $id;
//$product->categories()->attach(Input::get('parent_id'));

//Item::find($id)->categories()->attach( Input::get('parent_id') );

//$customer = Item::find($id);
//$customer->categories()->attach(Input::get('parent_id'));

$category_id = Input::get('category_id');
$this->item->detachItem($id, $category_id);
$this->item->attachItem($id, $category_id);


/*
			$bill = Bill::find($bill_id);

			$charges = Charge::where('bill_id', '=', $bill_id)->get();
			foreach($charges as $key => $value)
			{
				$charges[$key]['status_pick_id'] = 1;
			}
			foreach($charges as $charge)
			{
				$bill->charges()->attach($charge); //this executes the insert-query
			}
*/

			return Redirect::route('items.show', $id);
		}

		return Redirect::route('items.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->item->find($id)->delete();

		return Redirect::route('items.index');
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

	/**
	 * @return mixed
	 */
	public function getDatatable()
	{
//dd('loaded');

/*
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `make` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',*/

/*
		return Datatable::collection(
//			Item::all()
			Item::remember(10)->get()
		)
*/
		$query = DB::table('items')->remember(10);
//dd($query);
		return Datatable::query($query)

/*
			->showColumns('id')

			->addColumn('make',
				function($model) {
					return $model->make;
				})

			->addColumn('model',
				function($model) {
					return $model->model;
				})

			->addColumn('model_number',
				function($model) {
					return $model->model_number;
				})

			->addColumn(
				'category_id',
				function($model) {
					return $model->category_id;
				})

			->addColumn('description',
				function($model) {
					return $model->description;
				})

			->addColumn('image',
				function($model) {
//					return $model->present()->status($model->status);
					return $model->image;
				})

*/
			->showColumns('id', 'make', 'model', 'model_number', 'category_id', 'description', 'image')

			->addColumn('actions',
				function($model) {

				$modal =
					'<div class="modal fade" id="delete-Record-'.$model->id.'">
						'.Form::open(array("route" => array("items.destroy", $model->id), "method" => "delete")).'
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . trans('lingos::general.close') . '</span></button>
										<h4 class="modal-title">' . trans('lingos::account.ask.delete') . '</h4>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">' . trans('lingos::button.no') . '</button>
										<button type="submit" class="btn btn-success" name="deleteRecord">' . trans('lingos::button.yes') . '</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						'.Form::close().'
					</div><!-- /.modal -->';
				return
					'<a href="/items/' . $model->id . '" class="btn btn-primary form-group" title="' . trans('lingos::general.view') . '"><i class="fa fa-chevron-right fa-fw"></i>' . trans('lingos::button.view') . '</a>&nbsp;'
					. '<a href="/items/' . $model->id . '/edit" class="btn btn-success form-group" title="' . trans('lingos::account.command.edit') . '"><i class="fa fa-edit fa-fw"></i>' . trans('lingos::button.edit') . '</a>&nbsp;'
					. Form::button('<span class="glyphicon glyphicon-trash"></span> ' . trans('lingos::button.delete'), array('name'=>'deleteRecord', 'class' => 'btn btn-danger', 'type' => 'button',  'data-toggle' => 'modal', 'data-target' => '#delete-Record-'.$model->id))
					. $modal;
				})

			->searchColumns('category_id', 'make', 'model', 'model_number', 'description')
			->orderColumns('id', 'category_id', 'make', 'model', 'model_number', 'description', 'image')

			->make();
	}


}
