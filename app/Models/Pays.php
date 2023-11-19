<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pays extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'code3',
        'pays',
        'country',

    ];
    public $timestamps = false;
    public function article():BelongsTo{
        return $this->belongsTo(Article::class);
    }
}
