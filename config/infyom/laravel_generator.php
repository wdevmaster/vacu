<?php

$module = 'Animal';

return [

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    */

    'path' => [

        'migration'         => base_path("Modules/$module/Database/Migrations/"),

        'model'             => base_path("Modules/$module/Entities/"),

        'datatables'        => base_path("Modules/$module/DataTables/"),

        'repository'        => base_path("Modules/$module/Repositories/"),

        'routes'            => base_path("Modules/$module/Routes/web.php"),

        'api_routes'        => base_path("Modules/$module/Routes/api.php"),

        'request'           => base_path("Modules/$module/Http/Requests/"),

        'api_request'       => base_path("Modules/$module/Http/Requests/"),

        'controller'        => base_path("Modules/$module/Http/Controllers/"),

        'api_controller'    => base_path("Modules/$module/Http/Controllers/"),

        'repository_test'   => base_path('tests/Repositories/'),

        'api_test'          => base_path('tests/APIs/'),

        'tests'             => base_path('tests/'),

        'views'             => resource_path('views/'),

        'schema_files'      => resource_path('model_schemas/'),

        'templates_dir'     => resource_path('infyom/infyom-generator-templates/'),

        'seeder'            => base_path('seeds/'),

        'database_seeder'   => database_path('seeds/DatabaseSeeder.php'),

        'modelJs'           => resource_path('assets/js/models/'),

        'factory'           => base_path("Modules/$module/Database/factories/"),

        'view_provider'     => app_path('Providers/ViewServiceProvider.php'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    */

    'namespace' => [

        'model'             => "Modules\\$module\\Entities",

        'datatables'        => "Modules\\$module\\DataTables",

        'repository'        => "Modules\\$module\\Repositories",

        'controller'        => "Modules\\$module\\Http\\Controllers",

        'api_controller'    => "Modules\\$module\\Http\\Controllers",

        'request'           => "Modules\\$module\\Http\\Requests",

        'api_request'       => "Modules\\$module\\Http\\Requests",

        'repository_test'   => 'Tests\Repositories',

        'api_test'          => 'Tests\APIs',

        'tests'             => 'Tests',
    ],

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    */

    'templates'         => 'adminlte-templates',

    /*
    |--------------------------------------------------------------------------
    | Model extend class
    |--------------------------------------------------------------------------
    |
    */

    'model_extend_class' => 'Eloquent',

    /*
    |--------------------------------------------------------------------------
    | API routes prefix & version
    |--------------------------------------------------------------------------
    |
    */

    'api_prefix'  => 'api',

    'api_version' => "v1/$module",

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    */

    'options' => [

        'softDelete' => false,

        'save_schema_file' => false,

        'localized' => false,

        'tables_searchable_default' => false,

        'repository_pattern' => true,

        'excluded_fields' => ['id'], // Array of columns that doesn't required while creating module
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefixes
    |--------------------------------------------------------------------------
    |
    */

    'prefixes' => [

        'route' => '',  // using admin will create route('admin.?.index') type routes

        'path' => '',

        'view' => '',  // using backend will create return view('backend.?.index') type the backend views directory

        'public' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Add-Ons
    |--------------------------------------------------------------------------
    |
    */

    'add_on' => [

        'swagger'       => true,

        'tests'         => true,

        'datatables'    => false,

        'menu'          => [

            'enabled'       => true,

            'menu_file'     => 'layouts/menu.blade.php',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Timestamp Fields
    |--------------------------------------------------------------------------
    |
    */

    'timestamps' => [

        'enabled'       => true,

        'created_at'    => 'created_at',

        'updated_at'    => 'updated_at',

        'deleted_at'    => 'deleted_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Save model files to `App/Models` when use `--prefix`. see #208
    |--------------------------------------------------------------------------
    |
    */
    'ignore_model_prefix' => false,

    /*
    |--------------------------------------------------------------------------
    | Specify custom doctrine mappings as per your need
    |--------------------------------------------------------------------------
    |
    */
    'from_table' => [

        'doctrine_mappings' => [],
    ],

];
