<?php

namespace Easy\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Easy\Product\Models\ProductAttributeGroup;

class ProductAttribute extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'product_attributes';

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
        'level',
        'input',
        'validation_rules',
        'user_defined',
        'default_value',
        'model_value',
        'use_in_filter',
        'show_as'
    ];

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(ProductAttributeGroup::class,'product_attribute_attribute_groups', 'attribute_code', 'group_code');
    }
}
