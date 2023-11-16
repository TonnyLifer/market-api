<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','category_id'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function getAllChildren()
    {
        $categories = new Collection();
        
        foreach ($this->children as $category) {
            $categories->push($category);            
            $categories = $categories->merge($category->getAllChildren());
        }
        return $categories;
    }
}
