{{-- nanti yang ini
<!DOCTYPE html>
<html lang="en">

ganti ini

@extends('layouts.app')

@section('content')
@endsection

pasti tau lah dan body dijaddin div
--}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - CSR Kabupaten Cirebon</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#F2F4F7] min-h-screen flex flex-col font-sans">
    <!-- Skeleton Loader -->
    <div id="skeleton-loader" class="hidden flex-grow flex flex-col">
        <!-- Skeleton Navbar -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center h-16">
                    <div class="bg-gray-200 animate-pulse h-8 md:h-10 w-48"></div>
                </div>
            </div>
        </nav>

        <!-- Skeleton Main Content -->
        <div class="flex-1 flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row max-w-[1240px] w-full min-h-[361px]">
                <!-- Skeleton for Left Container -->
                <div class="md:w-[35%] p-8 border-b md:border-b-0 md:border-r border-gray-300 flex flex-col justify-center space-y-4">
                    <div class="bg-gray-200 animate-pulse h-6 w-[200px] rounded"></div>
                    <div class="bg-gray-200 animate-pulse h-10 w-[250px] rounded"></div>
                    <div class="bg-gray-200 animate-pulse h-4 w-[300px] rounded"></div>
                    <div class="bg-gray-200 animate-pulse h-16 w-full rounded"></div>
                </div>

                <!-- Skeleton for Right Container -->
                <div class="md:w-[60%] p-8 space-y-6 mt-[50px]">
                    <div class="flex flex-col space-y-2">
                        <div class="bg-gray-200 animate-pulse h-4 w-[100px] rounded"></div>
                        <div class="bg-gray-200 animate-pulse h-10 w-full rounded"></div>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <div class="bg-gray-200 animate-pulse h-4 w-[150px] rounded"></div>
                        <div class="bg-gray-200 animate-pulse h-10 w-full rounded"></div>
                    </div>
                    <div class="bg-gray-200 animate-pulse h-10 w-[300px] rounded"></div>
                </div>
            </div>
        </div>

        <!-- Skeleton Footer -->
        <footer class="bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="bg-gray-600 animate-pulse h-4 w-64 mb-2"></div>
                    <div class="bg-gray-700 animate-pulse h-3 w-80"></div>
                </div>
                <div class="bg-gray-700 animate-pulse h-10 w-48 rounded-md"></div>
            </div>
        </footer>
    </div>

    <!-- Main Content -->
    <div id="content" class="flex-grow flex flex-col">
        <!-- Navbar -->
        @include('auth.partials-login.navbar')

        <!-- Main Section -->
        <main class="flex-grow flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row max-w-[1240px] w-full min-h-[361px]">
                <!-- Left side: Welcome message and registration link -->
                @include('auth.partials-login.login-info')

                <!-- Vertical divider -->
                <div class="hidden md:block w-px bg-gray-300 self-stretch mx-2"></div>

                <!-- Right side: Login form -->
                @include('auth.partials-login.login-form')
            </div>
        </main>

        <!-- Footer -->
        @include('auth.partials-login.footer')
    </div>

    <!-- Scripts -->
    <script>
    // Show skeleton loader on page load
    document.addEventListener('DOMContentLoaded', function() {
        const skeletonLoader = document.getElementById('skeleton-loader');
        const content = document.getElementById('content');

        skeletonLoader.classList.remove('hidden');
        content.classList.add('hidden');

        // Simulate loading time (e.g., 1.5 seconds)
        setTimeout(function() {
            skeletonLoader.classList.add('hidden');
            content.classList.remove('hidden');
        }, 500);
    });

    // Toggle password visibility
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const showPasswordIcon = document.getElementById('showPasswordIcon');
        const hidePasswordIcon = document.getElementById('hidePasswordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordIcon.style.display = 'inline-block';
            hidePasswordIcon.style.display = 'none';
        } else {
            passwordInput.type = 'password';
            showPasswordIcon.style.display = 'none';
            hidePasswordIcon.style.display = 'inline-block';
        }
    }
    </script>
</body>
</html>
