<?php
namespace TypiCMS\Modules\Menus\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Menu extends Base
{

    use Historable;
    use Translatable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Menus\Presenters\ModulePresenter';

    protected $fillable = array(
        'name',
        'class',
        // Translatable columns
        'title',
        'status',
    );

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = array(
        'title',
        'status',
    );

    protected $appends = ['status', 'title'];

    /**
     * Relations
     */
    public function menulinks()
    {
        return $this->hasMany('TypiCMS\Modules\Menulinks\Models\Menulink')->orderBy('position', 'asc');
    }
}
