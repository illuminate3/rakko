<?php
namespace TypiCMS\Modules\Menulinks\Presenters;

use TypiCMS\Modules\Core\Presenters\Presenter;

class ModulePresenter extends Presenter
{

    public function menuclass()
    {
        return $this->entity->menuclass;
    }
}
