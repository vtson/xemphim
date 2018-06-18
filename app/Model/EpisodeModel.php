<?php
namespace App\Models;
class EpisodeModel extends BaseModel
{
    public $fields = ["film_id", "ename", "econtent", "part", "create_at", "update_at", "total"];
    public $table = 'episodes';

}
