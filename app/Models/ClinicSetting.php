<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicSetting extends Model
{
    protected $fillable = ['clinic_name', 'calcom_link', 'whatsapp_number'];
}
