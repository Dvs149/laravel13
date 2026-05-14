<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveModule extends Command
{
    // This command will remove all files related to a module, including:
    // Model
    // Migration
    // Controller
    // Requests
    // Service
    // Repository
    // Views
    protected $signature = 'remove:module {name}';

    protected $description = 'Remove complete module structure';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        /*
        |--------------------------------------------------------------------------
        | Remove Model
        |--------------------------------------------------------------------------
        */

        $this->deleteFile(
            app_path("Models/{$name}.php")
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Controller
        |--------------------------------------------------------------------------
        */

        $this->deleteFile(
            app_path("Http/Controllers/{$name}Controller.php")
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Requests
        |--------------------------------------------------------------------------
        */

        $this->deleteFile(
            app_path("Http/Requests/Store{$name}Request.php")
        );

        $this->deleteFile(
            app_path("Http/Requests/Update{$name}Request.php")
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Service
        |--------------------------------------------------------------------------
        */

        $this->deleteFile(
            app_path("Services/{$name}Service.php")
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Repository
        |--------------------------------------------------------------------------
        */

        $this->deleteFile(
            app_path("Repositories/{$name}Repository.php")
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Views
        |--------------------------------------------------------------------------
        */

        $viewPath = resource_path(
            'views/admin/' . strtolower($name)
        );

        if (File::exists($viewPath)) {

            File::deleteDirectory($viewPath);

            $this->info("Deleted Views Folder");
        }

        /*
        |--------------------------------------------------------------------------
        | Remove Migration
        |--------------------------------------------------------------------------
        */

        $migrationPath = database_path('migrations');

        $files = File::files($migrationPath);

        foreach ($files as $file) {

            if (
                str_contains(
                    $file->getFilename(),
                    'create_' . strtolower($name) . 's_table'
                )
            ) {

                File::delete($file);

                $this->info(
                    'Deleted Migration: ' .
                    $file->getFilename()
                );
            }
        }

        $this->info("{$name} module removed successfully.");
    }

    /*
    |--------------------------------------------------------------------------
    | Delete File Helper
    |--------------------------------------------------------------------------
    */

    private function deleteFile($path)
    {
        if (File::exists($path)) {

            File::delete($path);

            $this->info("Deleted: {$path}");
        }
    }
}