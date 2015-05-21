# Rakko

> Rakko | ラッコ | 'rah-ck-oh'
> noun
> Japanese for Sea Otter
> Rakko is the name of a river in Hokkaido, Japan. ( http://ja.wikipedia.org/wiki/楽古川 )



## About
Rakko is the start of a platform to be used with Laravel 5.
At the moment, however, Rakko is more of a bootstrap starter kit than a platform.


Rakko essentially uses translations based on the Kotoba package that is listed in composer.json.
However, full multilingual ability still needs to be implemented.



## Version
1.0.0
Will move to full 1.0 after more testing and finalizing the core modules that are included.

BETA NOTICE!
This is still beta since I haven't had a full chance to vet the full application.
I am also planning to add tests to ensure quality.
However, even with tests things still break due to the nature of programing.
I do use this as my base code on a daily basis so expect progression and vetting.



## Screen Shots

![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/welcome.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/installer.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/main_page.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/multi_lingual.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/social_login.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/admin_dash.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/modules.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/themes.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/users.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/user_info.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/edit_user.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/edit_role.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/permissions.png)
![alt tag](https://raw.github.com/illuminate3/rakko/master/public/images/screenshots/profile.png)



## Modules (included)
* Installer - a simple installer for Rakko
* Manager - a simple module manager
* Kagi - authentification and Authorization
* Profiles - basic profiles to extend Kagi



## Modules (to add)
* Kantoku - a simple Module Manager for Rakko
* Origami - a simple Theme Manager for Rakko


## Front End Requirements
* Bootstrap 3.x
* Font-Awesome 4.x
* jquery-2.x
* and more ...

These are included.


## Packages
```
"laravel/framework": "5.0.*",
"illuminate3/kotoba": "dev-master",
"caffeinated/modules": "dev-master",
"caffeinated/themes": "~1.2",
"caffeinated/flash": "dev-master",
"caffeinated/shinobi": "dev-master",
"caffeinated/menus": "~1.0",
"caffeinated/plugins": "dev-master",
"laravel/socialite": "~2.0",
"laravelcollective/html": "~5.0",
"laracasts/presenter": "dev-master",
"yajra/laravel-datatables-oracle" : "~4.0",
"graham-campbell/throttle": "~3.0",
"intervention/image": "~2.1",
"intervention/imagecache": "~2.1",
"wikimedia/composer-merge-plugin": "~1.0",
"kalnoy/nestedset": "dev-master",
"arrilot/laravel-widgets": "~2.2"
```

These are packages that are included with Rakko.



## Manual Install

1. Down load and upload to server
2. Run composer install
3. Create the database
4. Edit .env file
```
APP_ENV=local
APP_DEBUG=false
APP_KEY=whatevergetsgenerated
APP_URL=http://localhost

DB_HOST=127.0.0.1
DB_DATABASE=databasename
DB_USERNAME=mysqlusername
DB_PASSWORD=mysqlpassword

CACHE_DRIVER=file
SESSION_DRIVER=file

EMAIL_HOST=localhost
EMAIL_PORT=1025
EMAIL_FROM_ADDRESS=
EMAIL_FROM_NAME=
EMAIL_ENCRYPTION=NULL

GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT=http://www.site.com/social/login

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT=http://www.site.com/social/login

STRIPE_MODEL=User
STRIPE_SECRET=
```
5. download and upload the modules below
```
https://github.com/illuminate3/kantoku

https://github.com/illuminate3/origami
```

Just download these, upload to the modules directory, and unzip.

6. Run the following:

a.
```
php artisan module:migrate Kagi
php artisan module:seed Kagi
```
b.
```
php artisan module:migrate Profiles
php artisan module:seed Profiles
```
c.
```
php artisan module:migrate General
php artisan module:seed General
```
d.
```
php artisan module:seed Kantoku
```
e.
```
php artisan module:seed Origami
```

6. login at http://yoursite/auth/login
	login:		admin@admin.com
	password:	kagiadmin

	login:		user@user.com
	password:	kagiuser



## Easy Install [still testing, installer may timeout or just stall before running migrations]

1. Down load and upload to server
2. Run composer install
3. Create the database
4. copy paste the .env information and set to your specific server (provide below)
5. go to http://name-of-your-site/install
6. log in with the login and password provided at the last screen


* This might fail since the installer is actually still in development.



# module publish command
```
vendor:publish --provider="App\Modules\ModuleName\Providers\ModuleNameServiceProvider"
```
The config files for each module has the vendor:publish code included.



# Future
- [ ] website
- [ ] demo site or video
- [ ] clean up code
- [ ] fix deletes in the modules



# Coding Standards
I've been trying my best to confirm ro PSR-0-4 standards.

However, you will note that I do use tabs. I'm addicted to them since I use BBEdit. Also,
because, I've spent years of dealing with code that is mixed tabs and spaces.
I will not go into the horrors of line endings or file encoding.

Want me to kick my addiction to tabs, well, yeah, try.
I promise you that it'll take more than a few beers!



## Mentions
A very special thanks and arigatou! to Kai over at ( https://github.com/caffeinated )
Thanks for your patience and help!

I also should mention the 2 starter kits for L4. Without them I would never have gotten this far with Laravel.

Also, to Laravel. Besides being a "y'all" know a killer framework from Arkansas,
but also for making me have to drive on the opposite side of the road again ... or if you rather say,
the correct side of the road.



# License
The MIT License (MIT)

Because I'm a rebel at heart ...
