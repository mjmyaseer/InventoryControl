<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    const DE_ACTIVE = 0;
    const ACTIVE    = 1;
    protected $id = 1;
    protected $table = "categories";
    const TABLE = 'categories';
    protected $items_id = 1;
    protected $title = 1;
    protected $description = 1;
    protected $parent_id = 1;
    protected $status = 1;
    protected $created_at = 1;
    protected $updated_at = 1;
    protected $categories_id = 1;


    public function Item()
    {
        $this->hasMany('Item');
    }
}