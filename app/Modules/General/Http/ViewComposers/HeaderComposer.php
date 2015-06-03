<?php
namespace App\Modules\General\Http\ViewComposers;

use App\Modules\General\Http\Domain\Models\Menu;
use App\Modules\General\Http\Domain\Models\MenuLink;
use App\Modules\General\Http\Domain\Repositories\MenuRepository as MenuRepository;
use App\Modules\General\Http\Domain\Repositories\MenuLinkRepository as MenuLinkRepository;

use Illuminate\Contracts\View\View;
use Session;

class HeaderComposer {

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
		$header_id = $this->menu->getMenuID('header');
		$header = '';
		$header_items = $this->link->getLinks($header_id, $locale);
//dd($header_items);

		if ($header_items->count()) {
			$menu  = new MenuLink;
			$header_links = $this->link->getHTML($header_items, $locale);
		}
//dd($header_links);

		$view->with('header_links', $header_links);
	}


}
