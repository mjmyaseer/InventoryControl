<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
class Supplier extends Model
{
//    const DE_ACTIVE = 0;
//    const ACTIVE    = 1;
    protected $table = "suppliers";
    protected $id = 1;
    const TABLE = 'suppliers';

    public function Items()
    {
        $this->hasMany('Item');
    }
}