<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\ClinicSetting;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ClinicSetting::create([
            'clinic_name' => 'Clínica Teste',
            'calcom_link' => 'https://cal.com/teste',
            'whatsapp_number' => '5575981157345',
        ]);

        $pacientes = [
            ['name' => 'Marina Souza', 'phone' => '5531988887777', 'email' => 'marina@exemplo.com'],
            ['name' => 'Carlos Lima', 'phone' => '5531977776666', 'email' => 'carlos@exemplo.com'],
            ['name' => 'Juliana Reis', 'phone' => '5531966665555', 'email' => 'juliana@exemplo.com'],
        ];

        foreach ($pacientes as $dados) {
            $paciente = Patient::create([
                ...$dados,
                'last_visit_at' => now()->subDays(rand(5, 60)),
            ]);

            Appointment::create([
                'patient_id' => $paciente->id,
                'scheduled_at' => now()->addDays(rand(1, 14))->setHour(rand(9, 17))->setMinute(0),
                'status' => 'confirmed',
                'calcom_uid' => 'seed-' . Str::uuid(),
            ]);
        }

        Contact::create([
            'name' => 'Pedro Antunes',
            'email' => 'pedro@exemplo.com',
            'message' => 'Gostaria de saber os valores de uma limpeza.',
            'responded' => false,
        ]);
    }
}
