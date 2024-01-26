<?php

namespace app\anchor;

class Template {

    protected string $path;
    protected array $data;

    public function __construct(string $path, array $data) {
      
        $this->path  = $path;
        $this->data = !empty($data) ? $data : [];
    }

    public function render() {

      if(count($this->data)>0){
        foreach ($this->data as $key => $value) {
          ${$key} = $value;
        }
      }

      include "templates/" . $this->path . '.php';

    }


}