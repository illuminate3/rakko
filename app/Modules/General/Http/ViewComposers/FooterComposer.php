<?php
namespace App\Modules\General\Http\ViewComposers;

use App\Modules\General\Http\Domain\Models\Menu;
use App\Modules\General\Http\Domain\Models\MenuLink;
use App\Modules\General\Http\Domain\Repositories\MenuRepository as MenuRepository;
use App\Modules\General\Http\Domain\Repositories\MenuLinkRepository as MenuLinkRepository;

use Illuminate\Contracts\View\View;
use Session;

class FooterComposer {

	/**
	 * The user repository implementation.
	 *
	 * @var UserRepository
	 */
	protected $menu;
	protected $link;

	/**
	 * Create a new profile composer.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(
		MenuRepository $menu,
		MenuLinkRepository $link
		)
	{
		// Dependencies automatically resolved by service container...
		$this->menu = $menu;
		$this->link = $link;
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{

		$locale = Session::get('locale');
		$footer_id = $this->menu->getMenuID('footer');
		$footer = '';
		$footer_items = $this->link->getLinks($footer_id, $locale);
//dd($footer_items);

		if ($footer_items->count()) {
			$menu  = new MenuLink;
			$footer = $this->link->getHTML($footer_items, $locale);
//dd($footer);
		}

		$view->with('footer', $footer);
//dd($view->with('footer', $footer));

	}


}
