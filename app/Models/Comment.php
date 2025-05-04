<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['festival_id', 'content', 'user_id'];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}