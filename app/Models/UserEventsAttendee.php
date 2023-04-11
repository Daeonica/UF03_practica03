<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEventsAttendee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email' ,'user_id', 'event_id'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public static function getAttendeeEventsByUserId($userId)
{
    return self::where('user_id', $userId)->with('event')->get();
}

}


