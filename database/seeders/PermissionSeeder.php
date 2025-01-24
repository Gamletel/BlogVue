<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name'=>'can_add_users'],
            ['name'=>'can_edit_users'],
            ['name'=>'can_delete_users'],
            ['name'=>'can_add_posts'],
            ['name'=>'can_edit_posts'],
            ['name'=>'can_delete_posts'],
            ['name'=>'can_add_comments'],
            ['name'=>'can_edit_comments'],
            ['name'=>'can_remove_comments'],
            ['name'=>'can_add_roles'],
            ['name'=>'can_edit_roles'],
            ['name'=>'can_remove_roles'],
        ]);
    }
}
