<?php
namespace TypiCMS\Modules\Menus\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('menus::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.menus.sidebar.icon', 'icon fa fa-fw fa-bars');
                $item->weight = config('typicms.menus.sidebar.weight');
                $item->route('admin.menus.index');
                $item->append('admin.menus.create');
                $item->authorize(
                    $this->auth->hasAccess('menus.index')
                );
            });
        });
    }
}
