<?php
    class UsersTable {
        public function getSql(){
            return 'CREATE TABLE if not exists users (
                id int NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                email varchar(20) NOT NULL,
                password varchar(255) NOT NULL,
                PRIMARY KEY (id)
            )  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
        }
    }


