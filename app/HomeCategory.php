<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HomeCategory extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];

    public function category()
    {
        return $this->belongsTo( Category::class );
    }
}
