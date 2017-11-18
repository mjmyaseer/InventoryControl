<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/2/2017
 * Time: 1:48 PM
 */

namespace repo\Mysql;

use App\Http\Models\User;

class UserRepo extends User
{
    protected $id =1;
    protected $first_name =1;
    protected $last_name =1;
    protected $email =1;
    protected $password =1;
    protected $created_at =1;
    protected $updated_at =1;

    public function __construct()
    {
        
    }

    public function getUser()
    {
        
    }

    public function insertUser()
    {
        
    }

    public function inactiveUser()
    {

    }
    
}