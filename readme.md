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


## Modules
* Installer - a simple installer for Rakko
* Manager - a simple module manager
* Kagi - authentification and Authorization
* Profiles - basic profiles to extend Kagi


## Front End Requirements
* Bootstrap 3.x
* Font-Awesome 4.x
* jquery-2.x
* and more ...

These are included.


## Packages
```
"illuminate3/kotoba": "dev-master",
"caffeinated/modules": "dev-master",
"caffeinated/themes": "~1.0",
"caffeinated/flash": "dev-master",
"caffeinated/shinobi": "dev-master",
"caffeinated/menus": "~1.0@dev",
"laravel/socialite": "~2.0",
"chumper/datatable": "dev-master",
"laravelcollective/html": "~5.0",
"laracasts/presenter": "dev-master",
"yajra/laravel-datatables-oracle" : ">=v4.0.1",
"graham-campbell/throttle": "~3.0",
"intervention/image": "~2.1",
"intervention/imagecache": "~2.1"
```

These are packages that are included with Rakko.


## Easy Install

1. Down load and upload to the server
2. Run composer install
3. Create the database
4. copy paste the .env information and set to your specific server
5. go to http://name-of-your-site/install
6. log in with the login and password provided at the last screen


## Manual Install

1. Down load and upload to the server
2. Run composer install
3. Create the database
4. Copy paste the .env information and set to your specific server
5. Run the following:

a.
```
php artisan module:migrate Manager
```
b.
```
php artisan module:migrate Kagi
```
c.
```
php artisan module:seed Manager
php artisan module:seed Kagi
```
d.
```
php artisan module:migrate Profiles
php artisan module:seed Profiles
```
e.
```
php artisan module:migrate Gakko
php artisan module:seed Gakko
```


# .env file
```
APP_ENV=local
APP_DEBUG=false
APP_KEY=whatevergetsgenerated
APP_URL=http://localhost

DB_HOST=127.0.0.1
DB_DATABASE=databasename
DB_USERNAME=mysqlusername
DB_PASSWORD=mysqlpassword

EMAIL_HOST=localhost
EMAIL_PORT=1025
EMAIL_FROM_ADDRESS=email@email.com
EMAIL_FROM_NAME=fromname
EMAIL_ENCRYPTION=null

GITHUB_CLIENT_ID=githubid
GITHUB_CLIENT_SECRET=githubsecret
GOOGLE_CLIENT_ID=thatreallylonggoogleclientid
GOOGLE_CLIENT_SECRET=nosolongsecret


CACHE_DRIVER=file
SESSION_DRIVER=file
```

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
