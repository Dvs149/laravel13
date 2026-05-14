<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    // This command will create a complete module structure, including:
    // Model
    // Migration
    // Controller
    // Requests
    // Service
    // Repository
    // Views
    protected $signature = 'make:module {name}';

    protected $description = 'Create complete module structure';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        /*
        |--------------------------------------------------------------------------
        | Create Model + Migration
        |--------------------------------------------------------------------------
        */

        $this->call('make:model', [
            'name' => $name,
            '-m'   => true
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Resource Controller
        |--------------------------------------------------------------------------
        */

        $this->call('make:controller', [
            'name'       => $name . 'Controller',
            '--resource' => true,
            '--model'    => $name
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Form Requests
        |--------------------------------------------------------------------------
        */

        $this->call('make:request', [
            'name' => 'Store' . $name . 'Request'
        ]);

        $this->call('make:request', [
            'name' => 'Update' . $name . 'Request'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Service Folder
        |--------------------------------------------------------------------------
        */

        if (!File::exists(app_path('Services'))) {

            File::makeDirectory(
                app_path('Services'),
                0755,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Repository Folder
        |--------------------------------------------------------------------------
        */

        if (!File::exists(app_path('Repositories'))) {

            File::makeDirectory(
                app_path('Repositories'),
                0755,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Service
        |--------------------------------------------------------------------------
        */

        File::put(
            app_path("Services/{$name}Service.php"),
            $this->serviceTemplate($name)
        );

        /*
        |--------------------------------------------------------------------------
        | Create Repository
        |--------------------------------------------------------------------------
        */

        File::put(
            app_path("Repositories/{$name}Repository.php"),
            $this->repositoryTemplate($name)
        );

        /*
        |--------------------------------------------------------------------------
        | Create Views
        |--------------------------------------------------------------------------
        */

        $viewPath = resource_path(
            'views/admin/' . strtolower($name)
        );

        if (!File::exists($viewPath)) {

            File::makeDirectory(
                $viewPath,
                0755,
                true
            );
        }

        File::put(
            $viewPath . '/index.blade.php',
            "@extends('admin.partials.admin_layout')

@section('content')

<h1>{$name} Index</h1>

@endsection"
        );

        File::put(
            $viewPath . '/create.blade.php',
            "@extends('admin.partials.admin_layout')

@section('content')

<h1>Create {$name}</h1>

@endsection"
        );

        File::put(
            $viewPath . '/edit.blade.php',
            "@extends('admin.partials.admin_layout')

@section('content')

<h1>Edit {$name}</h1>

@endsection"
        );

        $this->info("{$name} module created successfully.");
    }

    /*
    |--------------------------------------------------------------------------
    | Service Template
    |--------------------------------------------------------------------------
    */

    private function serviceTemplate($name)
    {
        return "<?php

namespace App\Services;

class {$name}Service
{

}
";
    }

    /*
    |--------------------------------------------------------------------------
    | Repository Template
    |--------------------------------------------------------------------------
    */

    private function repositoryTemplate($name)
    {
        return "<?php

namespace App\Repositories;

class {$name}Repository
{

}
";
    }
}