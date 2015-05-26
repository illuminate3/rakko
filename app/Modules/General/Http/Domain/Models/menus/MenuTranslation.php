<?php
namespace TypiCMS\Modules\Menus\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class MenuTranslation extends BaseTranslation
{
    /**
     * get the parent model
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Menus\Models\Menu', 'menu_id');
    }
}
