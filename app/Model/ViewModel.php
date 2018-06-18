<?php
namespace App\Models;
class ViewModel extends BaseModel
{
    public $fields = ["ip", "film_id", "create_at"];
    public $table = 'views';
}
