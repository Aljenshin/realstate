<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GintoLand Homes') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .bg-gradient-hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
            .glass-effect { background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(10px); }
            .parallax-slow { transform: translateY(var(--scroll-slow, 0)); transition: transform 0.1s linear; }
            .parallax-medium { transform: translateY(var(--scroll-medium, 0)); transition: transform 0.1s linear; }
            .parallax-fast { transform: translateY(var(--scroll-fast, 0)); transition: transform 0.1s linear; }
        </style>
    </head>
    <body class="font-inter text-gray-900 antialiased bg-gray-50">
        <!-- Utility/top bar -->
        <div class="w-full border-b bg-white/70 backdrop-blur">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-12 flex items-center justify-between text-sm">
                <div class="flex items-center gap-3">
                    <a href="/" class="flex items-center gap-2">
                        <span class="text-2xl font-bold font-playfair">GintoLand Homes</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center gap-6">
                    <span>CONTACT US:</span>
                    <a href="mailto:aljen.mondarte@gmail.com" class="underline">EMAIL</a>
                    <a href="tel:09159454127" class="underline">09159454127</a>
                </div>
            </div>
        </div>

        <!-- Main nav with chips -->
        <nav class="bg-white/80 backdrop-blur border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="hidden md:flex items-center gap-4 h-12 text-sm">
                    <a href="#" class="px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">Search</a>
                    <a href="#" class="px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">Buying</a>
                    <a href="#" class="px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">Selling</a>
                    <a href="#" class="px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">Home Values</a>
                    <a href="#" class="px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">Careers</a>
                    <a href="#" class="px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">Mortgage</a>
                    <a href="#contact" class="px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">Contact</a>
                </div>
            </div>
        </nav>

        <!-- Parallax hero -->
        <section class="relative h-56 sm:h-64 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-hero"></div>
            <img src="https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1600&q=80" alt="Hero Home" class="parallax-slow absolute left-8 top-6 w-60 h-36 object-cover rounded-2xl shadow-2xl opacity-90">
            <img src="https://images.unsplash.com/photo-1560185008-b033106af14f?auto=format&fit=crop&w=1200&q=80" alt="Living Room" class="parallax-medium absolute right-10 top-14 w-64 h-40 object-cover rounded-2xl shadow-xl opacity-80">
            <img src="https://images.unsplash.com/photo-1600585154515-011c3b81a6ff?auto=format&fit=crop&w=1200&q=80" alt="Kitchen" class="parallax-fast absolute left-1/2 -translate-x-1/2 bottom-0 w-72 h-44 object-cover rounded-2xl shadow-xl opacity-80">
            <div class="absolute -bottom-10 -left-10 w-56 h-56 bg-white/20 rounded-full blur-2xl"></div>
            <div class="absolute -top-16 -right-16 w-72 h-72 bg-white/20 rounded-full blur-2xl"></div>
        </section>

        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 -mt-16">
            <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white/90 backdrop-blur shadow-xl overflow-hidden rounded-2xl">
                {{ $slot }}
            </div>
        </div>

        <!-- Auth Modal -->
        <div id="authModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/60" onclick="closeAuthModal()"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
                <!-- Left image -->
                <div class="hidden md:block relative">
                    <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=80" alt="Auth" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
                <!-- Right forms -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex gap-2">
                            <button id="tabLogin" class="px-4 py-2 rounded-full bg-gray-900 text-white text-sm" onclick="switchAuthTab('login')">Log in</button>
                            <button id="tabRegister" class="px-4 py-2 rounded-full bg-gray-200 text-gray-800 text-sm" onclick="switchAuthTab('register')">Sign up</button>
                        </div>
                        <button onclick="closeAuthModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
                    </div>
                    <!-- Login form -->
                    <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="text-sm font-medium">Email</label>
                            <input type="email" name="email" required class="mt-1 w-full border rounded-lg px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Password</label>
                            <input type="password" name="password" required class="mt-1 w-full border rounded-lg px-3 py-2" />
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="inline-flex items-center text-sm"><input type="checkbox" name="remember" class="mr-2">Remember me</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm underline">Forgot password?</a>
                            @endif
                        </div>
                        <button class="w-full bg-gradient-hero text-white py-2 rounded-lg">Log in</button>
                    </form>
                    <!-- Register form -->
                    <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4 hidden">
                        @csrf
                        <div>
                            <label class="text-sm font-medium">Username</label>
                            <input type="text" name="name" required class="mt-1 w-full border rounded-lg px-3 py-2" />
                            <p class="text-xs text-gray-500 mt-1">Must be unique.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Email</label>
                            <input type="email" name="email" required class="mt-1 w-full border rounded-lg px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Password (8–10)</label>
                            <input type="password" name="password" required class="mt-1 w-full border rounded-lg px-3 py-2" />
                        </div>
                        <div>
                            <label class="text-sm font-medium">Confirm Password</label>
                            <input type="password" name="password_confirmation" required class="mt-1 w-full border rounded-lg px-3 py-2" />
                        </div>
                        <button class="w-full bg-gradient-hero text-white py-2 rounded-lg">Create account</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // Parallax on auth pages
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                const rate2 = scrolled * -0.3;
                const rate3 = scrolled * -0.1;
                document.documentElement.style.setProperty('--scroll-slow', `${rate3}px`);
                document.documentElement.style.setProperty('--scroll-medium', `${rate2}px`);
                document.documentElement.style.setProperty('--scroll-fast', `${rate}px`);
            });
            // Modal open/close helpers
            function openAuthModal(which = 'login') {
                const modal = document.getElementById('authModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                switchAuthTab(which);
            }
            function closeAuthModal() {
                const modal = document.getElementById('authModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
            function switchAuthTab(which) {
                const loginForm = document.getElementById('loginForm');
                const registerForm = document.getElementById('registerForm');
                const tabLogin = document.getElementById('tabLogin');
                const tabRegister = document.getElementById('tabRegister');
                if (which === 'login') {
                    loginForm.classList.remove('hidden');
                    registerForm.classList.add('hidden');
                    tabLogin.classList.add('bg-gray-900','text-white');
                    tabRegister.classList.remove('bg-gray-900','text-white');
                    tabRegister.classList.add('bg-gray-200','text-gray-800');
                } else {
                    registerForm.classList.remove('hidden');
                    loginForm.classList.add('hidden');
                    tabRegister.classList.add('bg-gray-900','text-white');
                    tabLogin.classList.remove('bg-gray-900','text-white');
                    tabLogin.classList.add('bg-gray-200','text-gray-800');
                }
            }
            window.openAuthModal = openAuthModal;
            // initialize parallax on load
            window.dispatchEvent(new Event('scroll'));
        </script>
    </body>
</html>
