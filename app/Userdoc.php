<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Userdoc extends Model
{
    use Sortable;
    
    public $sortable = ['uploaded'];
    
    public function user()
    {
        return $this->belongsTo(App\User::class);
    }
}
