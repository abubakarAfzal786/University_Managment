<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
        
    // }
    public function run()
    {
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit data']);
        Permission::create(['name' => 'delete data']);
        Permission::create(['name' => 'publish data']);
        Permission::create(['name' => 'unpublish data']);
        Permission::create(['name' => 'Read data']);


        // create roles and assign created permissions

        // this can be done as separate statements
        // $role = Role::create(['name' => 'writer']);
        // $role->givePermissionTo('edit articles');

        // or may be done by chaining
        $role=Role::create(['name'=>'Student'])
        ->givePermissionTo(['Read data']);
        
        $role = Role::create(['name' => 'SuperAdmin'])
            ->givePermissionTo(['publish data', 'unpublish data','delete data','edit data']);

        $role = Role::create(['name' => 'Teacher'])
           ->givePermissionTo(['Read data','edit data']);
        // $role->givePermissionTo(Permission::all());
       $user = User::create([ 'name' => 'John', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'created_at' => '2019-05-28 04:45:27', 'updated_at' => '2019-05-28 04:45:27' ]); 
       $user->assignRole('Teacher');
$user1 = User::create([ 'name' => 'John Doe', 'email' => 'superadmin@example.com', 'password' => bcrypt('password'), 'created_at' => '2019-05-28 04:45:27', 'updated_at' => '2019-05-28 04:45:27' ]);
 $user1->assignRole('SuperAdmin');
 $user2=User::create([ 'name' => 'User Doe', 'email' => 'user@example.com', 'password' => bcrypt('password'), 'created_at' => '2019-05-28 04:45:27', 'updated_at' => '2019-05-28 04:45:27' ]);
 $user->assignRole('Student');
    }
}
