<?php

namespace App\Models;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    // public function clients(){
    //     return $this->belongsToMany(Room::class, 'bookings');
    // }
    
    public function clients(){
    return $this->belongsToMany(User::class, 'bookings');
    }

    public function reviewers(){
        return $this->belongsToMany(User::class, 'reviews');
    }
}
