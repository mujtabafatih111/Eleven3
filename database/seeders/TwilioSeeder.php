<?php

namespace Database\Seeders;

use App\Models\TwilioAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TwilioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->twilio();
    }

    public  function twilio()
    {
        TwilioAccount::create([
            'type' => 'sandbox',
            "twilio_account_sid" => "AC0e0be26c25b7d63be287c6102823ecd0",
            "twilio_auth_token" => "34adc8801ae9f9759343e27ea17e0f80",
            'twilio_from' => "+14846235814",
            'status' => TwilioAccount::STATUS_ACTIVE
        ]);
    }
}
