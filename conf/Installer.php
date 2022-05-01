<?php
/**
 * Xataface "Installer" class handles database migrations between versions.
 * See https://shannah.github.io/xataface-manual/#_application_versioning_and_synchronization
 */
class conf_Installer {

    /**
     * Migration to run when updating to version 2.
     */
    function update_2() {
        $sql[] = "create table if not exists users (
            username VARCHAR(100) NOT NULL,
            password VARCHAR(64) NOT NULL,
            email VARCHAR(255) NOT NULL,
            role ENUM('USER', 'ADMIN') DEFAULT 'USER',
            date_created DATETIME,
            last_modified DATETIME,
            reset_password TINYINT(1) DEFAULT 0,
            PRIMARY KEY (`username`),
            UNIQUE KEY (`email`))
            CHARACTER SET utf8
            COLLATE utf8_unicode_ci
            ENGINE=MyISAM
            ";

        $sql[] = "insert into users VALUES (
            'admin',
            SHA1('password'),
            'admin@example.com',
            'ADMIN',
            NOW(),
            NOW(),
            1)";
        $sql[] = "create table dashboard (dashboard_id INT(11) auto_increment PRIMARY KEY) ENGINE=MyISAM";
        df_q($sql);

    }

}