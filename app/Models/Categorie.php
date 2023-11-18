<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'categorie',
        'slugcategorie',

    ];
    public $timestamps = false;
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        Categorie::created(function($model){
            Cache::forget('categorie-list');
        });
        Categorie::deleted(function($model){
            Cache::forget('categorie-list');
        });
        Categorie::updated(function($model){
            Cache::forget('categorie-list');
        });
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}