<?php
namespace TypiCMS\Modules\Menulinks\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class MenulinkTranslation extends BaseTranslation
{
    /**
     * get the parent model
     */
    public function menulink()
    {
        return $this->belongsTo('TypiCMS\Modules\Menulinks\Models\Menulink');
    }
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Menulinks\Models\Menulink', 'menulink_id');
    }
}
