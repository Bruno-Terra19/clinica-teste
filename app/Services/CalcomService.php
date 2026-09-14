<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CalcomService
{
    protected string $url;
    protected string $key;

    public function __construct()
    {
        $this->url = config('services.calcom.url');
        $this->key = config('services.calcom.key');
    }

    public function getBookings(): array
    {
        $response = Http::withToken($this->key)
            ->withHeaders(['cal-api-version' => '2024-08-13'])
            ->timeout(60)
            ->retry(2, 1000)
            ->get($this->url . '/bookings');

        $response->throw();

        return $response->json('data') ?? [];
    }
}