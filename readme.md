## Install

First, add the lines below in composer.json file:

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/brgomes/laravel-datatable"
        }
    ]

After, run composer install command:

    composer require brgomes/laravel-datatable

## Using

Register the package in app/config.php file. Add the line blow in providers section:

    Brgomes\LaravelDatatable\DatatableServiceProvider::class,

Add the lines below in webpack.mix.js file:

    .css('vendor/brgomes/laravel-datatable/resources/assets/datatable.css', 'public/assets/datatable')
    .js('vendor/brgomes/laravel-datatable/resources/assets/datatable.js', 'public/assets/datatable')

To call the files:

    mix('assets/datatable/datatable.css')
    mix('assets/datatable/datatable.js')

## Create Datatable files

    php artisan make:datatable <name>
