<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        if ($this->command->confirm('Do you wish to fresh migration before seeding, it will clear all old data ?')) {
            // Call the php artisan migrate:refresh
            $this->command->call('migrate:fresh');
            $this->command->warn("Data cleared, starting from blank database.");
        }
        Model::unguard();
       $this->call(\Modules\Usuario\Database\Seeders\UsuarioDatabaseSeeder::class);
    }
}
