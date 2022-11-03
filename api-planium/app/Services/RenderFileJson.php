<?php

namespace App\Services;

class RenderFileJson
{
    public $path;

    public function getPath()
    {
        $this->path = "{$_SERVER['DOCUMENT_ROOT']}".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."Models";
        return $this->path;
    }

    public function getPlans() 
    {
        $this->getPath();
        return json_decode(file_get_contents("{$this->path}".DIRECTORY_SEPARATOR."plans.json"));
    }
    
    public function getPrices() 
    {
        $this->getPath();
        return json_decode(file_get_contents("{$this->path}".DIRECTORY_SEPARATOR."prices.json"));
    }
    
}