<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'donor_id',
        'comment_body',
        'post_id',
        'donordetails_id',
        'bloodrequest_id'
    ];

    public function donorcomment()
    {
        return $this->belongsTo(Donor::class, 'donor_id', 'id');
    }

    public function postcomment()
    {
        return $this->hasMany(Donor::class, 'donor_id');
    }
}
