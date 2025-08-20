<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GintoLand Homes - Premium Real Estate</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .font-inter { font-family: 'Inter', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        
        .parallax-slow { transform: translateY(var(--scroll-slow, 0)); }
        .parallax-medium { transform: translateY(var(--scroll-medium, 0)); }
        .parallax-fast { transform: translateY(var(--scroll-fast, 0)); }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .glass-effect {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .bg-gradient-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .bg-gradient-luxury {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        .z-5 {
            z-index: 5;
        }
        
        .z-10 {
            z-index: 10;
        }
        
        .z-20 {
            z-index: 20;
        }
        
        .z-30 {
            z-index: 30;
        }
        
        .z-40 {
            z-index: 40;
        }
        
        .z-50 {
            z-index: 50;
        }
    </style>
</head>
<body class="font-inter bg-gray-50 text-gray-900 overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 glass-effect" style="z-index: 100;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <h1 class="text-2xl font-bold text-gradient font-playfair">GintoLand Homes</h1>
                </div>
                
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#home" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">Home</a>
                        <a href="#properties" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">Properties</a>
                        <a href="#services" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">Services</a>
                        <a href="#about" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">About</a>
                        <a href="#agents" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">Agents</a>
                        <a href="#contact" class="bg-gradient-hero text-white px-6 py-2 rounded-full text-sm font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">Contact</a>
                        @auth
                            <div class="relative group">
                                <button class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Hi, {{ auth()->user()->name }}</button>
                                <div class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border opacity-0 group-hover:opacity-100 invisible group-hover:visible transition">
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Dashboard</a>
                                    <form method="POST" action="{{ route('logout') }}" class="border-t">
                                        @csrf
                                        <button class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium">Register</a>
                        @endauth
                    </div>
                </div>
                
                                 <!-- Mobile menu button -->
                 <div class="md:hidden">
                     <button onclick="toggleMobileMenu()" type="button" class="text-gray-700 hover:text-gray-900">
                         <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                         </svg>
                     </button>
                 </div>
             </div>
             
             <!-- Mobile menu -->
             <div id="mobileMenu" class="md:hidden hidden">
                 <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white rounded-lg mt-2 shadow-lg">
                     <a href="#home" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">Home</a>
                     <a href="#properties" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">Properties</a>
                     <a href="#services" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">Services</a>
                     <a href="#about" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">About</a>
                     <a href="#agents" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">Agents</a>
                     <a href="#market" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">Search</a>
                     <a href="#buying" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">Buying</a>
                     <a href="#selling" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">Selling</a>
                     <a href="#home-values" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">Home Values</a>
                     <a href="#careers" onclick="closeMobileMenu()" class="text-gray-700 hover:text-gray-900 block px-3 py-2 text-base font-medium transition-colors">Careers</a>
                     <a href="#contact" onclick="closeMobileMenu()" class="bg-gradient-hero text-white px-6 py-2 rounded-full text-base font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105 block text-center">Contact</a>
                 </div>
             </div>
            </div>
        </div>
    </nav>

    <!-- Toast for login success -->
    @if (session('login_success'))
    <div class="fixed top-20 right-6 z-50">
        <div class="bg-white border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-lg">
            {{ session('login_success') }}
        </div>
    </div>
    @endif

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background with parallax effect -->
        <div class="absolute inset-0 parallax-slow">
            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2053&q=80" 
                 alt="Luxury Modern House" 
                 class="w-full h-full object-cover"
                 fetchpriority="high">
            <div class="absolute inset-0 bg-gradient-hero opacity-70"></div>
        </div>
        <!-- Decorative parallax cards -->
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80" class="hidden md:block absolute left-10 bottom-20 w-64 h-40 object-cover rounded-2xl shadow-xl parallax-medium" alt="living">
        <img src="https://images.unsplash.com/photo-1600585154515-011c3b81a6ff?auto=format&fit=crop&w=1200&q=80" class="hidden md:block absolute right-14 top-28 w-72 h-48 object-cover rounded-2xl shadow-xl parallax-fast" alt="kitchen">
        
        <!-- Content -->
        <div class="relative" style="z-index: 10; text-align: center; color: white; padding: 0 1rem; max-width: 72rem; margin: 0 auto;">
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold font-playfair mb-6 leading-tight">
                Find Your
                <span class="block">Dream Home</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto">
                Discover premium properties in the most desirable locations. 
                We're more than just real estate—we're your gateway to a new lifestyle.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button onclick="scrollToSection('properties')" class="bg-white text-gray-900 px-8 py-4 rounded-full font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    Explore Properties
                </button>
                <button onclick="openAuthModal('register')" class="glass-effect text-white px-8 py-4 rounded-full font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    Create Account
                </button>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white opacity-70">
            <div class="flex flex-col items-center">
                <span class="text-sm mb-2">Scroll to explore</span>
                <div class="animate-bounce">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Properties Section -->
    <section id="properties" class="py-20 relative" style="z-index: 5;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                         <div class="text-center mb-16 scroll-reveal">
                 <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">
                     Featured Properties
                 </h2>
                 <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8">
                     Curated selection of premium properties that define luxury living
                 </p>
                 
                 <!-- Property Search/Filter -->
                 <div class="max-w-4xl mx-auto mb-12">
                     <div class="bg-white rounded-2xl shadow-xl p-6">
                         <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                             <div>
                                 <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                 <select id="locationFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                     <option value="">All Locations</option>
                                     <option value="Makati">Makati City</option>
                                     <option value="BGC">Bonifacio Global City</option>
                                     <option value="Alabang">Alabang</option>
                                     <option value="Boracay">Boracay Island</option>
                                     <option value="Forbes">Forbes Park</option>
                                     <option value="Eastwood">Eastwood City</option>
                                 </select>
                             </div>
                             <div>
                                 <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                                 <select id="priceFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                     <option value="">All Prices</option>
                                     <option value="0-50">Under ₱50M</option>
                                     <option value="50-100">₱50M - ₱100M</option>
                                     <option value="100-200">₱100M - ₱200M</option>
                                     <option value="200+">Over ₱200M</option>
                                 </select>
                             </div>
                             <div>
                                 <label class="block text-sm font-medium text-gray-700 mb-2">Property Type</label>
                                 <select id="typeFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                     <option value="">All Types</option>
                                     <option value="Villa">Villa</option>
                                     <option value="Penthouse">Penthouse</option>
                                     <option value="Estate">Estate</option>
                                     <option value="House">House</option>
                                     <option value="Mansion">Mansion</option>
                                     <option value="Townhouse">Townhouse</option>
                                 </select>
                             </div>
                             <div class="flex items-end">
                                 <button onclick="filterProperties()" class="w-full bg-gradient-hero text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                     Search
                                 </button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- Property 1 -->
                <div class="scroll-reveal glass-effect rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2075&q=80" 
                             alt="Modern Villa in Beverly Hills" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy" decoding="async">
                        <div class="absolute top-4 right-4 bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            ₱125M
                        </div>
                        <div class="absolute top-4 left-4 bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            For Sale
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Modern Villa</h3>
                        <p class="text-gray-600 mb-4">Makati City, Metro Manila</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>4 Beds</span>
                            <span>3 Baths</span>
                            <span>300 sq m</span>
                        </div>
                                                 <div class="flex gap-2">
                             <button onclick="openPropertyInquiry('Modern Villa', '₱125M', 'Makati City')" class="flex-1 bg-gradient-hero text-white py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                 Inquire Now
                             </button>
                                                           <button onclick="openPropertyGallery('Modern Villa', ['https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=2075&q=80', 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=2053&q=80', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1565182999561-18d7f0b9f6c4?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1505691723518-36a5ac3b2d8d?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1493666438817-866a91353ca9?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1560448075-bb4caa6c0f11?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=2070&q=80'])" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-300">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                 </svg>
                             </button>
                         </div>
                    </div>
                </div>
                
                <!-- Property 2 -->
                <div class="scroll-reveal glass-effect rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 group" style="animation-delay: 0.2s;">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Luxury Penthouse in Manhattan" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy" decoding="async">
                        <div class="absolute top-4 right-4 bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            ₱90M
                        </div>
                        <div class="absolute top-4 left-4 bg-blue-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            Luxury
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Luxury Penthouse</h3>
                        <p class="text-gray-600 mb-4">Bonifacio Global City, Taguig</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>3 Beds</span>
                            <span>2 Baths</span>
                            <span>260 sq m</span>
                        </div>
                                                 <div class="flex gap-2">
                             <button onclick="openPropertyInquiry('Luxury Penthouse', '₱90M', 'Bonifacio Global City')" class="flex-1 bg-gradient-hero text-white py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                 Inquire Now
                             </button>
                             <button onclick="openPropertyGallery('Luxury Penthouse', ['https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2053&q=80', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'])" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-300">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                 </svg>
                             </button>
                         </div>
                    </div>
                </div>
                
                <!-- Property 3 -->
                <div class="scroll-reveal glass-effect rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 group" style="animation-delay: 0.4s;">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80" 
                             alt="Beachfront Estate in Malibu" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy" decoding="async">
                        <div class="absolute top-4 right-4 bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            ₱160M
                        </div>
                        <div class="absolute top-4 left-4 bg-orange-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            Oceanview
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Beachfront Estate</h3>
                        <p class="text-gray-600 mb-4">Boracay Island, Aklan</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>5 Beds</span>
                            <span>4 Baths</span>
                            <span>420 sq m</span>
                        </div>
                                                 <div class="flex gap-2">
                             <button onclick="openPropertyInquiry('Beachfront Estate', '₱160M', 'Boracay Island')" class="flex-1 bg-gradient-hero text-white py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                 Inquire Now
                             </button>
                             <button onclick="openPropertyGallery('Beachfront Estate', ['https://images.unsplash.com/photo-1613490493576-7fde63acd811?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80', 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2053&q=80', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'])" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-300">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                 </svg>
                             </button>
                         </div>
                    </div>
                </div>
            </div>
            
            <!-- Additional Properties Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- Property 4 -->
                <div class="scroll-reveal glass-effect rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 group" style="animation-delay: 0.6s;">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Contemporary House with Pool" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy" decoding="async">
                        <div class="absolute top-4 right-4 bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            ₱60M
                        </div>
                        <div class="absolute top-4 left-4 bg-purple-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            New Listing
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Contemporary House</h3>
                        <p class="text-gray-600 mb-4">Alabang, Muntinlupa</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>3 Beds</span>
                            <span>2 Baths</span>
                            <span>195 sq m</span>
                        </div>
                                                 <div class="flex gap-2">
                             <button onclick="openPropertyInquiry('Contemporary House', '₱60M', 'Alabang')" class="flex-1 bg-gradient-hero text-white py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                 Inquire Now
                             </button>
                             <button onclick="openPropertyGallery('Contemporary House', ['https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2053&q=80', 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1565182999561-18d7f0b9f6c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1505691723518-36a5ac3b2d8d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1493666438817-866a91353ca9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1554995207-c18c203602cb?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1560448075-bb4caa6c0f11?auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=2070&q=80'])" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </button>
                         </div>
                    </div>
                </div>
                
                <!-- Property 5 -->
                <div class="scroll-reveal glass-effect rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 group" style="animation-delay: 0.8s;">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Luxury Mansion with Garden" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy" decoding="async">
                        <div class="absolute top-4 right-4 bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            ₱240M
                        </div>
                        <div class="absolute top-4 left-4 bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            Premium
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Luxury Mansion</h3>
                        <p class="text-gray-600 mb-4">Forbes Park, Makati</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>6 Beds</span>
                            <span>5 Baths</span>
                            <span>630 sq m</span>
                        </div>
                                                 <div class="flex gap-2">
                             <button onclick="openPropertyInquiry('Luxury Mansion', '₱240M', 'Forbes Park')" class="flex-1 bg-gradient-hero text-white py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                 Inquire Now
                             </button>
                             <button onclick="openPropertyGallery('Luxury Mansion', ['https://images.unsplash.com/photo-1568605114967-8130f3a36994?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2053&q=80', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'])" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-300">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                 </svg>
                             </button>
                         </div>
                    </div>
                </div>
                
                <!-- Property 6 -->
                <div class="scroll-reveal glass-effect rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 group" style="animation-delay: 1.0s;">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Modern Townhouse" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                             loading="lazy" decoding="async">
                        <div class="absolute top-4 right-4 bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            ₱42M
                        </div>
                        <div class="absolute top-4 left-4 bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            Best Value
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Modern Townhouse</h3>
                        <p class="text-gray-600 mb-4">Eastwood City, Quezon City</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>2 Beds</span>
                            <span>2 Baths</span>
                            <span>167 sq m</span>
                        </div>
                                                 <div class="flex gap-2">
                             <button onclick="openPropertyInquiry('Modern Townhouse', '₱42M', 'Eastwood City')" class="flex-1 bg-gradient-hero text-white py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                 Inquire Now
                             </button>
                             <button onclick="openPropertyGallery('Modern Townhouse', ['https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2053&q=80', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'])" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-300">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                 </svg>
                             </button>
                         </div>
                    </div>
                </div>
            </div>
            
            <!-- View All Properties Button -->
            <div class="text-center">
                <button onclick="openAllPropertiesModal()" class="bg-gradient-hero text-white px-8 py-4 rounded-full font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    View All Properties
                </button>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-white relative" style="z-index: 5;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">
                    Our Services
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Comprehensive real estate solutions tailored to your needs
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Service 1 -->
                <div class="scroll-reveal text-center group">
                    <div class="w-16 h-16 bg-gradient-hero rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Property Sales</h3>
                    <p class="text-gray-600">Expert guidance through the entire buying process</p>
                </div>
                
                <!-- Service 2 -->
                <div class="scroll-reveal text-center group" style="animation-delay: 0.1s;">
                    <div class="w-16 h-16 bg-gradient-luxury rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Property Viewing</h3>
                    <p class="text-gray-600">Virtual and in-person property tours</p>
                </div>
                
                <!-- Service 3 -->
                <div class="scroll-reveal text-center group" style="animation-delay: 0.2s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-blue-500 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Legal Support</h3>
                    <p class="text-gray-600">Complete legal assistance for all transactions</p>
                </div>
                
                <!-- Service 4 -->
                <div class="scroll-reveal text-center group" style="animation-delay: 0.3s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Fast Processing</h3>
                    <p class="text-gray-600">Quick and efficient transaction processing</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 relative" style="z-index: 4;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="scroll-reveal">
                                         <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-6">
                         About GintoLand Homes
                     </h2>
                    <p class="text-lg text-gray-600 mb-6">
                        With over 15 years of experience in luxury real estate, we've helped thousands of families find their perfect homes. Our team of expert agents combines local market knowledge with cutting-edge technology to deliver exceptional results.
                    </p>
                    <p class="text-lg text-gray-600 mb-8">
                        We are more than just our portfolio—we are the experiences, relationships, and moments that shape the journey to your dream home.
                    </p>
                    <div class="grid grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gradient font-playfair">15+</div>
                            <div class="text-sm text-gray-600">Years Experience</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gradient font-playfair">2,500+</div>
                            <div class="text-sm text-gray-600">Happy Clients</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gradient font-playfair">98%</div>
                            <div class="text-sm text-gray-600">Satisfaction Rate</div>
                        </div>
                    </div>
                </div>
                
                <div class="scroll-reveal">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1973&q=80" 
                             alt="Modern Real Estate Office" 
                             class="w-full h-96 object-cover rounded-3xl shadow-2xl"
                             loading="lazy" decoding="async">
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-luxury rounded-2xl shadow-xl floating-animation opacity-80" style="z-index: 1;"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

         <!-- Property Calculator Section -->
     <section id="calculator" class="py-20 bg-white relative">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16 scroll-reveal">
                 <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">
                     Mortgage Calculator
                 </h2>
                 <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                     Calculate your monthly payments and explore financing options
                 </p>
             </div>
             
             <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                 <!-- Calculator Form -->
                 <div class="scroll-reveal bg-gray-50 rounded-2xl p-8">
                     <h3 class="text-2xl font-semibold text-gray-900 mb-6">Calculate Your Payment</h3>
                     <form id="mortgageCalculator" class="space-y-6">
                         <div>
                             <label class="block text-sm font-medium text-gray-700 mb-2">Property Price (₱)</label>
                             <input type="number" id="propertyPrice" value="125000000" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                         </div>
                         <div>
                             <label class="block text-sm font-medium text-gray-700 mb-2">Down Payment (%)</label>
                             <input type="range" id="downPayment" min="10" max="50" value="20" class="w-full">
                             <div class="flex justify-between text-sm text-gray-600 mt-1">
                                 <span>10%</span>
                                 <span id="downPaymentValue">20%</span>
                                 <span>50%</span>
                             </div>
                         </div>
                         <div>
                             <label class="block text-sm font-medium text-gray-700 mb-2">Loan Term (Years)</label>
                             <select id="loanTerm" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                 <option value="15">15 Years</option>
                                 <option value="20">20 Years</option>
                                 <option value="25" selected>25 Years</option>
                                 <option value="30">30 Years</option>
                             </select>
                         </div>
                         <div>
                             <label class="block text-sm font-medium text-gray-700 mb-2">Interest Rate (%)</label>
                             <input type="number" id="interestRate" value="6.5" step="0.1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                         </div>
                         <button type="button" onclick="calculateMortgage()" class="w-full bg-gradient-hero text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                             Calculate Payment
                         </button>
                     </form>
                 </div>
                 
                 <!-- Results -->
                 <div class="scroll-reveal">
                     <div class="bg-gradient-hero rounded-2xl p-8 text-white">
                         <h3 class="text-2xl font-semibold mb-6">Your Payment Breakdown</h3>
                         <div class="space-y-4">
                             <div class="flex justify-between items-center py-3 border-b border-white/20">
                                 <span>Property Price:</span>
                                 <span id="displayPrice">₱125,000,000</span>
                             </div>
                             <div class="flex justify-between items-center py-3 border-b border-white/20">
                                 <span>Down Payment:</span>
                                 <span id="displayDownPayment">₱25,000,000</span>
                             </div>
                             <div class="flex justify-between items-center py-3 border-b border-white/20">
                                 <span>Loan Amount:</span>
                                 <span id="displayLoanAmount">₱100,000,000</span>
                             </div>
                             <div class="flex justify-between items-center py-3 border-b border-white/20">
                                 <span>Monthly Payment:</span>
                                 <span id="displayMonthlyPayment" class="text-2xl font-bold">₱675,000</span>
                             </div>
                             <div class="flex justify-between items-center py-3">
                                 <span>Total Interest:</span>
                                 <span id="displayTotalInterest">₱102,500,000</span>
                             </div>
                         </div>
                         <div class="mt-6 p-4 bg-white/10 rounded-lg">
                             <p class="text-sm">* This is an estimate. Actual rates may vary based on your credit score and lender terms.</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <!-- Testimonials Section -->
     <section id="testimonials" class="py-20 bg-gray-50 relative">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16 scroll-reveal">
                 <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">
                     What Our Clients Say
                 </h2>
                 <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                     Real stories from satisfied clients who found their dream homes with us
                 </p>
             </div>
             
             <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                 <!-- Testimonial 1 -->
                 <div class="scroll-reveal bg-white rounded-2xl p-8 shadow-xl">
                     <div class="flex items-center mb-4">
                         <div class="w-12 h-12 bg-gradient-hero rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                             M
                         </div>
                         <div>
                             <h4 class="font-semibold text-gray-900">Maria Santos</h4>
                             <p class="text-sm text-gray-600">Makati Resident</p>
                         </div>
                     </div>
                     <p class="text-gray-600 italic">
                         "GintoLand Homes helped us find our perfect family home in Makati. Their expertise and dedication made the entire process smooth and enjoyable."
                     </p>
                     <div class="flex text-yellow-400 mt-4">
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                     </div>
                 </div>
                 
                 <!-- Testimonial 2 -->
                 <div class="scroll-reveal bg-white rounded-2xl p-8 shadow-xl" style="animation-delay: 0.2s;">
                     <div class="flex items-center mb-4">
                         <div class="w-12 h-12 bg-gradient-luxury rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                             R
                         </div>
                         <div>
                             <h4 class="font-semibold text-gray-900">Roberto Cruz</h4>
                             <p class="text-sm text-gray-600">BGC Investor</p>
                         </div>
                     </div>
                     <p class="text-gray-600 italic">
                         "Excellent service! They found us a premium penthouse in BGC that exceeded our expectations. Highly recommended!"
                     </p>
                     <div class="flex text-yellow-400 mt-4">
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                     </div>
                 </div>
                 
                 <!-- Testimonial 3 -->
                 <div class="scroll-reveal bg-white rounded-2xl p-8 shadow-xl" style="animation-delay: 0.4s;">
                     <div class="flex items-center mb-4">
                         <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                             A
                         </div>
                         <div>
                             <h4 class="font-semibold text-gray-900">Ana Rodriguez</h4>
                             <p class="text-sm text-gray-600">Alabang Homeowner</p>
                         </div>
                     </div>
                     <p class="text-gray-600 italic">
                         "Professional, reliable, and truly caring about their clients. They made our dream home a reality in Alabang."
                     </p>
                     <div class="flex text-yellow-400 mt-4">
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                         </svg>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <!-- Newsletter Section -->
     <section id="newsletter" class="py-20 bg-gradient-hero text-white relative overflow-hidden">
         <div class="absolute inset-0 opacity-10">
             <div class="w-full h-full bg-black"></div>
         </div>
         <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
             <div class="scroll-reveal">
                 <h2 class="text-4xl md:text-5xl font-bold font-playfair mb-6">
                     Stay Updated
                 </h2>
                 <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">
                     Get the latest property listings, market insights, and exclusive offers delivered to your inbox.
                 </p>
                 <form id="newsletterForm" class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                     <input type="email" placeholder="Enter your email address" required 
                            class="flex-1 px-6 py-4 rounded-full text-gray-900 focus:outline-none focus:ring-2 focus:ring-white">
                     <button type="submit" class="bg-white text-gray-900 px-8 py-4 rounded-full font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                         Subscribe
                     </button>
                 </form>
                 <p class="text-sm opacity-75 mt-4">No spam, unsubscribe anytime. We respect your privacy.</p>
             </div>
         </div>
     </section>

     <!-- Contact Section -->
     <section id="contact" class="py-20 bg-gray-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 parallax-slow opacity-30">
            <div class="w-full h-full bg-gradient-hero"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="scroll-reveal">
                <h2 class="text-4xl md:text-5xl font-bold font-playfair mb-6">
                    Ready to Find Your Dream Home?
                </h2>
                <p class="text-xl opacity-90 mb-8 max-w-3xl mx-auto">
                    Let's make your real estate dreams a reality. Contact our team of experts today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button onclick="openInquiryModal()" class="bg-white text-gray-900 px-8 py-4 rounded-full font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        Get Started
                    </button>
                    <button onclick="callNow()" class="glass-effect text-white px-8 py-4 rounded-full font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        Call Us Now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                 <div>
                     <h3 class="text-2xl font-bold font-playfair text-gradient mb-4">GintoLand Homes</h3>
                     <p class="text-gray-400">Your gateway to luxury real estate and exceptional living experiences.</p>
                 </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <div class="space-y-2">
                        <a href="#home" class="block text-gray-400 hover:text-white transition-colors">Home</a>
                        <a href="#properties" class="block text-gray-400 hover:text-white transition-colors">Properties</a>
                        <a href="#services" class="block text-gray-400 hover:text-white transition-colors">Services</a>
                        <a href="#about" class="block text-gray-400 hover:text-white transition-colors">About</a>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Services</h4>
                    <div class="space-y-2">
                        <a href="#" class="block text-gray-400 hover:text-white transition-colors">Property Sales</a>
                        <a href="#" class="block text-gray-400 hover:text-white transition-colors">Property Viewing</a>
                        <a href="#" class="block text-gray-400 hover:text-white transition-colors">Legal Support</a>
                        <a href="#" class="block text-gray-400 hover:text-white transition-colors">Consultation</a>
                    </div>
                </div>
                                 <div>
                     <h4 class="font-semibold mb-4">Contact</h4>
                     <div class="space-y-2 text-gray-400">
                         <p>123 Ayala Avenue</p>
                         <p>Makati City, Metro Manila 1226</p>
                         <p>09159454127</p>
                         <p>aljen.mondarte@gmail.com</p>
                     </div>
                     <div class="mt-4 flex space-x-4">
                         <a href="https://wa.me/639159454127" target="_blank" class="text-green-400 hover:text-green-300 transition-colors">
                             <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                             </svg>
                         </a>
                         <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors">
                             <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                             </svg>
                         </a>
                         <a href="#" class="text-pink-400 hover:text-pink-300 transition-colors">
                             <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                             </svg>
                         </a>
                         <a href="#" class="text-blue-600 hover:text-blue-500 transition-colors">
                             <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                             </svg>
                         </a>
                     </div>
                 </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                                 <p>&copy; 2024 GintoLand Homes. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Inquiry Modal -->
    <div id="inquiryModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 relative">
            <button onclick="closeModal('inquiryModal')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Property Inquiry</h3>
            <form id="inquiryForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Property</label>
                    <input type="text" id="propertyName" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input type="text" id="propertyPrice" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                    <input type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                    <input type="tel" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tell us about your interest in this property..."></textarea>
                </div>
                <button type="submit" class="w-full bg-gradient-hero text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                    Send Inquiry
                </button>
            </form>
        </div>
    </div>

    <!-- Video Modal -->
    <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-4xl w-full p-6 relative">
            <button onclick="closeModal('videoModal')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl z-10">&times;</button>
                         <h3 class="text-2xl font-bold text-gray-900 mb-4">GintoLand Homes Video Tour</h3>
            <div class="aspect-video bg-gray-200 rounded-lg flex items-center justify-center">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-hero rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600">Video tour coming soon!</p>
                    <p class="text-sm text-gray-500 mt-2">Experience our luxury properties in high definition</p>
                </div>
            </div>
        </div>
    </div>

         <!-- Property Gallery Modal -->
     <div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
         <div class="bg-white rounded-2xl max-w-7xl w-full p-6 relative max-h-[90vh] overflow-y-auto">
             <button onclick="closeModal('galleryModal')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl z-10">&times;</button>
             <h3 id="galleryTitle" class="text-2xl font-bold text-gray-900 mb-6">Property Gallery</h3>
             <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="galleryGrid">
                 <!-- Images will be loaded here -->
             </div>
         </div>
     </div>

     <!-- Lightbox Modal -->
     <div id="lightboxModal" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden flex items-center justify-center p-4">
         <div class="relative w-full h-full flex items-center justify-center">
             <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 text-4xl z-10">&times;</button>
             <button onclick="previousImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 text-4xl z-10">
                 <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                 </svg>
             </button>
             <button onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 text-4xl z-10">
                 <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                 </svg>
             </button>
             <img id="lightboxImage" src="" alt="Property Image" class="max-w-full max-h-full object-contain">
             <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white text-sm" id="imageCounter">
                 <!-- Image counter will be shown here -->
             </div>
         </div>
     </div>

     <!-- All Properties Modal -->
     <div id="allPropertiesModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-6xl w-full p-6 relative max-h-[90vh] overflow-y-auto">
            <button onclick="closeModal('allPropertiesModal')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            <h3 class="text-2xl font-bold text-gray-900 mb-6">All Available Properties</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Additional properties will be listed here -->
                <div class="border rounded-lg p-4">
                    <h4 class="font-semibold text-lg">Luxury Condo</h4>
                    <p class="text-gray-600">₱75M - Rockwell, Makati</p>
                    <button onclick="openPropertyInquiry('Luxury Condo', '₱75M', 'Rockwell')" class="mt-2 w-full bg-gradient-hero text-white py-2 rounded text-sm">
                        Inquire
                    </button>
                </div>
                <div class="border rounded-lg p-4">
                    <h4 class="font-semibold text-lg">Garden Villa</h4>
                    <p class="text-gray-600">₱85M - Alabang, Muntinlupa</p>
                    <button onclick="openPropertyInquiry('Garden Villa', '₱85M', 'Alabang')" class="mt-2 w-full bg-gradient-hero text-white py-2 rounded text-sm">
                        Inquire
                    </button>
                </div>
                <div class="border rounded-lg p-4">
                    <h4 class="font-semibold text-lg">Penthouse Suite</h4>
                    <p class="text-gray-600">₱120M - BGC, Taguig</p>
                    <button onclick="openPropertyInquiry('Penthouse Suite', '₱120M', 'BGC')" class="mt-2 w-full bg-gradient-hero text-white py-2 rounded text-sm">
                        Inquire
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Agents & Offices Section -->
    <section id="agents" class="py-20 bg-white relative" style="z-index: 5;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">Agents & Offices</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Meet our experienced team and find the nearest office to you.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div class="rounded-2xl shadow-lg overflow-hidden scroll-reveal">
                    <img src="https://images.unsplash.com/photo-1544006659-f0b21884ce1d?auto=format&fit=crop&w=1200&q=80" class="h-56 w-full object-cover" alt="Agent" loading="lazy" decoding="async">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold">Alex Rivera</h3>
                        <p class="text-gray-500 mb-3">Senior Property Specialist</p>
                        <p class="text-sm text-gray-600">Makati • +63 915 945 4127</p>
                        <p class="text-sm text-gray-600">alex.rivera@gintoland.com</p>
                    </div>
                </div>
                <div class="rounded-2xl shadow-lg overflow-hidden scroll-reveal" style="animation-delay:.1s;">
                    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=1200&q=80" class="h-56 w-full object-cover" alt="Agent" loading="lazy" decoding="async">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold">Bianca Cruz</h3>
                        <p class="text-gray-500 mb-3">Luxury Listings Advisor</p>
                        <p class="text-sm text-gray-600">BGC • +63 917 000 1122</p>
                        <p class="text-sm text-gray-600">bianca.cruz@gintoland.com</p>
                    </div>
                </div>
                <div class="rounded-2xl shadow-lg overflow-hidden scroll-reveal" style="animation-delay:.2s;">
                    <img src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?auto=format&fit=crop&w=1200&q=80" class="h-56 w-full object-cover" alt="Agent" loading="lazy" decoding="async">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold">Carlo Dela Peña</h3>
                        <p class="text-gray-500 mb-3">Investment Consultant</p>
                        <p class="text-sm text-gray-600">Alabang • +63 917 555 9988</p>
                        <p class="text-sm text-gray-600">carlo.dp@gintoland.com</p>
                    </div>
                </div>
                <div class="rounded-2xl shadow-lg overflow-hidden scroll-reveal" style="animation-delay:.3s;">
                    <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?auto=format&fit=crop&w=1200&q=80" class="h-56 w-full object-cover" alt="Agent" loading="lazy" decoding="async">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold">Diane Santos</h3>
                        <p class="text-gray-500 mb-3">Client Relations Manager</p>
                        <p class="text-sm text-gray-600">Quezon City • +63 915 222 7788</p>
                        <p class="text-sm text-gray-600">diane.santos@gintoland.com</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="scroll-reveal">
                    <h4 class="text-xl font-semibold mb-3">Makati Office</h4>
                    <p class="text-gray-600 mb-2">22/F Alphaland Tower, Ayala Ave.</p>
                    <iframe class="w-full h-48 rounded-xl" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=Ayala%20Avenue%2C%20Makati&output=embed"></iframe>
                </div>
                <div class="scroll-reveal" style="animation-delay:.1s;">
                    <h4 class="text-xl font-semibold mb-3">BGC Office</h4>
                    <p class="text-gray-600 mb-2">7/F High Street South Corporate Plaza</p>
                    <iframe class="w-full h-48 rounded-xl" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=Bonifacio%20Global%20City&output=embed"></iframe>
                </div>
                <div class="scroll-reveal" style="animation-delay:.2s;">
                    <h4 class="text-xl font-semibold mb-3">Alabang Office</h4>
                    <p class="text-gray-600 mb-2">Commerce Ave., Filinvest City</p>
                    <iframe class="w-full h-48 rounded-xl" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=Filinvest%20City%2C%20Alabang&output=embed"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Market Search (Map) -->
    <section id="market" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 scroll-reveal">
                <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">Market Search</h2>
                <p class="text-lg text-gray-600">Explore listings on the map and browse featured homes.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                <div class="lg:col-span-2 rounded-2xl overflow-hidden shadow-2xl scroll-reveal">
                    <iframe class="w-full h-[420px]" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=Metro%20Manila&output=embed"></iframe>
                </div>
                <div class="space-y-4 scroll-reveal" style="animation-delay:.1s;">
                    <div class="border rounded-xl p-4 flex gap-4 bg-white shadow-sm">
                        <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=600&q=80" class="w-24 h-24 object-cover rounded-lg" alt="Listing" loading="lazy" decoding="async">
                        <div>
                            <h4 class="font-semibold">Modern Villa • ₱125M</h4>
                            <p class="text-sm text-gray-600">Makati City • 4 Beds • 3 Baths</p>
                            <button onclick="openPropertyInquiry('Modern Villa','₱125M','Makati City')" class="mt-2 text-sm px-3 py-1 bg-gradient-hero text-white rounded">Inquire</button>
                        </div>
                    </div>
                    <div class="border rounded-xl p-4 flex gap-4 bg-white shadow-sm">
                        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=600&q=80" class="w-24 h-24 object-cover rounded-lg" alt="Listing" loading="lazy" decoding="async">
                        <div>
                            <h4 class="font-semibold">Luxury Penthouse • ₱90M</h4>
                            <p class="text-sm text-gray-600">BGC • 3 Beds • 2 Baths</p>
                            <button onclick="openPropertyInquiry('Luxury Penthouse','₱90M','BGC')" class="mt-2 text-sm px-3 py-1 bg-gradient-hero text-white rounded">Inquire</button>
                        </div>
                    </div>
                    <div class="border rounded-xl p-4 flex gap-4 bg-white shadow-sm">
                        <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=600&q=80" class="w-24 h-24 object-cover rounded-lg" alt="Listing" loading="lazy" decoding="async">
                        <div>
                            <h4 class="font-semibold">Beachfront Estate • ₱160M</h4>
                            <p class="text-sm text-gray-600">Boracay • 5 Beds • 4 Baths</p>
                            <button onclick="openPropertyInquiry('Beachfront Estate','₱160M','Boracay')" class="mt-2 text-sm px-3 py-1 bg-gradient-hero text-white rounded">Inquire</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Buying Section -->
    <section id="buying" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-12 items-center">
            <div class="scroll-reveal">
                <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">Buying with Confidence</h2>
                <p class="text-lg text-gray-600 mb-6">From viewing to closing, our agents guide you every step of the way.</p>
                <ul class="space-y-3 text-gray-700">
                    <li>• Curated listings matched to your goals</li>
                    <li>• Private viewings and live virtual tours</li>
                    <li>• Price analysis and offer strategy</li>
                    <li>• End‑to‑end transaction support</li>
                </ul>
            </div>
            <img src="https://images.unsplash.com/photo-1560185127-6ed189bf02f4?auto=format&fit=crop&w=1200&q=80" class="rounded-3xl shadow-2xl scroll-reveal" alt="Buying" loading="lazy" decoding="async">
        </div>
    </section>

    <!-- Selling Section -->
    <section id="selling" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-12 items-center">
            <img src="https://images.unsplash.com/photo-1505691723518-36a5ac3b2d8d?auto=format&fit=crop&w=1200&q=80" class="rounded-3xl shadow-2xl order-2 md:order-1 scroll-reveal" alt="Selling" loading="lazy" decoding="async">
            <div class="order-1 md:order-2 scroll-reveal">
                <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">Selling for Top Value</h2>
                <p class="text-lg text-gray-600 mb-6">We combine staging, photography, and marketing to maximize your returns.</p>
                <ul class="space-y-3 text-gray-700">
                    <li>• Pro staging and cinematic shoots</li>
                    <li>• Premium listing exposure</li>
                    <li>• Buyer screening and negotiation</li>
                    <li>• Seamless closing coordination</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Home Values Section -->
    <section id="home-values" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 scroll-reveal">
                <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">Check Your Home Value</h2>
                <p class="text-lg text-gray-600">Get a quick estimate and a personalized evaluation from our team.</p>
            </div>
            <form id="valueForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-2xl shadow-lg scroll-reveal">
                <input id="valAddress" type="text" placeholder="Property address" class="px-4 py-3 rounded-lg border" required>
                <input id="valCity" type="text" placeholder="City / Area" class="px-4 py-3 rounded-lg border" required>
                <input id="valBeds" type="number" placeholder="Beds" class="px-4 py-3 rounded-lg border">
                <input id="valBaths" type="number" placeholder="Baths" class="px-4 py-3 rounded-lg border">
                <input id="valEmail" type="email" placeholder="Email" class="px-4 py-3 rounded-lg border md:col-span-2" required>
                <button type="submit" class="bg-gradient-hero text-white px-6 py-3 rounded-lg md:col-span-2">Request Estimate</button>
            </form>
        </div>
    </section>

    <!-- Careers Section -->
    <section id="careers" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 scroll-reveal">
                <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 mb-4">Join Our Team</h2>
                <p class="text-lg text-gray-600">We're hiring passionate people to build the future of real estate.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl shadow-lg p-6 scroll-reveal">
                    <h3 class="font-semibold text-lg mb-2">Property Specialist</h3>
                    <p class="text-gray-600 mb-4">Makati • Full-time</p>
                    <button class="px-4 py-2 bg-gradient-hero text-white rounded" onclick="openInquiryModal()">Apply</button>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 scroll-reveal" style="animation-delay:.1s;">
                    <h3 class="font-semibold text-lg mb-2">Client Success Associate</h3>
                    <p class="text-gray-600 mb-4">BGC • Full-time</p>
                    <button class="px-4 py-2 bg-gradient-hero text-white rounded" onclick="openInquiryModal()">Apply</button>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 scroll-reveal" style="animation-delay:.2s;">
                    <h3 class="font-semibold text-lg mb-2">Marketing Designer</h3>
                    <p class="text-gray-600 mb-4">Remote • Contract</p>
                    <button class="px-4 py-2 bg-gradient-hero text-white rounded" onclick="openInquiryModal()">Apply</button>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Parallax effect
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            const rate2 = scrolled * -0.3;
            const rate3 = scrolled * -0.1;
            
            document.documentElement.style.setProperty('--scroll-slow', `${rate3}px`);
            document.documentElement.style.setProperty('--scroll-medium', `${rate2}px`);
            document.documentElement.style.setProperty('--scroll-fast', `${rate}px`);
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll reveal animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });

        // Modal functions
        function openInquiryModal() {
            document.getElementById('inquiryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function openPropertyInquiry(propertyName, price, location) {
            document.getElementById('propertyName').value = propertyName + ' - ' + location;
            document.getElementById('propertyPrice').value = price;
            document.getElementById('inquiryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function openVideoModal() {
            document.getElementById('videoModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function openAllPropertiesModal() {
            document.getElementById('allPropertiesModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        function callNow() {
            window.location.href = 'tel:09159454127';
        }

        // Form submission
        document.getElementById('inquiryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your inquiry! We will contact you soon.');
            closeModal('inquiryModal');
        });

        // Close modal when clicking outside
        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
                 });

         // Mobile menu functions
         function toggleMobileMenu() {
             const menu = document.getElementById('mobileMenu');
             menu.classList.toggle('hidden');
         }

         function closeMobileMenu() {
             document.getElementById('mobileMenu').classList.add('hidden');
         }

         // Property filter function
         function filterProperties() {
             const location = document.getElementById('locationFilter').value;
             const price = document.getElementById('priceFilter').value;
             const type = document.getElementById('typeFilter').value;
             
             // This is a simple filter - in a real app, you'd filter actual data
             alert(`Searching for properties in ${location || 'all locations'}, price range: ${price || 'all prices'}, type: ${type || 'all types'}`);
         }

         // Close mobile menu when clicking outside
         document.addEventListener('click', function(e) {
             const mobileMenu = document.getElementById('mobileMenu');
             const mobileMenuButton = document.querySelector('.md\\:hidden button');
             
             if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                 mobileMenu.classList.add('hidden');
             }
         });

                   // Property Gallery functions
          let currentImages = [];
          let currentImageIndex = 0;

          function openPropertyGallery(propertyName, images) {
              currentImages = images;
              document.getElementById('galleryTitle').textContent = propertyName + ' - Gallery';
              const galleryGrid = document.getElementById('galleryGrid');
              galleryGrid.innerHTML = '';
              
              images.forEach((image, index) => {
                  const imgDiv = document.createElement('div');
                  imgDiv.className = 'relative group cursor-pointer overflow-hidden rounded-lg';
                  imgDiv.innerHTML = `
                      <img src="${image}" alt="${propertyName} - Image ${index + 1}" 
                           class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy" decoding="async"
                           onclick="openLightbox(${index})">
                      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                          <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                          </svg>
                      </div>
                  `;
                  galleryGrid.appendChild(imgDiv);
              });
              
              document.getElementById('galleryModal').classList.remove('hidden');
              document.body.style.overflow = 'hidden';
          }

          // Lightbox functions
          function openLightbox(imageIndex = 0) {
              currentImageIndex = imageIndex;
              const lightboxImage = document.getElementById('lightboxImage');
              const imageCounter = document.getElementById('imageCounter');
              
              lightboxImage.src = currentImages[imageIndex];
              imageCounter.textContent = `${imageIndex + 1} / ${currentImages.length}`;
              
              document.getElementById('lightboxModal').classList.remove('hidden');
              document.body.style.overflow = 'hidden';
          }

          function closeLightbox() {
              document.getElementById('lightboxModal').classList.add('hidden');
              document.body.style.overflow = 'auto';
          }

          function nextImage() {
              currentImageIndex = (currentImageIndex + 1) % currentImages.length;
              openLightbox(currentImageIndex);
          }

          function previousImage() {
              currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
              openLightbox(currentImageIndex);
          }

          // Keyboard navigation for lightbox
          document.addEventListener('keydown', function(e) {
              if (!document.getElementById('lightboxModal').classList.contains('hidden')) {
                  if (e.key === 'Escape') {
                      closeLightbox();
                  } else if (e.key === 'ArrowRight') {
                      nextImage();
                  } else if (e.key === 'ArrowLeft') {
                      previousImage();
                  }
              }
          });

         // Mortgage Calculator functions
         function calculateMortgage() {
             const propertyPrice = parseFloat(document.getElementById('propertyPrice').value);
             const downPaymentPercent = parseFloat(document.getElementById('downPayment').value);
             const loanTerm = parseFloat(document.getElementById('loanTerm').value);
             const interestRate = parseFloat(document.getElementById('interestRate').value);
             
             const downPayment = propertyPrice * (downPaymentPercent / 100);
             const loanAmount = propertyPrice - downPayment;
             const monthlyRate = interestRate / 100 / 12;
             const numberOfPayments = loanTerm * 12;
             
             let monthlyPayment = 0;
             if (monthlyRate > 0) {
                 monthlyPayment = loanAmount * (monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
             } else {
                 monthlyPayment = loanAmount / numberOfPayments;
             }
             
             const totalInterest = (monthlyPayment * numberOfPayments) - loanAmount;
             
             // Update display
             document.getElementById('displayPrice').textContent = '₱' + propertyPrice.toLocaleString();
             document.getElementById('displayDownPayment').textContent = '₱' + downPayment.toLocaleString();
             document.getElementById('displayLoanAmount').textContent = '₱' + loanAmount.toLocaleString();
             document.getElementById('displayMonthlyPayment').textContent = '₱' + Math.round(monthlyPayment).toLocaleString();
             document.getElementById('displayTotalInterest').textContent = '₱' + Math.round(totalInterest).toLocaleString();
         }

         // Update down payment display
         document.getElementById('downPayment').addEventListener('input', function() {
             document.getElementById('downPaymentValue').textContent = this.value + '%';
         });

         // Newsletter subscription
         document.getElementById('newsletterForm').addEventListener('submit', function(e) {
             e.preventDefault();
             const email = this.querySelector('input[type="email"]').value;
             alert('Thank you for subscribing! You will receive updates at ' + email);
             this.reset();
         });

         // Initialize calculator on page load
         document.addEventListener('DOMContentLoaded', function() {
             calculateMortgage();
             // Initialize parallax positions on load
             window.dispatchEvent(new Event('scroll'));
             // Auto-open auth modal if query present
             const params = new URLSearchParams(window.location.search);
             const authParam = params.get('auth');
             if (authParam === 'login' || authParam === 'register') {
                 if (typeof openAuthModal === 'function') {
                     openAuthModal(authParam);
                 }
             }
         });

         // Live Chat functions
         function toggleLiveChat() {
             const chatModal = document.getElementById('liveChatModal');
             chatModal.classList.toggle('hidden');
         }

         function sendChatMessage() {
             const input = document.getElementById('chatInput');
             const message = input.value.trim();
             
             if (message) {
                 const chatMessages = document.getElementById('chatMessages');
                 
                 // Add user message
                 const userDiv = document.createElement('div');
                 userDiv.className = 'bg-blue-100 rounded-lg p-3 mb-3 ml-8';
                 userDiv.innerHTML = `<p class="text-sm text-gray-700">${message}</p>`;
                 chatMessages.appendChild(userDiv);
                 
                 // Clear input
                 input.value = '';
                 
                 // Auto-scroll to bottom
                 chatMessages.scrollTop = chatMessages.scrollHeight;
                 
                 // Simulate bot response
                 setTimeout(() => {
                     const botDiv = document.createElement('div');
                     botDiv.className = 'bg-gray-100 rounded-lg p-3 mb-3';
                     
                     const lower = message.toLowerCase();
                     let response = "Thank you for your message! Our team will get back to you soon.";

                     if (lower.includes('price') || lower.includes('cost')) {
                         response = "Our properties range from ₱42M to ₱240M. Would you like to schedule a viewing?";
                     } else if (lower.includes('location') || lower.includes('where')) {
                         response = "We have properties in Makati, BGC, Alabang, Boracay, Forbes Park, and Eastwood City. Which area interests you?";
                     } else if (lower.includes('contact') || lower.includes('call')) {
                         response = "You can call us at 09159454127 or email aljen.mondarte@gmail.com. We're available 24/7!";
                     } else if (lower.includes('inquire') || lower.includes('inquiry') || lower.includes('view') || lower.includes('schedule')) {
                         response = "I can help you inquire about a property. Tap the button below to open the inquiry form.";
                         botDiv.innerHTML = `<p class="text-sm text-gray-700">${response}</p>
                            <button onclick="openInquiryModal()" class="mt-2 bg-gradient-hero text-white px-3 py-2 rounded-lg text-sm">Open Inquiry Form</button>`;
                         chatMessages.appendChild(botDiv);
                         chatMessages.scrollTop = chatMessages.scrollHeight;
                         return;
                     }

                     botDiv.innerHTML = `<p class="text-sm text-gray-700">${response}</p>`;
                     chatMessages.appendChild(botDiv);
                     chatMessages.scrollTop = chatMessages.scrollHeight;
                 }, 1000);
             }
         }

         // Enter key to send chat message
         document.getElementById('chatInput').addEventListener('keypress', function(e) {
             if (e.key === 'Enter') {
                 sendChatMessage();
             }
         });

         // Home Values submission (quick mailto integration)
         document.getElementById('valueForm').addEventListener('submit', function(e) {
             e.preventDefault();
             const addr = document.getElementById('valAddress').value;
             const city = document.getElementById('valCity').value;
             const beds = document.getElementById('valBeds').value;
             const baths = document.getElementById('valBaths').value;
             const email = document.getElementById('valEmail').value;
             const subject = encodeURIComponent('Home Value Request');
             const body = encodeURIComponent(`Address: ${addr}\nCity/Area: ${city}\nBeds: ${beds}\nBaths: ${baths}\nClient Email: ${email}`);
             window.location.href = `mailto:aljen.mondarte@gmail.com?subject=${subject}&body=${body}`;
             // toast
             const toast = document.createElement('div');
             toast.className = 'fixed top-20 right-6 z-50 bg-white border border-blue-200 text-blue-700 px-4 py-3 rounded-lg shadow-lg';
             toast.textContent = 'Request sent. We\'ll get back to you shortly!';
             document.body.appendChild(toast);
             setTimeout(()=> toast.remove(), 3000);
             this.reset();
         });
     </script>

     <!-- WhatsApp Floating Button -->
     <!-- WhatsApp Floating Button removed -->

     <!-- Live Chat Widget -->
     <div class="fixed bottom-6 right-6 z-50">
         <button onclick="toggleLiveChat()" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center">
             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
             </svg>
         </button>
     </div>

     <!-- Live Chat Modal -->
     <div id="liveChatModal" class="fixed bottom-24 right-6 z-50 hidden">
         <div class="bg-white rounded-2xl shadow-2xl w-80 max-h-96 flex flex-col">
             <div class="bg-gradient-hero text-white p-4 rounded-t-2xl">
                 <div class="flex items-center justify-between">
                     <h3 class="font-semibold">Live Chat</h3>
                     <button onclick="toggleLiveChat()" class="text-white hover:text-gray-200">&times;</button>
                 </div>
                 <p class="text-sm opacity-90">We're online! Ask us anything.</p>
             </div>
             <div class="flex-1 p-4 overflow-y-auto" id="chatMessages">
                 <div class="bg-gray-100 rounded-lg p-3 mb-3">
                     <p class="text-sm text-gray-700">👋 Hi! Welcome to GintoLand Homes. How can I help you today?</p>
                 </div>
             </div>
             <div class="p-4 border-t">
                 <div class="flex gap-2">
                     <input type="text" id="chatInput" placeholder="Type your message..." 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                     <button onclick="sendChatMessage()" class="bg-gradient-hero text-white px-4 py-2 rounded-lg hover:shadow-lg transition-all duration-300">
                         Send
                     </button>
                 </div>
             </div>
         </div>
     </div>
</body>
</html>
