#Catch


##Setup

- Copy config/app.default.php to config/app.php
- Edit config/app.php
	- Edit CakePHP basic stuff like Database
	- Edit DealsGuru configs:

````
'disco' => [
	/* SellerUuid*/
	'UUID' => [
		'mode' => 'live',
		'ebay' => [
			'live_account_id' => '1',
			'sandbox_account_id' => '2'
		],
		'braintree' => [
			'mode' => 'production',
			'sandbox' => [
				'merchant_id' => '',
				'public_key' => '',
				'private_key' => ''
			],
			'production' => [
				'merchant_id' => '',
				'public_key' => '',
				'private_key' => ''
			]
		]
	]
],
'dealsguru' => [
	'mode' => 'live',
	'ebay' => [
		'live_account_id' => '1',
		'sandbox_account_id' => '2'
	],
	'uuid' => 'UUID',
	'cache' => [
		'product' => 'feeder_product_cache',
		'browse' => 'feeder_browse_cache',
	],
	'static' => [
	    'min' => false
	]
],
'ebayCheckout' => [
	'theme' => 'MightyGuru',
	'cart' => '0',
	'enable_checkout' => 1,
	'new_tab' => 0
],
'google_cloud' => [
    'cloud_storage' => [
        'is_active' => true,
        'bucket_name' => 'wunsch-upload'
    ]
],
'eis'=> [
        'token' => 'ASK_VALERI'
]
````

and add following cache configurations:

````
'feeder_browse_cache' => [
    'className' => 'File',
    'prefix' => 'feeder_browse_cache_',
    'serialize' => true,
    'path' => CACHE . 'persistent' . DS,
    'duration' => '+1 hour',
    'host' => null,
    'port' => null
],
'feeder_product_cache' => [
    'className' => 'File',
    'prefix' => 'feeder_product_cache_',
    'serialize' => true,
    'path' => CACHE . 'persistent' . DS,
    'duration' => '+1 hour',
    'host' => null,
    'port' => null
],
````

- Run composer update to setup your database structure
- Create a core seller and user with _bin/cake_
	- bin/cake create_seller_and_default_user seller_name language country email password
	- Example: bin/cake create_seller_and_default_user ExampleSeller de de seller@example.de password
- Login /core_users/login
- Go to /core_sellers and view your core_seller to get your UUID (or check correspondent DB table)
- Edit your config/app.php and enter your UUID
	- disco --> UUID and dealsguru --> uuid --> UUID
- Create your checkout
	- Go to /checkout/ebay-checkouts/add
	- Choose your core_seller and enter a name -> Save
- Create Feeder categories
	- Go to /feeder/feeder-categories
	- Create categories as you wish

# Development
## Add static assets with min
*Work in progress/Needs refactor*

```
$this->Html->css('Feeder.product' . STATIC_MIN, ['block' => true]);
$this->Html->script('Feeder.product' . STATIC_MIN, ['block' => true]);
```

STATIC_MIN will add .min if config dealsguru.static.min is set to true.

## Build plugins assets
CSS and JS can be build/minified with grunt.

### Mac OS Quick Tour

````
cd plugins/MightyGuru
sudo npm install -g grunt-cli
npm install
sudo gem install sass
````
Everything should work.
Run grunt to test and grunt watch to develop.

### Install if not Mac OS X

#### Npm install
https://www.npmjs.com/get-npm

#### Grunt install
https://gruntjs.com/installing-grunt

#### Grunt Dependency
For Grunt to work you need to also install Sass and Ruby

Sass: https://sass-lang.com/install

Ruby: https://www.ruby-lang.org/en/documentation/installation/

#### Npm init project
cd plugins/MightyGuru
npm install


### Build
To build during development
```
# ROOT DIR
cd plugins/MightyGuru
grunt watch
```

grunt watch will check for edited files and will rebuild them on the fly.

CSS and JS ist build in each plugin directory. To see changes during development run:

## Bootstrap
Es wurde alles von bootstrap rausgeworfen was nicht gebraucht wird und die Breakpoints wurden angepasst.

Bootstrap wird jetzt auch durch grunt gebaut und die bootstrap.scss Dateien sind unter plugins/Catch/webroot/css/src/bootstrap zu finden


Breakpoints lauten:
$grid-breakpoints: (
  xs: 0,
  sm: 480px,
  md: 768px,
  lg: 1024px,
  xl: 1400px
) !default;
Containerbreiten lauten:
$container-max-widths: (
  sm: 480px,
  md: 768px,
  lg: 994px,
  xl: 1370px
) !default;

Falls die erste Person beim Umsetzen feststellt, dass sie so nicht passen bitte einfach in der Datei: plugins/Catch/webroot/css/src/bootstrap/_variables.scss die Werte anpassen
Es wird dann automatisch übernommen.

````
bin/cake assets remove
````

## React

Der React Folder befindet sich unter plugins/CatchTheme/react. Zunächst müssen die Abhängigkeiten installiert werden:
```
npm install
```
Während der Entwicklung muss webpack laufen:
```
npm start
```

### Adding new plugins to grunt

```
#File: plugins/MightyGuru/Gruntfile.js

# Add plugin to dev and prod
        sass: {
            dev: {
                options: {
                    style: 'expanded',
                    lineNumbers: true,
                    trace: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'webroot/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/css',
                        ext: '.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/feeder/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/feeder/css',
                        ext: '.css'
                    }/*,
                    {
                        expand: true,
                        cwd: 'webroot/ebay_checkout/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/ebay_checkout/css',
                        ext: '.css'
                    }*/
                ]
            },
            prod: {
                options: {
                    style: 'compressed'
                },
                files: [
                    {
                        expand: true,
                        cwd: 'webroot/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/css',
                        ext: '.min.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/feeder/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/feeder/css',
                        ext: '.min.css'
                    }/*,
                    {
                        expand: true,
                        cwd: 'webroot/ebay_checkout/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/ebay_checkout/css',
                        ext: '.min.css'
                    }*/
                ]
            }

# Add JS minify to files
        uglify: {
            options: {
                compress: {
                    drop_console: true
                },
                mangle: false,
            },
            prod: {
                files: {
                    'webroot/ebay_checkout/js/main.min.js': [
                        'webroot/ebay_checkout/js/main.js'
                    ],
                    'webroot/feeder/js/product.min.js': [
                        'webroot/feeder/js/product.js'
                    ]
                }
            }
        },
```
# Wunsch branch working branch from master:

- go to branch master
    git checkout master

- make new branch and change to it:
    git checkout -b 'master_WD-123_describe-what you-do'

- delete vendor directory and run
    composer install --no-scripts
    composer run-script post-update-cmd

- now your working branch is ready


# Wunsch merge working branch to dev:
## Build assets
- build webroot files in working branch:
        bin/cake assets build

    - git status

    - add files for staging:
        git add {file name}

    - and commit them
        git commit -m '{comment}'

    - upload assets
        git push

## Change to dev branch:
    git checkout dev

- and refresh:
    git pull

- merge your working branch:
    git merge {my_branch_name}

- resolve conflicts:
    - conflicts in .css or .js:
        change to directory plugins/MightyGuru:
            cd plugins/MightyGuru
        and run Grunt:
            grunt
        go back to dev:
            cd ../..
    - conflicts in other files (i.e. myfile.ctp):
        resolve conflicts by checking diffs manually

    - get status:
        git status

    - add files for staging:
        git add {file name}

        repeat until all files are staged and check it with:

        git status


    - if all files are staged commit them:
        git commit -m '{comment}'

    - and upload:
        git push


auto deploy on dev every 5 minutes: https://wunsch-dev.i-ways-network.org/ (deals/monk)


# Production
## Build assets
```
cd plugins/MightyGuru/ && grunt prod && cd ../../ && bin/cake assets build
```

## Deploy
cd plugins/MightyGuru/ && grunt && cd ../../ && bin/cake assets build
gcloud app deploy app.yaml cron.yaml

No Promote:
gcloud app deploy --no-promote --verbosity=info

gcloud app deploy app.yaml cron.yaml --no-promote --verbosity=info

## Running migrations
/migrate.php?securitas=v3rys3cUre

Running migrations and clears cache:
/migrate.php?securitas=v3rys3cUre&cache=clear


wunsch merge Branch mit dev:

- nach dev wechseln:
    git checkout dev

- und aktualisieren:
    git pull

- merge den eigenen Branch:
    git merge {my_branch_name}

- Konflikte beheben:
    - Konflikte in .css oder min.js:
        in den Ordner MightyGuru wechseln
            cd plugins/MightyGuru
        und Grunt ausführen
            grunt
        zurück in den Hauptordner wechseln
            cd ../..
    - Konflikte in anderen Dateien (z.B. .ctp):
        Konflikte von Hand lösen

    - Status abrufen
        git status

    - rot markierte Dateien:
        git add {Dateiname}

        wiederholen bis alle hinzugefügt sind und mit

        git status

        überprüfen

    - alle Dateien grün markiert:
        git commit -m '{Kommentar}'

    - Dateien neu bauen:
        bin/cake assets build

    - Alles hochladen
        git push

 - Dateien neu bauen:
        bin/cake assets build

    - rot markierte Dateien:
        git add {Dateiname}
        git commit -m '{Kommentar}'

    - assets hochladen
        git push

Änderungen werden alle 5 deployed: https://wunsch-dev.i-ways-network.org/ (deals/monk)
