<?php
namespace App\Models;
class FilmsModel extends BaseModel
{
    public $fields = ["fname", "user_id", "type", "genre", "thumbnail" , "year", "nation", "description", "status", "actor", "directors", "vote", "quality" , "time", "created_at", "update_at"];
    public $table = 'films';

}
