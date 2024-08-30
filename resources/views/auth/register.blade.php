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
    <title>Register - CSR Kabupaten Cirebon</title>
    @vite('resources/css/app.css')
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body class="bg-[#F2F4F7] min-h-screen flex flex-col font-sans">
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
            <div class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row max-w-[1240px] w-full md:h-[656px]">
                <!-- Skeleton for Left Container -->
                <div class="md:w-2/5 p-8 border-b md:border-b-0 md:border-r border-gray-300 flex flex-col justify-center space-y-4">
                    <div class="bg-gray-200 animate-pulse h-6 w-[200px] rounded"></div>
                    <div class="bg-gray-200 animate-pulse h-10 w-[250px] rounded"></div>
                    <div class="bg-gray-200 animate-pulse h-4 w-[300px] rounded"></div>
                    <div class="bg-gray-200 animate-pulse h-16 w-full rounded"></div>
                </div>

                <!-- Skeleton for Right Container -->
                <div class="md:w-3/5 p-8 space-y-6 mt-[50px]">
                    <div class="flex flex-col space-y-2">
                        <div class="bg-gray-200 animate-pulse h-4 w-[100px] rounded"></div>
                        <div class="bg-gray-200 animate-pulse h-10 w-full rounded"></div>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <div class="bg-gray-200 animate-pulse h-4 w-[150px] rounded"></div>
                        <div class="bg-gray-200 animate-pulse h-10 w-full rounded"></div>
                    </div>
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

    <div id="content" class="flex-grow flex flex-col">
        @include('auth.partials-register.navbar')

        <main class="flex-grow flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row max-w-[1240px] w-full md:h-[656px]">
                @include('auth.partials-register.register-info')
                @include('auth.partials-register.register-form')
            </div>
        </main>

        @include('auth.partials-register.footer')
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const skeletonLoader = document.getElementById('skeleton-loader');
        const content = document.getElementById('content');

        // Show skeleton loader
        skeletonLoader.classList.remove('hidden');
        content.classList.add('hidden');

        // Simulate loading time (e.g., 1.5 seconds)
        setTimeout(function() {
            // Hide skeleton loader and show content
            skeletonLoader.classList.add('hidden');
            content.classList.remove('hidden');
        }, 500);
    });

    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);

        const icon = input.nextElementSibling.querySelector('svg');
        icon.innerHTML = type === 'password'
            ? '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />'
            : '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
    }
    </script>
</body>
</html>
