<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Category extends \Kalnoy\Nestedset\Node {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	protected $presenter = 'App\Modules\Gakko\Http\Presenters\Site';

    /**
     * The set of characters for testing slugs.
     *
     * @var  string
     */
    public static $slugPattern = '[a-z0-9\-/]+';

	protected $fillable = array('slug', 'title', 'parent_id');

    protected $visible = array('title', 'slug', 'children');

// DEFINE Relationships --------------------------------------------------

public function items()
{
	return $this->belongsToMany('Item', 'category_item', 'category_id', 'item_id');
}

/*
public function items()
{
	return $this->belongsToMany('Item');
}
public function assets()
{
	return $this->hasManyThrough('Asset', 'Item');
}
*/


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
