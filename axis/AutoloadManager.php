<?php

class AutoloadManager {
    protected array $dirs;


    public function registerDir(string $target_dir){
        $this->dirs[] = $target_dir;
    }

    public function autoload(){
        foreach($this->dirs as $dir){
            // scan files in the dir
            $files = scandir($dir);

            if ($files === false) {
                echo "Failed to open directory:". $dir;
                die();
            } 

            //auto load
            if(!empty($files)){
                foreach ($files as $file) {
                    if ($file == '.' || $file == '..') continue;
                    require_once $dir . '/' . $file;
                }
            } 
        }
    }
}