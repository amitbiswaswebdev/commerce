<?php

namespace Easy\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use  Easy\Product\Models\ProductAttributeSet;
class ProductAttributeGroup extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'product_attribute_groups';

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
        'set_code',
        'level'
    ];

    /**
     * @return BelongsTo
     */
    public function set(): BelongsTo
    {
        return $this->belongsTo(ProductAttributeSet::class, 'set_code', 'code');
    }

    /**
     * @return BelongsToMany
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(ProductAttribute::class,'product_attribute_attribute_groups', 'group_code', 'attribute_code');
    }
}
