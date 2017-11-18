<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    const DE_ACTIVE = 0;
    const ACTIVE    = 1;
    protected $table = "customers";
    const TABLE = 'customers';

    public function Item()
    {
     $this->hasMany('Item');
    }
}