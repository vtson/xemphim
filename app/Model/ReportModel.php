<?php
namespace App\Models;

class ReportModel extends BaseModel
{
    public $fields = ["user_id", "create_at", "episode_id", "content"];
    public $table = 'report';

}
