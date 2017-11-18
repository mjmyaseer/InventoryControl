<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
class Upload extends Model
{
    const ENTITY_ITEM       = "item";
    const ENTITY_USER       = "user";
    const ENTITY_CATEGORY   = "category";

    const META_ITEM_IMAGES          = "item_images";
    const META_CATEGORY_IMAGE       = "category_images";
    const META_USER_PROFILE_IMAGE   = "user_profile_image";
    
    protected $table = "uploads";
}