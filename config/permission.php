<?php

return [

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you define must implement the Spatie\Permission\Contracts\Permission interface.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you define must implement the Spatie\Permission\Contracts\Role interface.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasRoles" or "HasPermissions" traits from this package we need to know which
         * table should be used to retrieve your models permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" or "HasPermissions" traits from this package we need to know which
         * table should be used to retrieve your models roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" or "HasPermissions" traits from this package we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        'role_pivot_key' => null, //Defaults to 'role_id'
        'permission_pivot_key' => null, //Defaults to 'permission_id'

        /*
         * Change this if you want to name the related model primary key other than
         * 'model_id'.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this 'model_uuid'.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the team_id column name other than 'team_id'.
         */

        'team_foreign_key' => 'team_id',
    ],

    'register_permission_check_method' => true,

    'register_octane_reset_listener' => false,

    'teams' => false,

    'use_passport_client_credentials' => false,

    'display_permission_in_exception' => false,

    'display_role_in_exception' => false,

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The key to be used to store all permissions in cache.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may specify a cache store to use, or null to use default.
         *
         * To use array store for testing:
         * 'store' => 'array',
         */

        'store' => 'default',
    ],
];
