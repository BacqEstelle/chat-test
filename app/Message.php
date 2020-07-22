<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'from_id', 'to_id', 'read_at', 'created_at'
    ];

    public $timestamps = false;

    protected $date = [' created_at', 'read_at'];

    public function from ()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
