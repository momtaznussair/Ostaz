<?php

namespace Database\Seeders;

use App\Helpers\GetModels;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(GetModels $models)
    {
        //create permissions for each model
        foreach ($models()->add('Role') as $model) {

            Permission::insert([
                ['name' => $model .'_access', 'guard_name' => 'admin'],
                ['name' => $model .'_create', 'guard_name' => 'admin'],
                ['name' => $model .'_edit', 'guard_name' => 'admin'],
                ['name' => $model .'_delete', 'guard_name' => 'admin'],
                ['name' => $model .'_show', 'guard_name' => 'admin'],
            ]);
        }

         // create extra permissions
         $permissions = [
            'Country_report_view',
            'Student_report_view',
            'Course_report_view',
            'Course_report_view',
            'user_messages_reply',
            'Settings_access'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
        
       
    }
}
