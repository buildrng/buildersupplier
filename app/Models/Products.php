<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'store_id',
        'cover',
        'name',
        'slug',
        'images',
        'cid',
        'original_price',
        'sell_price',
        'discount',
        'kind',
        'cate_id',
        'sub_cate_id',
        'in_home',
        'is_single',
        // 'have_gram','gram','have_kg','kg','have_pcs','pcs','have_liter','liter','have_ml','ml',
        'descriptions',
        'key_features',
        'disclaimer',
        'exp_date',
        'type_of',
        'in_offer',
        'in_store',
        'rating',
        'total_rating',
        'variations',
        'size',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'cid' => 'integer',
        'kind' => 'integer',
        'in_home' => 'integer',
        'is_single' => 'integer',
        // 'have_gram' => 'integer',
        // 'have_kg' => 'integer',
        // 'have_pcs' => 'integer',
        // 'have_liter' => 'integer',
        // 'have_ml' => 'integer',
        'type_of' => 'integer',
        'in_offer' => 'integer',
        'in_store' => 'integer',
        'size' => 'integer',
        'status' => 'integer',
        'rating' => 'decimal:2',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class,'id','cate_id');
    }

    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_cate_id');
    }

    public function Store()
    {
        return $this->belongsTo(Stores::class,'store_id');
    }
    
    // public function Store()
    // {
    //     return $this->belongsTo(User::class,'id','uid');
    // }
}
