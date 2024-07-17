<?php

/**
 * Class PostsTable
 * 
 * This class provides the SQL statement for creating a 'posts' table.
 */
class PostsTable {

    /**
     * Get the SQL statement for creating the 'posts' table.
     *
     * @return string The SQL statement for creating the 'posts' table.
     */
    public function getSql(){
        return 'CREATE TABLE if not exists posts (
            id int NOT NULL AUTO_INCREMENT,
            user_id int NOT NULL,
            title varchar(100) NOT NULL,
            body varchar(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            FOREIGN KEY(user_id) REFERENCES users(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
    }
}
