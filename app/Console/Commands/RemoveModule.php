<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RemoveModule extends Command
{
    /*
    |--------------------------------------------------------------------------
    | Command Signature
    |--------------------------------------------------------------------------
    */

    protected $signature = 'remove:module {name}';

    protected $description = 'Remove complete module structure';

    /*
    |--------------------------------------------------------------------------
    | Handle Command
    |--------------------------------------------------------------------------
    */

    public function handle()
    {
        $name = Str::studly(
            $this->argument('name')
        );

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
            app_path(
                "Http/Controllers/{$name}Controller.php"
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Requests
        |--------------------------------------------------------------------------
        */

        $this->deleteFile(
            app_path(
                "Http/Requests/Store{$name}Request.php"
            )
        );

        $this->deleteFile(
            app_path(
                "Http/Requests/Update{$name}Request.php"
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Service
        |--------------------------------------------------------------------------
        */

        $this->deleteFile(
            app_path(
                "Services/{$name}Service.php"
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Repository
        |--------------------------------------------------------------------------
        */

        $this->deleteFile(
            app_path(
                "Repositories/{$name}Repository.php"
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Views
        |--------------------------------------------------------------------------
        */

        // make:module creates:
        // resources/views/admin/customer

        $viewFolder = Str::lower($name);

        $viewPath = resource_path(
            "views/admin/{$viewFolder}"
        );

        if (File::exists($viewPath)) {

            File::deleteDirectory($viewPath);

            $this->info(
                "Deleted Views Folder: {$viewPath}"
            );
        } else {

            $this->warn(
                "Views Folder Not Found: {$viewPath}"
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Remove Migration
        |--------------------------------------------------------------------------
        */

        $migrationPath = database_path(
            'migrations'
        );

        $files = File::files($migrationPath);

        $tableName = Str::snake(
            Str::pluralStudly($name)
        );

        $migrationFound = false;

        foreach ($files as $file) {

            $filename = $file->getFilename();

            if (
                str_contains(
                    $filename,
                    "create_{$tableName}_table"
                )
            ) {

                File::delete(
                    $file->getRealPath()
                );

                $migrationFound = true;

                $this->info(
                    "Deleted Migration: {$filename}"
                );
            }
        }

        if (! $migrationFound) {

            $this->warn(
                "Migration Not Found For: {$tableName}"
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        $this->info(
            "{$name} module removed successfully."
        );

        return Command::SUCCESS;
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

            $this->info(
                "Deleted: {$path}"
            );
        } else {

            $this->warn(
                "File Not Found: {$path}"
            );
        }
    }
}