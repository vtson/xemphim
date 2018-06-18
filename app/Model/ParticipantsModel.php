<?php
namespace App\Models;
class ParticipantsModel extends BaseModel
{
    public $fields = ["aname", "dob", "country", "height", "thumbnail", "marriage", "job"];
    public $table = 'participants';
}
