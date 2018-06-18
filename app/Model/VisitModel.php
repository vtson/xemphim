<?php
namespace App\Models;
class VisitModel extends BaseModel
{
    public $fields = ["ip", "create_at"];
    public $table = 'visits';
}
