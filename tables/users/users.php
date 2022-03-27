<?php
/**
 * The delegate class for the users table.
 */
class tables_users {

    /**
     * Utility function to check if a given user record is the currently logged in user.
     *
     * @param Dataface_Record $record A record from the users table to check.
     * @return boolean True if $record is the current user.
     */
    private function isMe(Dataface_Record $record = null) {
        $user = getUser();

        return ($record and $user and $record->val('username') === $user->val('username'));
    }

    /**
     * Overrides the permissions for the users table so that users can access
     * their own record but nobody else's.
     *
     * See https://shannah.github.io/xataface-manual/#security
     *
     * @param Dataface_Record $record A user record to check.
     *
     */
    function getPermissions(Dataface_Record $record = null) {
        // Administrators get their full permissions
        if (isAdmin()) return null;

        // If record is currently logged in user, then we grant it
        // special permissions defined in USERS_ME group in the permissions.ini.php
        // file.
        if ($this->isMe($record)) return Dataface_PermissionsTool::getRolePermissions('USERS_ME');

        // All other users get no permission to the users table.
        return null;

    }

    /**
     * Defines the default field permissions for the users table so that
     * users cannot edit fields in their own profile.
     * @param Dataface_Record $record The record to check (from users table).
     * @return array Associative array mapping permission names to boolean values.
     */
    function __field__permissions(Dataface_Record $record = null) {
        if (isAdmin()) return null;
        if ($this->isMe($record)) return ['edit' => 0];
        return null;
    }

    /**
     * Overrides permissions on the email field to allow users to edit
     * the email address in their own profile.
     * @param Dataface_Record $record The record to check (from users table).
     * @return array Associative array mapping permission names to boolean values.
     */
    function email__permissions(Dataface_Record $record = null) {
        if (isAdmin()) return null;
        if ($this->isMe($record)) return ['edit' => 1];
        return null;
    }

    /**
     * Overrides permissions on the role field to prevent user from seeing
     * the role of their own profile.
     */
    function role__permissions(Dataface_Record $record = null) {
            if (isAdmin()) return null;
            if ($this->isMe($record)) return ['view' => 0];
            return null;
        }

    /**
     * Overrides permissions on the password field to prevent user from
     * seeing their password.  This is more for UX as this is just an easy
     * way to hide it from the edit form completely.  If we don't do this,
     * the field will be read-only on the users edit form.
     *
     * @param Dataface_Record $record The record from the users table to get permissions for.
     * @return array Associative array mapping permission names to boolean values.
     */
    function password__permissions(Dataface_Record $record = null) {
        if (isAdmin()) return null;
        if ($this->isMe($record)) return ['view' => 0];
        return null;
    }

    /**
     * Override the permissions on the reset_password field so that only administrators
     * can access it.
     *
     * See https://shannah.github.io/xataface-manual/#security
     */
    function reset_password__permissions(Dataface_Record $record = null) {
        if (isAdmin()) return null;
        return Dataface_PermissionsTool::NO_ACCESS();
    }

    /**
     * Hook that is called before a record is saved.
     *
     * @param Dataface_Record The record from the users table that is being saved.
     */
    function beforeSave(Dataface_Record $record) {

        // If we are changing the password, then we should remove the reset_password
        // flag so that the user isn't forced to change their password again.
        // See the beforeHandleRequest() method in the ApplicationDelegate class to
        // see how this flag is used to force the user to change their password.
        if ($record->valueChanged('password')) {
            $record->setValue('reset_password', 0);
        }
    }
}