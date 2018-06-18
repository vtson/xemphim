<?php
namespace App\Models;
class GenreModel extends BaseModel
{
    public $fields = ["genre", "slug", "description"];
    public $table = 'genre';

}
