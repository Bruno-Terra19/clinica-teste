<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'last_visit_at'];
    protected $casts = ['last_visit_at' => 'date'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
