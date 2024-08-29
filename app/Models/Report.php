<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_id',
        'user_id',
        'first_date',
        'end_date',
    ];
    /**
     * relations
     */
    public function file()
    {
        return $this->hasOne(File::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
