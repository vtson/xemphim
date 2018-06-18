<?php
namespace App\Models;
class UserModel extends BaseModel
{
    public $fields = ["user_id", "username", "password", "email", "role", "create_at", "modified_at"];
    public $table = 'users';

}
