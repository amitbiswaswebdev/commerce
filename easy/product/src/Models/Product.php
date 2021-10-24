<?php

namespace Easy\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Easy\Category\Models\Category as ProductCategory;
use Easy\Product\Models\Price as ProductPrice;
use Easy\Product\Models\Image as ProductImage;

class Product extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'products';

   /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'sku',
        'title',
        'small_description',
        'description',
        'type',
        'maintain_stock',
        'slug',
        'meta_title',
        'meta_description',
        'meta_image'
    ];

    /**
     * Get the prices for the product.
     */
    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }

    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    /**
     * The categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class,'category_products', 'product_id', 'category_id');
    }
}
