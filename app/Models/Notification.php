<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notifications";
    protected $primaryKey = "id";

    protected $guarded = [];
    protected $hidden = [];

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timezone(config('app.timezone'))->diffForHumans();
    }

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = is_object(Auth::guard(config('web'))->user()) ? Auth::guard(config('web'))->user()->id : 1;
            $model->updated_by = NULL;
        });

        static::updating(function ($model) {
            $model->updated_by = is_object(Auth::guard(config('web'))->user()) ? Auth::guard(config('web'))->user()->id : 1;
        });
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(config('app.timezone'))->isoFormat('D MMMM Y, HH:m')." WIB"; 
    }

}
