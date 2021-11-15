<?php

namespace Easy\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Easy\Product\Models\ProductAttributeGroup;
class ProductAttributeSet extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'product_attribute_sets';

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
        'code',
        'level'
    ];

    /**
     * @return HasMany
     */
    public function groups(): HasMany
    {
        return $this->hasMany(ProductAttributeGroup::class, 'set_code', 'code');
    }
}
