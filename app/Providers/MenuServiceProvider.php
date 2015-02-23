<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Auth;
use Menu;

class MenuServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Menu::make('public', function($menu) {
			$menu->add('Rakko', 'welcome/kagi');
			$menu->add('Profiles', 'profiles');
			$menu->add('Module Manager', 'module_manager');
// 			$menu->add('View Profile', 'profiles/'.Auth::user()->id);
// 			$menu->add('view profile', 'profiles'. Auth::user()->id );
		});
	}


/*
    $menu->add('Home');
    $menu->add('About', 'about');
$menu->about->add('Who We are', 'who-we-are')
             ->add('Level2', 'link address')
                  ->add('level3', 'Link address')
                       ->add('level4', 'Link address');
//$menu->add('Level2', array('url' => 'Link address', 'parent' => $menu->about->id));

    $menu->add('Contact', 'contact');
*/

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
//
	}



}
