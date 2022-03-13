<?php
class conf_Installer {
    function update_1() {
        $sql[] = "create table users (
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

        $sql[] = "insert into users (
            'admin',
            SHA1('password'),
            'admin@example.com',
            'ADMIN',
            NOW(),
            NOW()
            1)";

    }
}