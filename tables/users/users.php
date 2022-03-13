<?php
class tables_users {
    function getPermissions(Dataface_Record $record = null) {
        // Administrators get their full permissions
        if (isAdmin()) return null;

        $user = getUser();

        if ($record and $user and $record->val('username') === $$user->val('username')) {
            // Users get special permissions to their own profile
            // See permissions.ini.php file for definition
            // of USERS_OWNER role
            return Dataface_PermissionsTool::getRolePermissions('USERS_ME');
        }

        // All other users get no permission to the users table.
        return null;

    }
}