<?php

return array(

    /*
     * Role model used by Access to create correct relations. Update the role if it is in a different namespace.
     */
    'role' => 'App\Models\Access\Role\Role',

    /*
     * Roles table used by Access to save roles to the database.
     */
    'roles_table' => 'roles',

    /*
     * Permission model used by Access to create correct relations.
     * Update the permission if it is in a different namespace.
     */
    'permission' => 'App\Models\Access\Permission\Permission',

    /*
     * Permissions table used by Access to save permissions to the database.
     */
    'permissions_table' => 'permissions',

    /*
     * PermissionGroup model used by Access to create permissions groups.
     * Update the group if it is in a different namespace.
     */
    'group' => 'App\Models\Access\Permission\PermissionGroup',

    /*
     * Permissions table used by Access to save permissions to the database.
     */
    'permission_group_table' => 'permission_groups',

    /*
     * permission_role table used by Access to save relationship between permissions and roles to the database.
     */
    'permission_role_table' => 'permission_role',

    /*
     * permission_user table used by Access to save relationship between permissions and users to the database.
     * This table is only for permissions that belong directly to a specific user and not a role
     */
    'permission_user_table' => 'permission_user',

    /*
     * Table that specifies if one permission is dependent on another.
     * For example in order for a user to have the edit-user permission they also need the view-backend permission.
     */
    'permission_dependencies_table' => 'permission_dependencies',

    /*
     * assigned_roles table used by Access to save assigned roles to the database.
     */
    'assigned_roles_table' => 'assigned_roles',

    /*
     * Configurations for the user
     */
    'users' => [
        /*
         * Administration tables
         */
        'default_per_page' => 25,

        /*
         * The role the user is assigned to when they sign up from the frontend, not namespaced
         */
        'default_role' => 'User',

        /*
         * Whether or not the user has to confirm their email when signing up
         */
        'confirm_email' => false,

        /*
         * Whether or not the users email can be changed on the edit profile screen
         */
        'change_email' => true,
    ],

    /*
     * Configuration for roles
     */
    'roles' => [
        /*
         * Whether a role must contain a permission or can be used standalone as a label
         */
        'role_must_contain_permission' => true,
    ],
);
