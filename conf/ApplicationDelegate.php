<?php
/**
 * The application delegate class allows you to implement hooks and callbacks that
 * override default Xataface application functionality.
 */
class conf_ApplicationDelegate {

    /**
     * Returns application-wide permissions.
     * See https://shannah.github.io/xataface-manual/#security
     * @param Dataface_Record The record that is being checked for permissions.  May be null
     *      if checking for table-level permissions.
     * @return array Associative array mapping permission names to 1 or 0.
     */
    function getPermissions(Dataface_Record $record = null) {
        if (isAdmin()) {
            // Administrator accounts get ALL permissions
            return Dataface_PermissionsTool::ALL();
        }
        // All other users get no permissions
        return Dataface_PermissionsTool::NO_ACCESS();
    }


    function beforeHandleRequest() {

        // Get the current user.
        // This will get a Dataface_Record for the users table or null
        // if user is not logged in.
        $user = getUser();

        // Get a reference to the singleton application object.
        $app = Dataface_Application::getInstance();

        // Check to see if the user should reset their password.
        if ($user and $user->val('reset_password')) {
            $query =& $app->getQuery();
            if ($query['-action'] != 'change_password') {
                $query['-action'] = 'change_password';
                $app->addMessage('Please reset your password before proceeding');
            }

        }
    }
}