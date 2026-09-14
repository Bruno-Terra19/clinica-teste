<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestarCalcom extends Command
{
    protected $signature = 'calcom:testar';
    protected $description = 'Testa a conexão com a API do Cal.com';

    public function handle()
    {
        $url = config('services.calcom.url');
        $key = config('services.calcom.key');

        if (!$key) {
            $this->error('CALCOM_API_KEY não encontrada no .env');
            return self::FAILURE;
        }

        $this->info('Consultando ' . $url . '/bookings ...');

        $response = Http::withToken($key)
            ->withHeaders(['cal-api-version' => '2024-08-13'])
            ->get($url . '/bookings');

        if ($response->failed()) {
            $this->error('Falha. Status: ' . $response->status());
            $this->line($response->body());
            return self::FAILURE;
        }

        $bookings = $response->json('data') ?? [];
        $this->info('Total de bookings: ' . count($bookings));
        $this->newLine();

        foreach ($bookings as $b) {
            $this->line(sprintf(
                '#%s | %s | %s | %s',
                $b['id'] ?? '?',
                $b['title'] ?? '(sem título)',
                $b['start'] ?? $b['startTime'] ?? '?',
                $b['status'] ?? '?'
            ));
        }

        return self::SUCCESS;
    }
}