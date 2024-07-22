<?php

class Migrate{
    protected $directory = 'migrations/migrate';
    
    function run(){
        // connect db
        require_once 'axis/database/DataBaseConnect.php';
        $dbConnect = new app\axis\database\DataBaseConnect();
        $pdo = $dbConnect->getPDO(); // Get the PDO instance

        // scan files in the dir
        $files = scandir($this->directory);

        // run migrations
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;
            require_once $this->directory .'/'.  $file;
            
            try {
       
                $table_class = explode(".", $file)[1];
                $table_instance = new $table_class();
                $sql = $table_instance->getSql();
                $pdo->query($sql);

            } catch (PDOException $e) {
                print($e->getMessage());

            }
        }
    }
}

?>