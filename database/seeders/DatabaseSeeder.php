<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Task;
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
        // $this->call([
        //     UserSeeder::class,
        // ]);

        User::factory(4)->create();
        Category::factory(30)->create();
        Task::factory(100)->create();

    }
}
