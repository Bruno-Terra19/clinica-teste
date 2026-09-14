<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\Patient;
use App\Services\CalcomService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SyncCalcom extends Command
{
    protected $signature = 'calcom:sync';
    protected $description = 'Sincroniza os agendamentos do Cal.com com a tabela appointments';

    public function handle(CalcomService $calcom)
    {
        $this->info('Buscando bookings no Cal.com...');

        try {
            $bookings = $calcom->getBookings();
        } catch (\Throwable $e) {
            $this->error('Falha ao consultar o Cal.com: ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->info('Recebidos: ' . count($bookings));
        $novos = 0;
        $atualizados = 0;

        foreach ($bookings as $b) {
            $attendee = $b['attendees'][0] ?? null;
            if (!$attendee || empty($attendee['email'])) {
                $this->warn('Booking #' . ($b['id'] ?? '?') . ' sem agendador — pulado.');
                continue;
            }

            $patient = Patient::firstOrCreate(
                ['email' => $attendee['email']],
                ['name' => $attendee['name'] ?? 'Sem nome']
            );

            $appointment = Appointment::updateOrCreate(
                ['calcom_uid' => (string) $b['id']],
                [
                    'patient_id' => $patient->id,
                    'scheduled_at' => Carbon::parse($b['start'])->timezone(config('app.timezone')),
                    'status' => $this->mapStatus($b['status'] ?? ''),
                ]
            );

            $appointment->wasRecentlyCreated ? $novos++ : $atualizados++;

            $patient->update(['last_visit_at' => $appointment->scheduled_at->toDateString()]);
        }

        $this->newLine();
        $this->info("Concluído. Novos: {$novos} | Atualizados: {$atualizados}");
        return self::SUCCESS;
    }

    private function mapStatus(string $calcomStatus): string
    {
        return match ($calcomStatus) {
            'accepted' => 'confirmed',
            'pending' => 'pending',
            'cancelled', 'rejected' => 'cancelled',
            default => $calcomStatus,
        };
    }
}