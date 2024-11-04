<?php

namespace App\Models;


use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','manga_id'];
    public function sub(int $id){
        if (!Auth::check()) {
            $rs = subscriber::where('user_id', auth()->user()->id)
            ->where('manga_id', $id)
            ->get();
    
            if(!$rs->isEmpty()) {
                return true;
            }
        }
        return false;
    }

}
