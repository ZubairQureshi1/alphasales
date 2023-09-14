<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_array = [

            // create users masters permissions
            ['name' => 'view_user_masters', 'action_name' => 'view', 'module_name' => 'User-Masters'],
            // create users permissions
            ['name' => 'view_users', 'action_name' => 'view', 'module_name' => 'users'],
            ['name' => 'create_users', 'action_name' => 'create', 'module_name' => 'users'],
            ['name' => 'edit_users', 'action_name' => 'edit', 'module_name' => 'users'],
            ['name' => 'delete_users', 'action_name' => 'delete', 'module_name' => 'users'],
            // create roles permissions
            ['name' => 'view_roles', 'action_name' => 'view', 'module_name' => 'roles'],
            ['name' => 'create_roles', 'action_name' => 'create', 'module_name' => 'roles'],
            ['name' => 'edit_roles', 'action_name' => 'edit', 'module_name' => 'roles'],
            ['name' => 'delete_roles', 'action_name' => 'delete', 'module_name' => 'roles'],
            // create prfile permissions
            ['name' => 'view_profile', 'action_name' => 'view', 'module_name' => 'profile'],
            ['name' => 'create_profile', 'action_name' => 'create', 'module_name' => 'profile'],
            ['name' => 'edit_profile', 'action_name' => 'edit', 'module_name' => 'profile'],
            ['name' => 'delete_profile', 'action_name' => 'delete', 'module_name' => 'profile'],
            // create enquiries permissions
            ['name' => 'view_enquiries', 'action_name' => 'view', 'module_name' => 'enquiries'],
            ['name' => 'create_enquiries', 'action_name' => 'create', 'module_name' => 'enquiries'],
            ['name' => 'edit_enquiries', 'action_name' => 'edit', 'module_name' => 'enquiries'],
            ['name' => 'delete_enquiries', 'action_name' => 'delete', 'module_name' => 'enquiries'],
            // create follow_ups permissions
            ['name' => 'view_follow_ups', 'action_name' => 'view', 'module_name' => 'follow_ups'],
            ['name' => 'create_follow_ups', 'action_name' => 'create', 'module_name' => 'follow_ups'],
            ['name' => 'edit_follow_ups', 'action_name' => 'edit', 'module_name' => 'follow_ups'],
            ['name' => 'delete_follow_ups', 'action_name' => 'delete', 'module_name' => 'follow_ups'],
            // create call_centers permissions
            ['name' => 'view_call_centers', 'action_name' => 'view', 'module_name' => 'call_centers'],
            ['name' => 'create_call_centers', 'action_name' => 'create', 'module_name' => 'call_centers'],
            ['name' => 'edit_call_centers', 'action_name' => 'edit', 'module_name' => 'call_centers'],
            ['name' => 'delete_call_centers', 'action_name' => 'delete', 'module_name' => 'call_centers'],
            // create admissions permissions
            ['name' => 'view_admissions', 'action_name' => 'view', 'module_name' => 'admissions'],
            ['name' => 'create_admissions', 'action_name' => 'create', 'module_name' => 'admissions'],
            ['name' => 'edit_admissions', 'action_name' => 'edit', 'module_name' => 'admissions'],
            ['name' => 'delete_admissions', 'action_name' => 'delete', 'module_name' => 'admissions'],
            // create students permissions
            ['name' => 'view_students', 'action_name' => 'view', 'module_name' => 'students'],
            ['name' => 'create_students', 'action_name' => 'create', 'module_name' => 'students'],
            ['name' => 'edit_students', 'action_name' => 'edit', 'module_name' => 'students'],
            ['name' => 'delete_students', 'action_name' => 'delete', 'module_name' => 'students'],

            /* ----------      Permissions for settings     --------------*/
            ['name' => 'view_settings', 'action_name' => 'view', 'module_name' => 'Settings'],
            // create degrees permissions
            ['name' => 'view_degrees', 'action_name' => 'view', 'module_name' => 'degrees'],
            ['name' => 'create_degrees', 'action_name' => 'create', 'module_name' => 'degrees'],
            ['name' => 'edit_degrees', 'action_name' => 'edit', 'module_name' => 'degrees'],
            ['name' => 'delete_degrees', 'action_name' => 'delete', 'module_name' => 'degrees'],
            // create references permissions
            ['name' => 'view_references', 'action_name' => 'view', 'module_name' => 'references'],
            ['name' => 'create_references', 'action_name' => 'create', 'module_name' => 'references'],
            ['name' => 'edit_references', 'action_name' => 'edit', 'module_name' => 'references'],
            ['name' => 'delete_references', 'action_name' => 'delete', 'module_name' => 'references'],
            // create subjects permissions
            ['name' => 'view_subjects', 'action_name' => 'view', 'module_name' => 'subjects'],
            ['name' => 'create_subjects', 'action_name' => 'create', 'module_name' => 'subjects'],
            ['name' => 'edit_subjects', 'action_name' => 'edit', 'module_name' => 'subjects'],
            ['name' => 'delete_subjects', 'action_name' => 'delete', 'module_name' => 'subjects'],
            // create sessions permissions
            ['name' => 'view_sessions', 'action_name' => 'view', 'module_name' => 'sessions'],
            ['name' => 'create_sessions', 'action_name' => 'create', 'module_name' => 'sessions'],
            ['name' => 'edit_sessions', 'action_name' => 'edit', 'module_name' => 'sessions'],
            ['name' => 'delete_sessions', 'action_name' => 'delete', 'module_name' => 'sessions'],
            // create departments permissions
            ['name' => 'view_departments', 'action_name' => 'view', 'module_name' => 'departments'],
            ['name' => 'create_departments', 'action_name' => 'create', 'module_name' => 'departments'],
            ['name' => 'edit_departments', 'action_name' => 'edit', 'module_name' => 'departments'],
            ['name' => 'delete_departments', 'action_name' => 'delete', 'module_name' => 'departments'],
            // create designations permissions
            ['name' => 'view_designations', 'action_name' => 'view', 'module_name' => 'designations'],
            ['name' => 'create_designations', 'action_name' => 'create', 'module_name' => 'designations'],
            ['name' => 'edit_designations', 'action_name' => 'edit', 'module_name' => 'designations'],
            ['name' => 'delete_designations', 'action_name' => 'delete', 'module_name' => 'designations'],

            // create accounts permissions
            ['name' => 'view_accounts', 'action_name' => 'view', 'module_name' => 'accounts'],
            ['name' => 'create_accounts', 'action_name' => 'create', 'module_name' => 'accounts'],
            ['name' => 'edit_accounts', 'action_name' => 'edit', 'module_name' => 'accounts'],
            ['name' => 'delete_accounts', 'action_name' => 'delete', 'module_name' => 'accounts'],
            // create account_reportings permissions
            ['name' => 'view_account_reportings', 'action_name' => 'view', 'module_name' => 'account_reportings'],
            ['name' => 'create_account_reportings', 'action_name' => 'create', 'module_name' => 'account_reportings'],
            ['name' => 'edit_account_reportings', 'action_name' => 'edit', 'module_name' => 'account_reportings'],
            ['name' => 'delete_account_reportings', 'action_name' => 'delete', 'module_name' => 'account_reportings'],
            // create account_package_verification permissions
            ['name' => 'view_account_package_verification', 'action_name' => 'view', 'module_name' => 'account_package_verification'],
            ['name' => 'create_account_package_verification', 'action_name' => 'create', 'module_name' => 'account_package_verification'],
            ['name' => 'edit_account_package_verification', 'action_name' => 'edit', 'module_name' => 'account_package_verification'],
            ['name' => 'delete_account_package_verification', 'action_name' => 'delete', 'module_name' => 'account_package_verification'],
            ['name' => 'verify_account_package_verification', 'action_name' => 'verify', 'module_name' => 'account_package_verification'],
            // create account_instalment_verification permissions
            ['name' => 'view_account_instalment_verification', 'action_name' => 'view', 'module_name' => 'account_instalment_verification'],
            ['name' => 'create_account_instalment_verification', 'action_name' => 'create', 'module_name' => 'account_instalment_verification'],
            ['name' => 'edit_account_instalment_verification', 'action_name' => 'edit', 'module_name' => 'account_instalment_verification'],
            ['name' => 'delete_account_instalment_verification', 'action_name' => 'delete', 'module_name' => 'account_instalment_verification'],
            ['name' => 'verify_account_instalment_verification', 'action_name' => 'verify', 'module_name' => 'account_instalment_verification'],

        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;
            ');
        DB::table('permissions')->truncate();
        foreach ($permission_array as $key => $permission) {
            Permission::create($permission);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
