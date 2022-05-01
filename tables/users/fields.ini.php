<?php exit;
;;---------------------------------------------------------------------
;; Field configuration for the users table
;;---------------------------------------------------------------------

[date_created]
    ; date_created field should be updated with a timestamp on insert
    ; NOTE: This will make the field hidden by default also.
    timestamp=insert

[last_modified]
    ; last_modified field should be updated with a timestamp on update
    ; NOTE: This will make the field hidden by default also
    timestamp=update

[password]
    ; Use sha1 encryption on the password field.
    ; See https://shannah.github.io/xataface-manual/#authentication
    encryption=sha1

; The reset password field allows administrators to force users to reset their password
; the next time they login.
[reset_password]
    widget:type=checkbox
    widget:description="Check this box to force the user to reset their password the next time they login"