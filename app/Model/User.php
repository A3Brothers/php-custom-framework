<?php
namespace App\Model;

use System\App;

class User extends BaseModel
{

    protected $table = 'users';

    public function __construct() 
    {
        parent::__construct();
    }

}