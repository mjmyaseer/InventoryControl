<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Supplier;

class Item extends Model
{
    const DE_ACTIVE = 0;
    const ACTIVE = 1;
    protected $table = "items";
    const TABLE = 'items';


    public function Supplier()
    {
        return $this->hasOne('App\Http\Models\Supplier','item_id','item_id');
    }
}