<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
    //    DB::table('tasks')->insert([ //no method for generating count
    //     'name'=>Str::random(10),

    //    ]);
    Task::factory()
    ->count(15)
    ->create();
    //    User::factory()
    //        ->count(15)
    //        ->create();
    }
}
