<?php

namespace Easy\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Easy\Category\Models\Category as ProductCategory;
use Easy\Product\Models\Price as ProductPrice;
use Easy\Product\Models\Image as ProductImage;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class,'category_products', 'product_id', 'category_id');
    }
}
