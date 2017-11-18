<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/7/2017
 * Time: 9:35 PM
 */

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    const DE_ACTIVE = 0;
    const ACTIVE = 1;
    protected $table = "ledger";
    const TABLE = 'ledger';
}