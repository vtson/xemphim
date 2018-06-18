<?php

$directories = ['app/Controller/', 'app/Model/', 'app/Helper/', 'app/Controller/Admin/'];

$preLoadFiles = ['app/Controller/BaseController', 'app/Model/BaseModel', 'app/Helper/Database'];

foreach ($preLoadFiles as $file){
   require_once $file . '.php';
}

foreach ($directories as $directory) {
    $files = scandir($directory);
    foreach ($files as $file) {
        $ext = explode('.', $file);
        if (isset($ext[1]) && $ext[1] == 'php'){
            require_once $directory . $file;
        }
    }
}