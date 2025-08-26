<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Property Marketplace - Find Your Dream Home</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="text-2xl font-bold text-blue-600">🏠 PropertyHub</div>
                    </div>
                    <div class="flex items-center space-x-4">
            @if (Route::has('login'))
                    @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            Dashboard
                        </a>
                    @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            Log in
                        </a>
                        @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                                Register
                            </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                    Find Your Dream Home
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                    Discover amazing properties in the Philippines. Browse apartments, houses, condos, and more with our advanced search and social features.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('properties.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
                        🏠 Browse Properties
                    </a>
                    @auth
                        <a href="{{ route('properties.create') }}" class="bg-green-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-700 transition">
                            📝 List Your Property
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-green-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-700 transition">
                            📝 List Your Property
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose Our Marketplace?</h2>
                    <p class="text-xl text-gray-600">Advanced features that make property hunting easy and fun</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6">
                        <div class="text-4xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Smart Search Engine</h3>
                        <p class="text-gray-600">Find properties with advanced filters, location search, and price ranges. Our SOE helps you discover the perfect home.</p>
                    </div>
                    
                    <div class="text-center p-6">
                        <div class="text-4xl mb-4">💬</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Social Features</h3>
                        <p class="text-gray-600">Like, comment, and ask questions about properties. Connect with sellers and other buyers in real-time.</p>
                    </div>
                    
                    <div class="text-center p-6">
                        <div class="text-4xl mb-4">📱</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Beautiful Interface</h3>
                        <p class="text-gray-600">Facebook-like browsing experience with stunning property cards, image galleries, and responsive design.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Property Types Section -->
        <div class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Property Types</h2>
                    <p class="text-xl text-gray-600">Find exactly what you're looking for</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                    <div class="text-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="text-3xl mb-3">🏢</div>
                        <h3 class="font-semibold text-gray-900">Apartments</h3>
                    </div>
                    
                    <div class="text-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="text-3xl mb-3">🏠</div>
                        <h3 class="font-semibold text-gray-900">Houses</h3>
                    </div>
                    
                    <div class="text-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="text-3xl mb-3">🏙️</div>
                        <h3 class="font-semibold text-gray-900">Condos</h3>
                    </div>
                    
                    <div class="text-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="text-3xl mb-3">🌱</div>
                        <h3 class="font-semibold text-gray-900">Land</h3>
                    </div>
                    
                    <div class="text-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="text-3xl mb-3">🏪</div>
                        <h3 class="font-semibold text-gray-900">Commercial</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-20 bg-blue-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Ready to Find Your Dream Home?</h2>
                <p class="text-xl text-blue-100 mb-8">Join thousands of users who have already found their perfect property</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('properties.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-100 transition">
                        Start Browsing
                    </a>
                    @auth
                        <a href="{{ route('properties.create') }}" class="bg-green-500 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-600 transition">
                            List Your Property
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-green-500 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-600 transition">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <div class="text-2xl font-bold text-blue-400 mb-4">🏠 PropertyHub</div>
                        <p class="text-gray-300">Your trusted partner in finding the perfect property in the Philippines.</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('properties.index') }}" class="text-gray-300 hover:text-white">Browse Properties</a></li>
                            <li><a href="{{ route('properties.create') }}" class="text-gray-300 hover:text-white">List Property</a></li>
                            @auth
                                <li><a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a></li>
                            @else
                                <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Login</a></li>
                                <li><a href="{{ route('register') }}" class="text-gray-300 hover:text-white">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Features</h3>
                        <ul class="space-y-2">
                            <li class="text-gray-300">🔍 Advanced Search</li>
                            <li class="text-gray-300">💬 Social Features</li>
                            <li class="text-gray-300">📱 Mobile Friendly</li>
                            <li class="text-gray-300">⭐ Featured Properties</li>
                    </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact</h3>
                        <p class="text-gray-300">Have questions? We're here to help!</p>
                        <div class="mt-4">
                            <a href="{{ route('properties.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">
                                Browse Now
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2025 PropertyHub. All rights reserved. Built with ❤️ using Laravel.</p>
                </div>
        </div>
        </footer>
    </body>
</html>
