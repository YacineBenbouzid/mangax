<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class manga extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'description', 'name','user_id','nviews','banner'];
    public function chapters(): HasMany 
    {
        return $this->hasMany(Chapter::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

}
