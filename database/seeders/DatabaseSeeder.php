<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin Req-U',
            'email' => 'admin@requ.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Organizer
        $organizer = User::create([
            'name' => 'Himpunan Mahasiswa',
            'email' => 'hima@requ.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
        ]);

        // Create Student
        $student = User::create([
            'name' => 'John Student',
            'email' => 'student@requ.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create Sample Posts
        Post::create([
            'user_id' => $organizer->id,
            'judul' => 'Open Recruitment Himpunan 2025',
            'deskripsi' => 'Himpunan Mahasiswa membuka kesempatan bagi mahasiswa baru untuk bergabung! Dapatkan pengalaman organisasi, networking, dan kembangkan skill kepemimpinan Anda.',
            'kategori' => 'Organisasi',
            'deadline' => now()->addDays(14),
            'link_pendaftaran' => 'https://forms.google.com/sample',
            'status' => 'approved',
        ]);

        Post::create([
            'user_id' => $organizer->id,
            'judul' => 'Panitia Seminar Nasional IT 2025',
            'deskripsi' => 'Bergabunglah sebagai panitia dalam acara Seminar Nasional IT terbesar tahun ini! Kesempatan emas untuk belajar event management dan bertemu dengan para profesional IT.',
            'kategori' => 'Kepanitiaan',
            'deadline' => now()->addDays(7),
            'link_pendaftaran' => 'https://forms.google.com/sample2',
            'status' => 'approved',
        ]);

        Post::create([
            'user_id' => $student->id,
            'judul' => 'Asisten Laboratorium Pemrograman',
            'deskripsi' => 'Laboratorium Pemrograman membuka lowongan untuk asisten praktikum. Syarat: IPK min 3.5, menguasai Java dan Python.',
            'kategori' => 'Laboratorium',
            'deadline' => now()->addDays(10),
            'link_pendaftaran' => 'https://forms.google.com/sample3',
            'status' => 'pending',
        ]);

        echo "✓ Database seeded successfully!\n";
        echo "Admin: admin@requ.com / password\n";
        echo "Organizer: hima@requ.com / password\n";
        echo "Student: student@requ.com / password\n";
    }
}
