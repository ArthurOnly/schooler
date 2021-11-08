<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $index_users = Permission::create(['name' => 'index users']);
        $show_user = Permission::create(['name' => 'show users']);
        $create_users = Permission::create(['name' => 'create users']);
        $edit_users = Permission::create(['name' => 'edit users']);
        $delete_users = Permission::create(['name' => 'delete users']);

        $index_polos = Permission::create(['name' => 'index polos']);
        $create_polos = Permission::create(['name' => 'create polos']);
        $edit_polos = Permission::create(['name' => 'edit polos']);
        $delete_polos = Permission::create(['name' => 'delete polos']);

        $index_payments = Permission::create(['name' => 'index payments']);
        $create_payments = Permission::create(['name' => 'create payments']);
        $edit_payments = Permission::create(['name' => 'edit payments']);
        $delete_payments = Permission::create(['name' => 'delete payments']);

        $index_classroom = Permission::create(['name' => 'index classroom']);
        $show_classroom = Permission::create(['name' => 'show classroom']);
        $notas_classroom = Permission::create(['name' => 'notas classroom']);
        $create_classroom = Permission::create(['name' => 'create classroom']);
        $edit_classroom = Permission::create(['name' => 'edit classroom']);
        $delete_classroom = Permission::create(['name' => 'delete classroom']);

        Role::create(['name' => 'director'])->syncPermissions(
            [
                $index_users, $show_user, $create_users, $edit_users, $delete_users,
                $index_payments, $create_payments, $edit_payments, $delete_payments,
                $index_polos, $create_polos, $edit_polos, $delete_polos,
                $index_classroom, $create_classroom, $edit_classroom, $delete_classroom
            ]
        );
        Role::create(['name' => 'teacher'])->syncPermissions(
            [
                $show_classroom, $notas_classroom
            ]
        );
        Role::create(['name' => 'student'])->syncPermissions(
            [
                $show_classroom, $notas_classroom
            ]
        );
        Role::create(['name' => 'coordinator'])->syncPermissions(
            [
                $index_users, $show_user,
                $index_payments,
                $index_classroom, $create_classroom, $edit_classroom, $delete_classroom, $notas_classroom
            ]
        );
        Role::create(['name' => 'secretary'])->syncPermissions(
            [
                $index_users, $show_user, $create_users,
                $index_payments,
                $index_classroom, $create_classroom, $edit_classroom, $delete_classroom,
                $index_polos
            ]
        );
        Role::create(['name' => 'financial'])->syncPermissions(
            [
                $index_users, $show_user,
                $index_payments, $create_payments, $edit_payments, $delete_payments,
                $index_polos
            ]
        );
    }
}
