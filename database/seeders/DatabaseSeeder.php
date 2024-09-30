<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\EventPackage;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        DB::table('badges')->insert([
            [
                'name' => 'bronze',
                'description' => 'untuk pemula',
                'min_total_transaction' => 0,
                'discount' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
        DB::table('badges')->insert([
            [
                'name' => 'silver',
                'description' => 'untuk pemula',
                'min_total_transaction' => 20000000,
                'discount' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
        DB::table('badges')->insert([
            [
                'name' => 'gold',
                'description' => 'untuk pemula',
                'min_total_transaction' => 30000000,
                'discount' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
        DB::table('users')->insert([
            [
                'name' => 'agil',
                'image'=> 'seeder\aset1.png',
                'email' => 'a@gmail.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
        DB::table('users')->insert([
            [
                'level_user' => 'admin',
                'name' => 'admin',
                'image'=> 'seeder\aset1.png',
                'email' => 'b@gmail.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
        DB::table('users')->insert([
            [
                'level_user' => 'super-admin',
                'name' => 'super admin',
                'image'=> 'seeder\aset1.png',
                'email' => 'c@gmail.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);

        DB::table('event_packages')->insert([
            'name' => 'Wedding Photo 1',
            'image' => 'seeder\aset1.png',
            'description' => "Detail\n- Photographer\n- 8 Hours of service (max)\n- Unlimited photos taken\n- Original file photos\n- 130 Edited photos\n- All files transferred via G-Drive\n\nNeed more? please check the Additional Items section",
            'price' => 1650000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('event_packages')->insert([
            'name' => 'Decor Wedding Indor',
            'image' => 'seeder\wedding2.jpeg',
            'description' => "Untuk jenis decor yang kami tawarkan pada paket ini adalah jenis indor dengan kapasitas 200 orang dengan ukuran panggung pengantin sendiri 7 meter dengan lebar 4 meter.\nspesifikasi:\ndecor ukuran\n* 7 x 4 meter [untuk indor]\n* Tulisan pengantin [bahan dasar kaca]\n* Kursi untuk mempelai\n* Sound system",
            'price' => 2850000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('event_packages')->insert([
            'name' => 'Ceremony & Reception Package',
            'image' => 'seeder\wedding3.jpeg',
            'description' => "Package Ceremony & Reception for 30 Pax\n- Mix fresh & Artificial Flowers",
            'price' => 3800000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('event_packages')->insert([
            'name' => 'Wedding Photo 2',
            'image' => 'seeder\wedding3.jpeg',
            'description' => "Package Ceremony & Reception for 30 Pax\n- Mix fresh & Artificial Flowers",
            'price' => 3800000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            ['name' => 'Photo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wedding', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Carnaval', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Party', 'created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('category_event_package')->insert([
            ['event_package_id' => 1, 'category_id' => 1],
            ['event_package_id' => 1, 'category_id' => 2], 
            ['event_package_id' => 2, 'category_id' => 2], 
            ['event_package_id' => 2, 'category_id' => 1], 
            ['event_package_id' => 3, 'category_id' => 1], 
            ['event_package_id' => 4, 'category_id' => 1], 
        ]);

        DB::table('event_packages')->insert([
            'name' => 'Luxury Wedding Photo',
            'image' => 'seeder\luxury_wedding_photo.png',
            'description' => "Detail\n- 2 Photographers\n- 12 Hours of service (max)\n- Unlimited photos taken\n- 200 Edited photos\n- Printed album included\n- All files transferred via G-Drive\n\nNeed more? Please check the Additional Items section",
            'price' => 3500000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('event_packages')->insert([
            'name' => 'Garden Wedding Decor',
            'image' => 'seeder\garden_wedding_decor.jpeg',
            'description' => "Decorasi pernikahan di area outdoor untuk kapasitas 300 orang.\nSpesifikasi:\n- Ukuran panggung 10 x 5 meter\n- Bunga asli dan artificial\n- Tulisan pengantin bahan kayu\n- Kursi mempelai dekoratif\n- Sound system premium",
            'price' => 5000000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('event_packages')->insert([
            'name' => 'Birthday Party Package',
            'image' => 'seeder\birthday_party.jpeg',
            'description' => "Paket pesta ulang tahun dengan dekorasi tema pilihan untuk anak-anak atau dewasa.\nSpesifikasi:\n- Dekorasi balon\n- 2 Fotografer\n- 4 Jam pelayanan\n- 80 Foto editan\n- Unlimited foto diambil",
            'price' => 2000000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('event_packages')->insert([
            'name' => 'Corporate Event Photography',
            'image' => 'seeder\corporate_event_photo.jpeg',
            'description' => "Paket fotografi untuk acara korporasi seperti seminar, gala dinner, dan pertemuan penting.\nSpesifikasi:\n- 1 Fotografer\n- 6 Jam pelayanan\n- Unlimited foto diambil\n- 150 Foto editan",
            'price' => 2500000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('event_packages')->insert([
            'name' => 'Wedding Video Package',
            'image' => 'seeder\wedding_video.jpeg',
            'description' => "Paket video pernikahan profesional.\nSpesifikasi:\n- 2 Videographer\n- 10 Jam pelayanan\n- 5 Menit highlight video\n- 1 Video full coverage\n- Drone footage (optional)",
            'price' => 6000000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('event_packages')->insert([
            'name' => 'Carnaval Full Service',
            'image' => 'seeder\carnaval_full_service.jpeg',
            'description' => "Paket lengkap untuk acara karnaval.\nSpesifikasi:\n- Dekorasi besar\n- 3 Fotografer\n- 12 Jam pelayanan\n- Full sound system dan panggung besar",
            'price' => 7500000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('event_packages')->insert([
            'name' => 'Premium Wedding Package',
            'image' => 'seeder\premium_wedding_package.jpeg',
            'description' => "Paket pernikahan premium dengan layanan lengkap mulai dari dekorasi hingga fotografi dan videografi.\nSpesifikasi:\n- Dekorasi mewah\n- 2 Fotografer dan 1 Videografer\n- 12 Jam pelayanan\n- 300 Foto editan\n- Highlight video dan full coverage",
            'price' => 12000000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Insert untuk categories
        DB::table('categories')->insert([
            ['name' => 'Corporate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Birthday', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        // Insert untuk category_event_package (relasi)
        DB::table('category_event_package')->insert([
            ['event_package_id' => 5, 'category_id' => 1], // Luxury Wedding Photo - Photo
            ['event_package_id' => 6, 'category_id' => 2], // Garden Wedding Decor - Wedding
            ['event_package_id' => 7, 'category_id' => 4], // Birthday Party Package - Party
            ['event_package_id' => 8, 'category_id' => 1], // Corporate Event Photography - Corporate
            ['event_package_id' => 9, 'category_id' => 2], // Wedding Video Package - Wedding
            ['event_package_id' => 10, 'category_id' => 3], // Carnaval Full Service - Carnaval
            ['event_package_id' => 11, 'category_id' => 2], // Premium Wedding Package - Wedding
        ]);

        // Hitung total users dan event packages
        $userCount = User::count();
        $eventPackageCount = EventPackage::count();

        // Loop untuk membuat 50 orders dummy
        for ($i = 0; $i < 50; $i++) {
            // Ambil event package secara acak
            $event_package_id = rand(1, $eventPackageCount);
            
            // Ambil harga berdasarkan event package yang dipilih
            $eventPackage = EventPackage::find($event_package_id);
            $price = $eventPackage->price;

            // Buat order dummy
            Order::create([
                'user_id' => rand(1, $userCount),
                'address' => 'Jl. Dummy No ' . rand(1, 100),
                'event_package_id' => $event_package_id,
                'event_date' => Carbon::now()->addDays(rand(1, 30)), // Tanggal event acak di masa depan
                'price' => $price,
                'status' => ['Pending', 'Confirmed', 'Completed', 'Failed'][rand(0, 3)], // Status acak
                'created_at' => Carbon::now()->subDays(rand(0, 30)), // Tanggal dibuat acak dalam 30 hari terakhir
                'updated_at' => Carbon::now(),
            ]);
        }

        // Update badge untuk setiap user
        $users = User::all();

        foreach ($users as $user) {
            // Hitung total transaksi berhasil (order dengan status 'Completed') untuk setiap user
            $completedOrdersTotal = Order::where('user_id', $user->id)
                                        ->where('status', 'Completed')
                                        ->sum('price');
            
            // Ambil badge yang sesuai berdasarkan total transaksi
            $badgeId = Badge::where('min_total_transaction', '<=', $completedOrdersTotal)
                ->orderBy('min_total_transaction', 'desc')
                ->value('id');  // Ambil nilai kolom 'id'

            // Update user dengan badge yang sesuai dan total sukses transaksi
            $user->update([
                'badge_id' => $badgeId, // Set badge_id yang cocok, atau null/default jika tidak ada yang cocok
                'total_success_transaction' => $completedOrdersTotal,
            ]);
        }
    }
}
