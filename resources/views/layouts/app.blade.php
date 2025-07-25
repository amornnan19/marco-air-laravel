<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Marco Air')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @if(request()->routeIs('terms.conditions', 'privacy.policy', 'cookie.policy'))
        <!-- Policy Pages: Full Screen -->
        <div class="min-h-screen">
            <div class="w-full min-h-screen @yield('container-class', '')">
                @yield('content')
            </div>
        </div>
    @else
        <!-- App Pages: Mobile full screen, Desktop phone frame -->
        <div class="min-h-screen sm:flex sm:items-center sm:justify-center sm:p-8">
            <!-- Phone Frame (Desktop only) -->
            <div class="w-full min-h-screen sm:w-[375px] sm:h-[812px] sm:bg-white sm:rounded-[2.5rem] sm:shadow-2xl sm:overflow-hidden sm:border-8 sm:border-gray-800 sm:min-h-0">
                <!-- Content Container -->
                <div class="w-full h-full sm:overflow-y-auto">
                    <div class="p-4 flex items-center justify-center min-h-full">
                        <div class="w-full max-w-sm">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Policy pages full width on desktop */
        @media (min-width: 640px) {
            .policy-page {
                max-width: 800px;
                margin: 0 auto;
                padding: 2rem;
            }
        }
    </style>
</body>
</html>