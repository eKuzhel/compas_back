<?php

declare(strict_types=1);

namespace Database\Seeders;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Seeder;

/**
 * Class AdminTablesSeeder
 * @package Database\Seeders
 */
final class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param string $login
     * @param string $password
     */
    public function run(string $login, string $password): void
    {
        $this->truncate();
        $this->createPermissions();
        $this->createRoles();
        $this->createAdministrator($login, $password);
    }

    /**
     * Truncate
     */
    private function truncate(): void
    {
        Menu::query()->truncate();
        Role::query()->truncate();
        Permission::query()->truncate();
        Administrator::query()->truncate();
    }


    /**
     * Create a permissions
     */
    private function createPermissions(): void
    {
        Permission::query()->insert([
            [
                'name' => 'All permission',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '*',
            ],
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'http_method' => 'GET',
                'http_path' => '/',
            ],
            [
                'name' => 'Login',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => "/auth/login\r\n/auth/logout",
            ],
            [
                'name' => 'User setting',
                'slug' => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path' => '/auth/setting',
            ],
            [
                'name' => 'Auth management',
                'slug' => 'auth.management',
                'http_method' => '',
                'http_path' => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
            ],
        ]);
    }

    /**
     * Create a roles.
     */
    private function createRoles(): void
    {
        Role::query()->create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        Role::query()->create([
            'name' => 'Manager',
            'slug' => 'manager',
        ]);

        /** @var \Encore\Admin\Auth\Database\Role $role */
        $role = Role::query()->where('slug', '=', 'administrator')->first();
        $role->permissions()->save(Permission::query()->where('slug', '=', '*')->first());

    }

    /**
     * @param string $login
     * @param string $password
     */
    private function createAdministrator(string $login, string $password): void
    {
        // create a user.
        Administrator::query()->create([
            'username' => $login,
            'password' => \bcrypt($password),
            'name' => 'Administrator',
        ]);

        /** @var \Encore\Admin\Auth\Database\Administrator $administrator */
        $administrator = Administrator::query()->where('username', '=', $login)->first();

        /** @var \Encore\Admin\Auth\Database\Role $role */
        $role = Role::query()->where('slug', '=', 'administrator')->first();

        $administrator->roles()->save($role);
    }
}
