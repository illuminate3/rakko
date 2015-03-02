<?php
namespace App\Modules\Shisan\Http\Domain\Repositories;

class CategoryRepository extends \Kalnoy\Nestedset\Node {

	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Domain\Models\Module
	 */
	protected $department;

	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Domain\Models\Module $module
	 * @return void
	 */
	public function __construct(
		Department $department
		)
	{
		$this->model = $department;
	}

	/**
	 * Get role collection.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function create()
	{
//		$allPermissions =  $this->permission->all()->lists('name', 'id');
//dd($allPermissions);

		return compact('');
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$department = $this->model->find($id);
//dd($module);

		return compact('department');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$department = $this->model->find($id);
//dd($module);

		return compact('department');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new Department;
		$this->model->create($input);
	}

	/**
	 * Update a role.
	 *
	 * @param  array  $inputs
	 * @param  int    $id
	 * @return void
	 */
	public function update($input, $id)
	{
//dd($input['enabled']);
		$department = Department::find($id);
		$department->update($input);
	}


// Functions --------------------------------------------------

    /**
     * Apply some processing for an input.
     *
     * @param  array  $data
     *
     * @return array
     */
    public function preprocessData(array $data)
    {
        if (isset($data['slug'])) $data['slug'] = strtolower($data['slug']);

        return $data;
    }

    /**
     * Perform validation.
     *
     * @return \Illuminate\Support\MessageBag|true
     */
    public function validate()
    {
        $v = Validator::make($this->attributes, $this->getRules());

        return $v->fails() ? $v->messages() : true;
    }

    /**
     * Get validation rules.
     *
     * @return array
     */
    public function getRules()
    {
        $rules = array(
            'title' => 'required',

            'slug'  => array(
                'required',
                'regex:#^'.self::$slugPattern.'$#',
                'unique:categories'.($this->exists ? ',slug,'.$this->id : ''),
            ),

//            'body'  => 'required',
        );

        if ($this->exists && ! $this->isRoot())
        {
            $rules['parent_id'] = 'required|exists:categories,id';
        }

        return $rules;
    }

    /**
     * Get the contents.
     *
     * @return \Kalnoy\Nestedset\Collection
     */
    public function getContents()
    {
        // The source of contents is the top category not including the root.
        $source = $this->parent_id == 1
            ? $this
            : $this->ancestors()->withoutRoot()->first();

        $contents = $source
            ->descendants()
            ->defaultOrder()
            ->get([ 'id', 'slug', 'title', static::LFT, 'parent_id' ])
            ->toTree();

        return $contents;
    }

    /**
     * Get the category that is immediately after current category following the contents.
     *
     * @param array $columns
     *
     * @return Category|null
     */
    public function getNext(array $columns = array('slug', 'title', 'parent_id'))
    {
        $result = parent::getNext($columns);

        return $result && $result->parent_id == 1 ? null : $result;
    }

    /**
     * Get the category that is immediately before current category following the contents.
     *
     * @param array $columns
     *
     * @return Category|null
     */
    public function getPrev(array $columns = array('slug', 'title', 'parent_id'))
    {
        if ($this->isRoot() || $this->parent_id == 1) return null;

        $result = parent::getPrev($columns);

        return $result && $result->parent_id == 1 ? null : $result;
    }

    /**
     * Get url for navigation.
     *
     * @return  string
     */
    public function getNavUrl()
    {
        return URL::route('category', array($this->attributes['slug']));
    }

    /**
     * Get navigation item label.
     *
     * @return  string
     */
    public function getNavLabel()
    {
        return $this->title;
    }

}
