<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use HaydenPierce\ClassFinder\ClassFinder;

class PermissionSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get all classes in App\Models namespace
        $classes = ClassFinder::getClassesInNamespace('App\Models');
            $models = [];
            foreach ($classes as $class) {
               $models[] = Str::afterLast($class, '\\');
            }

            //create permissions for each model
            foreach ($models as $model) {

                Permission::insert([
                    ['name' => $model .'_access', 'guard_name' => 'admin'],
                    ['name' => $model .'_create', 'guard_name' => 'admin'],
                    ['name' => $model .'_edit', 'guard_name' => 'admin'],
                    ['name' => $model .'_delete', 'guard_name' => 'admin'],
                    ['name' => $model .'_show', 'guard_name' => 'admin'],
                ]);
            }

         // create permissions for Role Model
         $permissions = [
            'Role_access',
            'Role_create',
            'Role_edit',
            'Role_show',
            'Role_delete',
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
