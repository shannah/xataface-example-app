<?php
class conf_ApplicationDelegate {
    function getPermissions(Dataface_Record $record = null) {
        if (isAdmin()) {
            // Administrator accounts get ALL permissions
            return Dataface_PermissionsTool::ALL();
        }
        // All other users get no permissions
        return null;
    }
}