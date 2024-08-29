<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_name',
        'create_date',
        'path',
        'reservation',
        'file',
        'group_id'
    ];
    /**
     * relations
     */
    public function group()
    {
        return $this->belongsTo(Group::class,'group_id');
    }
    public function report()
    {
        return $this->hasOne(Report::class);
    }
}
