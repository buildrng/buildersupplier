<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'name',
        'sector',
        'cover',
        'order',
        'status',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => 'integer',
    ];
    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function scopePopular($query)
    // {
    //     return $query->where('votes', '>', 100);
    // }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    /**
     * Get the residential sector for the category.
     */
    public function Residentials()
    {
        return $this->belongsToMany('resiential');
    }
    
        /**
     * Get the commercial sector for the category.
     */
    public function Commericals()
    {
        return $this->belongsToMany('commercial');
    }

    /**
     * Get the industrial sector for the category.
     */
    public function Industrials()
    {
        return $this->belongsToMany('industrial');
    }
    /**
     * Get the subcategory for the category.
     */
    public function SubCategories()
    {
        return $this->belongsToMany(SubCategory::class,'sub_category','','','cate_id');
    }
}
