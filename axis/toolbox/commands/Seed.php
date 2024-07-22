<?php

class Seed{
    protected $directory = 'migrations/seed';
    
    function run(){

        // scan files in the dir
        $files = scandir($this->directory);

        // run migrations
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;
            require_once $this->directory .'/'.  $file;
            
            try {
                $table_class = explode(".", $file)[1];
                $table_instance = new $table_class();
                $table_instance->seed();

            } catch (PDOException $e) {
                print($e->getMessage());

            }
        }
    }
}

?>