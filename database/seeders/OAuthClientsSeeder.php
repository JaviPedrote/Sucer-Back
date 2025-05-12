<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAuthClientsSeeder extends Seeder
{
    public function run(): void
    {
        $id     = (int) env('PASSPORT_PASSWORD_CLIENT_ID');
        $secret = env('PASSPORT_PASSWORD_CLIENT_SECRET');

        // Asegúrate de que las vars están definidas
        if (! $id || ! $secret) {
            $this->command->warn('OAuth client seed skipped: missing env variables.');
            return;
        }

        DB::table('oauth_clients')->updateOrInsert(
            ['id' => $id],
            [
                'user_id'               => null,
                'name'                  => 'Password Grant Client',
                'secret'                => $secret,
                'provider'              => 'users',
                'redirect'              => env('APP_URL'),
                'personal_access_client'=> 0,
                'password_client'       => 1,
                'revoked'               => 0,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]
        );

        $this->command->info("OAuth client with ID {$id} seeded.");
    }
}
