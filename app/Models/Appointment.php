<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['patient_id', 'scheduled_at', 'status', 'calcom_uid'];
    protected $casts = ['scheduled_at' => 'datetime'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
