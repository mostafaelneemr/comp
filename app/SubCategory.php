<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SubCategory extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo( Category::class );
    }

    public function subsubcategories()
    {
        return $this->hasMany( SubSubCategory::class );
    }

    public function products()
    {
        return $this->hasMany( Product::class, 'subcategory_id' );
    }

    public function classified_products()
    {
        return $this->hasMany( CustomerProduct::class, 'subcategory_id' );
    }
}
