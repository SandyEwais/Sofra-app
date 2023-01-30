<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions1 = [
            'clients_access',
            'clients_delete',
            'clients_activate',
            'clients_deavtivate',
            'restaurants_access',
            'restarants_show',
            'restaurants_delete',
            'restaurants_activate',
            'restaurants_deavtivate',
            'offers_access',
            'offers_delete',
            'payments_access',
            'payments_create',
            'payments_edit',
            'payments_delete',
            'cities_access',
            'cities_create',
            'cities_edit',
            'cities_delete',
            'categories_access',
            'categories_create',
            'categories_edit',
            'categories_delete',
            'neighborhoods_access',
            'neighborhoods_create',
            'neighborhoods_edit',
            'neighborhoods_delete',
            'contact-messages_access',
            'contact-messages_delete',
            'settings_access',
            'settings_edit',
            'users_access',
            'users_create',
            'users_edit',
            'users_delete',
            'roles_access',
            'roles_create',
            'roles_edit',
            'roles_delete',
            
        ];
        foreach($permissions1 as $permission){
            $array = explode('_',$permission);
            $table = $array[0];
            $route = $array[1];
            if($route == 'access'){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'routes' =>  $table.'.index'
                ]);
            }
            if($route == 'show'){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'routes' =>  $table.'.show'
                ]);
            }
            if($route == 'create'){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'routes' =>  $table.'.create'.','.$table.'.store'
                ]);
            }
            if($route == 'edit'){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'routes' =>  $table.'.edit'.','.$table.'.update'
                ]);
            }
            if($route == 'delete'){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'routes' =>  $table.'.destroy'
                ]);
            }
            if($route == 'activate'){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'routes' =>  $table.'.activate'
                ]);
            }
            if($route == 'deactivate'){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'routes' =>  $table.'.deactivate'
                ]);
            }
        }
        
        

        Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);
    }
}
