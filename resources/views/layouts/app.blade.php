<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Culture Bénin') - Plateforme Culturelle</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpg" href="{{ asset('logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.jpg') }}">

    <!-- AOS CSS LOCAL -->
    <link rel="stylesheet" href="{{ asset('vendor/aos/aos.css') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config Avancée -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'benin': {
                            'green': '#008751',
                            'yellow': '#FCD116',
                            'red': '#E8112D',
                            'dark-green': '#006B42',
                            'dark-yellow': '#E6B800',
                            'dark-red': '#C10A25',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'gradient': 'gradient 8s ease infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'bounce-slow': 'bounce 2s infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'slide-in-left': 'slideInLeft 0.8s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            }
                        },
                        gradient: {
                            '0%, 100%': {
                                'background-position': '0% 50%'
                            },
                            '50%': {
                                'background-position': '100% 50%'
                            }
                        },
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        slideInLeft: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(-30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            }
                        }
                    },
                    backgroundSize: {
                        'gradient': '400% 400%'
                    }
                }
            }
        }
    </script>

    <!-- Styles Personnalisés -->
    <style>
        /* Gradient Animé Bénin */
        .benin-gradient {
            background: linear-gradient(-45deg, #008751, #FCD116, #E8112D, #006B42);
            background-size: 400% 400%;
            animation: gradient 8s ease infinite;
        }

        /* Glass Morphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-dark {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #008751;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #006B42;
        }

        /* Text Glow */
        .text-glow {
            text-shadow: 0 0 10px rgba(252, 209, 22, 0.3);
        }

        /* Hover Effects */
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        /* Dark Mode Smooth Transition */
        .dark-mode-transition {
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        /* Navigation Link Styles */
        .nav-link {
            @apply text-gray-700 dark:text-white hover:text-benin-green dark:hover:text-benin-yellow transition-all duration-300 font-medium relative group;
        }

        .nav-link::after {
            content: '';
            @apply absolute bottom-0 left-0 w-0 h-0.5 bg-benin-green group-hover:w-full transition-all duration-300;
        }

        /* Force texte mode sombre */
        .dark .prose {
            color: #f9fafb;
        }

        .dark .prose a {
            color: #93c5fd;
        }

        .dark .prose p,
        .dark .prose span,
        .dark .prose li {
            color: #f9fafb;
        }

        /* Dropdown Styles */
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        /* Styles Admin */
        .admin-badge {
            @apply bg-benin-red text-white text-xs px-2 py-1 rounded-full font-bold ml-2;
        }
    </style>
</head>

<body class="min-h-screen bg-white dark:bg-gray-900 dark-mode-transition font-sans antialiased">

    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-white dark:bg-gray-900/95 backdrop-blur-md shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo et Titre -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-10 w-auto rounded-lg">
                    <span class="text-xl font-bold text-gray-800 dark:text-white">Culture<span
                            class="text-benin-yellow">Bénin</span>
                        @auth
                            @if (Auth::user()->id_role === 1)
                                <span class="admin-badge">ADMIN</span>
                            @endif
                        @endauth
                    </span>
                </div>

                <!-- Liens de navigation centrés -->
                <div class="flex justify-center items-center space-x-8 absolute left-1/2 transform -translate-x-1/2">
                    <a href="{{ route('home') }}" class="nav-link">Accueil</a>
                    <a href="{{ route('contenus.index') }}" class="nav-link">Contenus</a>
                    <a href="{{ route('regions.index') }}" class="nav-link">Régions</a>
                    <a href="{{ route('langues.index') }}" class="nav-link">Langues</a>

                    <!-- Liens Admin et Statistiques -->
                    @auth
                        @if (Auth::user()->id_role === 1)
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">Administration</a>
                            <a href="{{ route('statsboard') }}" class="nav-link">Statistiques</a>
                        @endif
                    @endauth
                </div>

                <!-- Bouton de déconnexion / Connexion -->
                <div>
                    @auth
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700 dark:text-gray-300 text-sm">
                                {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="bg-benin-red text-white px-4 py-2 rounded-md hover:bg-benin-dark-red transition-colors duration-300">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-benin-green text-white px-4 py-2 rounded-md hover:bg-benin-dark-green transition-colors duration-300">
                            Connexion
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-10 w-auto rounded-lg">
                        <span class="text-xl font-bold">Culture<span class="text-benin-yellow">Bénin</span></span>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Plateforme numérique pour la promotion de la culture et des langues du Bénin.
                        Préservons ensemble notre héritage culturel.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Navigation Rapide</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Accueil</a>
                        </li>
                        <li><a href="{{ route('contenus.index') }}"
                                class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Contenus</a>
                        </li>
                        <li><a href="{{ route('regions.index') }}"
                                class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Régions</a>
                        </li>
                        <li><a href="{{ route('langues.index') }}"
                                class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Langues</a>
                        </li>
                        @auth
                            @if (Auth::user()->id_role === 1)
                                <li><a href="{{ route('statsboard') }}"
                                        class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Statistiques</a>
                                </li>
                                <li><a href="{{ route('admin.dashboard') }}"
                                        class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Administration</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>contact@culturebenin.bj</li>
                        <li>+229 46 90 51 92</li>
                        <li>Cotonou, Bénin</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">&copy; 2025 Culture Bénin. Tous droits réservés.</p>
                @auth
                    @if (Auth::user()->id_role === 1)
                        <p class="text-gray-500 text-sm mt-2 md:mt-0">
                            Interface d'administration
                        </p>
                    @endif
                @endauth
            </div>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script>
        // AOS init
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic',
            delay: 100,
            mirror: false
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) nav.classList.add('shadow-2xl', 'bg-white/95', 'dark:bg-gray-900/95');
            else nav.classList.remove('shadow-2xl', 'bg-white/95', 'dark:bg-gray-900/95');
        });

        // Dropdown arrow hover
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            const arrow = dropdown.querySelector('.dropdown-arrow');
            dropdown.addEventListener('mouseenter', () => arrow.style.transform = 'rotate(180deg)');
            dropdown.addEventListener('mouseleave', () => arrow.style.transform = 'rotate(0deg)');
        });
    </script>

    @stack('scripts')
</body>

</html>
