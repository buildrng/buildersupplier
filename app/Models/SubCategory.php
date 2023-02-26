<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_category';
    
    protected $fillable = [
        'name',
        'cover',
        'cate_id',
        'sector',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];
    
    public function Category()
    {
        return $this->belongsTo(Category::class,'cate_id','id');
    }
}
