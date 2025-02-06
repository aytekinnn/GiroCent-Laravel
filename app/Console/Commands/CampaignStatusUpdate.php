<?php

namespace App\Console\Commands;

use App\Models\Campaigns;
use Illuminate\Console\Command;

class CampaignStatusUpdate extends Command
{
    protected $signature = 'campaigns:update-status'; // Komutun adı
    protected $description = 'Update campaign status to 0 if end_date has passed'; // Açıklama

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // End date'i geçmiş olan tüm kampanyaları al
        $campaigns = Campaigns::where('end_date', '<=', now()) // end_date şu anki zamandan küçük olmalı
        ->where('status', '!=', 0) // status zaten 0 olanları almayalım
        ->get();

        foreach ($campaigns as $campaign) {
            $campaign->status = 0; // Status'u 0 olarak güncelle
            $campaign->save(); // Kaydet
            $this->info("Campaign ID {$campaign->id} status updated to 0");
        }
    }
}
