<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Req-U - Student Event & Recruitment Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .gradient-animation {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 gradient-animation overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -left-40 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-10 px-6 py-6">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 11V7h4v4H8z"/>
                    </svg>
                    <span class="text-3xl font-bold text-white">Req-U</span>
                </div>
                <div class="flex space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-100 transition shadow-lg">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-3 bg-white/20 text-white font-semibold rounded-lg hover:bg-white/30 transition backdrop-blur-sm">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-100 transition shadow-lg">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 pt-20 pb-32 text-center">
            <div class="float-animation">
                <h1 class="text-6xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    Discover Your Next
                    <span class="block bg-gradient-to-r from-yellow-300 to-pink-300 bg-clip-text text-transparent">
                        Opportunity
                    </span>
                </h1>
            </div>
            
            <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto">
                Platform terpadu untuk mahasiswa menemukan event, organisasi, dan kesempatan bergabung dengan kepanitiaan & laboratorium
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-indigo-600 font-bold rounded-lg hover:bg-gray-100 transition shadow-2xl transform hover:scale-105 text-lg">
                    🚀 Start Exploring
                </a>
                <a href="#features" class="px-8 py-4 bg-white/20 text-white font-bold rounded-lg hover:bg-white/30 transition backdrop-blur-sm text-lg">
                    Learn More
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20 max-w-4xl mx-auto">
                <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                    <div class="text-4xl font-bold text-white mb-2">100+</div>
                    <div class="text-white/80">Active Events</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                    <div class="text-4xl font-bold text-white mb-2">50+</div>
                    <div class="text-white/80">Organizations</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                    <div class="text-4xl font-bold text-white mb-2">1000+</div>
                    <div class="text-white/80">Students</div>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Why Choose <span class="text-indigo-600">Req-U</span>?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Platform all-in-one untuk semua kebutuhan event dan rekrutmen mahasiswa
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Smart Search</h3>
                    <p class="text-gray-600">
                        Temukan event dengan mudah menggunakan filter kategori, pencarian, dan sorting berdasarkan deadline
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Bookmark System</h3>
                    <p class="text-gray-600">
                        Simpan event favorit untuk diakses kembali tanpa perlu mencari ulang
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-green-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Real-time Notifications</h3>
                    <p class="text-gray-600">
                        Dapatkan notifikasi langsung saat postingan Anda disetujui atau ditolak admin
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-orange-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Easy Post Management</h3>
                    <p class="text-gray-600">
                        Organisasi dapat dengan mudah membuat, edit, dan mengelola postingan event mereka
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-2xl p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-cyan-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Admin Verification</h3>
                    <p class="text-gray-600">
                        Semua postingan diverifikasi oleh admin untuk memastikan kualitas dan keamanan
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-pink-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Deadline Tracking</h3>
                    <p class="text-gray-600">
                        Lihat countdown deadline dan jangan lewatkan kesempatan untuk mendaftar
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Explore by <span class="text-indigo-600">Category</span>
                </h2>
                <p class="text-xl text-gray-600">
                    Temukan kesempatan sesuai minat Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-6xl mb-4">🎪</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Kepanitiaan</h3>
                    <p class="text-gray-600 mb-4">
                        Bergabung dengan panitia event besar dan dapatkan pengalaman event management
                    </p>
                    <div class="flex items-center text-blue-600 font-semibold">
                        Explore →
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-6xl mb-4">👥</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Organisasi</h3>
                    <p class="text-gray-600 mb-4">
                        Temukan organisasi yang sesuai dengan passion dan kembangkan skill leadership
                    </p>
                    <div class="flex items-center text-green-600 font-semibold">
                        Explore →
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-6xl mb-4">🔬</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Laboratorium</h3>
                    <p class="text-gray-600 mb-4">
                        Jadi asisten lab dan tingkatkan kemampuan teknis serta akademis Anda
                    </p>
                    <div class="flex items-center text-purple-600 font-semibold">
                        Explore →
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-6xl mb-4">🎤</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Seminar</h3>
                    <p class="text-gray-600 mb-4">
                        Perluas wawasan Anda dengan mengikuti berbagai seminar dan workshop menarik
                    </p>
                    <div class="flex items-center text-orange-600 font-semibold">
                        Explore →
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-6xl mb-4">🏆</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Lomba</h3>
                    <p class="text-gray-600 mb-4">
                        Tantang diri Anda dan raih prestasi di berbagai kompetisi mahasiswa
                    </p>
                    <div class="flex items-center text-red-600 font-semibold">
                        Explore →
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-6xl mb-4">🏢</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Event Kampus</h3>
                    <p class="text-gray-600 mb-4">
                        Ikuti berbagai keseruan event yang diselenggarakan langsung di lingkungan kampus
                    </p>
                    <div class="flex items-center text-pink-600 font-semibold">
                        Explore →
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Ready to Start Your Journey?
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Bergabunglah dengan ribuan mahasiswa lainnya dan temukan kesempatan terbaik untuk berkembang
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-indigo-600 font-bold rounded-lg hover:bg-gray-100 transition shadow-2xl transform hover:scale-105 text-lg">
                    Create Free Account
                </a>
                <a href="{{ route('login') }}" class="px-8 py-4 bg-white/20 text-white font-bold rounded-lg hover:bg-white/30 transition backdrop-blur-sm text-lg">
                    Sign In
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 11V7h4v4H8z"/>
                        </svg>
                        <span class="text-2xl font-bold">Req-U</span>
                    </div>
                    <p class="text-gray-400">
                        Platform terpadu untuk manajemen event dan rekrutmen khusus mahasiswa Telkom University
                    </p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Platform</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Features</a></li>
                        <li><a href="#" class="hover:text-white transition">Categories</a></li>
                        <li><a href="#" class="hover:text-white transition">How it Works</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Legal</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Req-U. Made with ❤️ for Telyutizen.</p>
            </div>
        </div>
    </footer>
</body>
</html>
