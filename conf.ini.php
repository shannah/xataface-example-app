;<?php exit;
__include__=conf.db.ini.php

; Define the menu items in the tables menu
[_tables]
    test=test

;-----------------------------------------------------
; Authentication Settings
[_auth]
    users_table=users
    username_column=username
    password_column=password
    email_column=email

    ; Comment out set to 0 to disable user registration
    allow_register=1

    ; Allow users to login using their email address
    ; They just enter their email, and single-use login link
    ; is sent to their email.
    allow_email_login=1

    ; Allow users to login using their password
    allow_password_login=1

    ; Automatically create user accounts when people login
    ; with their email address.
    auto_register=1

    ; Enable auto-login via long-lived cookie
    autologin=1