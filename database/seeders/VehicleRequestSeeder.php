<?php

namespace Database\Seeders;

use App\Models\VehicleRequest;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VehicleRequestSeeder extends Seeder
{
    public function run(): void
    {
        $requests = [
            [
                'borrower_id' => 3,
                'vehicle_id' => 1,
                'driver_id' => 5,
                'destination' => 'Jakarta Selatan - Meeting Client',
                'purpose' => 'Meeting dengan klien untuk discuss project baru',
                'start_datetime' => Carbon::now()->addDays(1)->setHour(8)->setMinute(0),
                'end_datetime' => Carbon::now()->addDays(1)->setHour(17)->setMinute(0),
                'status' => 'completed',
                'admin_notes' => 'Disetujui untuk penggunaan besok',
                'assigned_by' => 1,
                'approved_by' => 2,
            ],
            [
                'borrower_id' => 4,
                'vehicle_id' => 3,
                'driver_id' => null,
                'destination' => 'Bandung - Pengiriman Dokumen',
                'purpose' => 'Pengiriman dokumen kontrak ke kantor cabang Bandung',
                'start_datetime' => Carbon::now()->addDays(2)->setHour(9)->setMinute(0),
                'end_datetime' => Carbon::now()->addDays(2)->setHour(18)->setMinute(0),
                'status' => 'admin_approved',
                'admin_notes' => 'Van tersedia untuk digunakan',
                'assigned_by' => 1,
                'approved_by' => 2,
            ],
            [
                'borrower_id' => 9,
                'vehicle_id' => null,
                'driver_id' => null,
                'destination' => 'Surabaya - Workshop',
                'purpose' => 'Mengikuti workshop teknologi informasi',
                'start_datetime' => Carbon::now()->addDays(3)->setHour(7)->setMinute(0),
                'end_datetime' => Carbon::now()->addDays(4)->setHour(20)->setMinute(0),
                'status' => 'supervisor_approved',
                'supervisor_notes' => 'Disetujui, menunggu penugasan kendaraan oleh admin',
                'approved_by' => 2,
            ],
            [
                'borrower_id' => 10,
                'vehicle_id' => null,
                'driver_id' => null,
                'destination' => 'Medan - Visit Toko',
                'purpose' => 'Kunjungan evaluasi kinerja toko cabang Medan',
                'start_datetime' => Carbon::now()->addDays(5)->setHour(6)->setMinute(0),
                'end_datetime' => Carbon::now()->addDays(7)->setHour(22)->setMinute(0),
                'status' => 'pending',
                'supervisor_notes' => null,
            ],
            [
                'borrower_id' => 3,
                'vehicle_id' => 2,
                'driver_id' => 6,
                'destination' => 'Tangerang - Expo',
                'purpose' => 'Mengikuti pameran bisnis tahunan',
                'start_datetime' => Carbon::now()->subDays(2)->setHour(8)->setMinute(0),
                'end_datetime' => Carbon::now()->subDays(1)->setHour(18)->setMinute(0),
                'status' => 'completed',
                'admin_notes' => 'Pelanggan berhasil closing deal di expo',
                'assigned_by' => 1,
                'approved_by' => 2,
            ],
            [
                'borrower_id' => 4,
                'vehicle_id' => null,
                'driver_id' => null,
                'destination' => 'Yogyakarta - Training',
                'purpose' => 'Pelatihan kepemimpinan untuk karyawan',
                'start_datetime' => Carbon::now()->addDays(7)->setHour(7)->setMinute(0),
                'end_datetime' => Carbon::now()->addDays(9)->setHour(17)->setMinute(0),
                'status' => 'pending',
                'supervisor_notes' => null,
            ],
            [
                'borrower_id' => 9,
                'vehicle_id' => 7,
                'driver_id' => null,
                'destination' => 'Bekasi - Pengiriman Barang',
                'purpose' => 'Mengantar barang sample ke customer',
                'start_datetime' => Carbon::now()->subDays(5)->setHour(10)->setMinute(0),
                'end_datetime' => Carbon::now()->subDays(5)->setHour(15)->setMinute(0),
                'status' => 'completed',
                'admin_notes' => 'Pengiriman berhasil',
                'assigned_by' => 1,
                'approved_by' => 8,
            ],
            [
                'borrower_id' => 10,
                'vehicle_id' => null,
                'driver_id' => null,
                'destination' => 'Semarang - Audit',
                'purpose' => 'Audit internal cabang Semarang',
                'start_datetime' => Carbon::now()->addDays(10)->setHour(8)->setMinute(0),
                'end_datetime' => Carbon::now()->addDays(12)->setHour(17)->setMinute(0),
                'status' => 'supervisor_rejected',
                'supervisor_notes' => 'Jadwal bersamaan dengan audit lain, please reschedule',
                'approved_by' => 2,
            ],
        ];

        foreach ($requests as $request) {
            VehicleRequest::create($request);
        }

        $this->command->info('Vehicle requests seeded successfully!');
    }
}