<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture Bénin - Plateforme Culturelle</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpg" href="{{ asset('logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.jpg') }}">

    <!-- AOS CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/aos/aos.css') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'benin': {
                            'green': '#008751',
                            'yellow': '#E8112D6',
                            'red': '#E8112D',
                            'dark-green': '#006B42',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'slide-in-left': 'slideInLeft 0.8s ease-out',
                        'zoom-in': 'zoomIn 0.8s ease-out',
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
                        },
                        zoomIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'scale(0.9)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'scale(1)'
                            }
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        .carousel-slide {
            transition: opacity 1s ease-in-out;
        }

        .text-glow {
            text-shadow: 0 0 10px rgba(252, 209, 22, 0.3);
        }

        .animation-delay-200 {
            animation-delay: 200ms;
        }

        .animation-delay-400 {
            animation-delay: 400ms;
        }

        .animation-delay-600 {
            animation-delay: 600ms;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <!-- Navigation Publique -->
    <nav class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur-md shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo et Titre -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-10 w-auto rounded-lg">
                    <span class="text-xl font-bold text-gray-800">Culture<span
                            class="text-benin-yellow">Bénin</span></span>
                </div>

                <!-- Boutons de connexion/inscription -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-benin-green transition-colors duration-300 font-medium">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-benin-green hover:bg-benin-dark-green text-white px-4 py-2 rounded-lg transition-colors duration-300 font-medium">
                        Inscription
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal Public -->
    <main class="pt-16">
        <!-- Hero Section avec Carrousel -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <!-- Carrousel d'arrière-plan -->
            <div id="carousel" class="absolute inset-0 z-0">
                @for ($i = 1; $i <= 12; $i++)
                    <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                        <img src="{{ asset('image ' . $i . '.jpg') }}" alt="Culture Bénin {{ $i }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                @endfor
            </div>

            <!-- Formes décoratives animées -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
            <div class="absolute bottom-20 right-10 w-32 h-32 bg-white/10 rounded-full animate-float"
                style="animation-delay: 2s;"></div>
            <div class="absolute top-1/3 right-1/4 w-16 h-16 bg-white/10 rounded-full animate-pulse"></div>

            <!-- Contenu principal -->
            <div class="relative z-10 text-center max-w-4xl mx-auto px-4 text-white">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in-up text-glow">
                    Découvrez la <span class="text-benin-yellow">richesse</span><br>culturelle du <span
                        class="text-benin-yellow">Bénin</span>
                </h1>
                <p
                    class="text-xl md:text-2xl mb-8 text-gray-200 leading-relaxed animate-fade-in-up animation-delay-200">
                    Explorez les traditions, langues, recettes et histoires qui font la singularité de notre patrimoine
                    culturel
                </p>
                <div
                    class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up animation-delay-400">
                    <a href="{{ route('register') }}"
                        class="group bg-benin-yellow text-gray-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-400 transform hover:scale-105 transition-all duration-300 shadow-2xl relative overflow-hidden">
                        <span class="relative z-10">Commencer l'aventure</span>
                        <div
                            class="absolute inset-0 bg-white/20 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300">
                        </div>
                    </a>
                    <a href="#features"
                        class="group border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-300 relative overflow-hidden">
                        <span class="relative z-10">Découvrir les features</span>
                        <div
                            class="absolute inset-0 bg-white transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300">
                        </div>
                    </a>
                </div>
            </div>

            <!-- Scroll indicator animé -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <div class="w-6 h-10 border-2 border-white rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white rounded-full mt-2 animate-pulse"></div>
                </div>
            </div>
        </section>

        <!-- Section Statistiques -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div data-aos="fade-up" data-aos-delay="100">
                        <div class="text-4xl md:text-6xl font-bold text-benin-green mb-2">150+</div>
                        <div class="text-gray-600">Contenus culturels</div>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="200">
                        <div class="text-4xl md:text-6xl font-bold text-benin-yellow mb-2">12</div>
                        <div class="text-gray-600">Régions couvertes</div>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="300">
                        <div class="text-4xl md:text-6xl font-bold text-benin-red mb-2">50+</div>
                        <div class="text-gray-600">Langues locales</div>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="400">
                        <div class="text-4xl md:text-6xl font-bold text-benin-green mb-2">500+</div>
                        <div class="text-gray-600">Contributeurs</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Features -->
        <section id="features" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Une expérience <span class="text-benin-green">unique</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Découvrez toutes les fonctionnalités conçues pour valoriser notre patrimoine culturel
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift group" data-aos="fade-up"
                        data-aos-delay="100">
                        <div
                            class="w-16 h-16 bg-benin-green/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl">📚</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Contenus Riches</h3>
                        <p class="text-gray-600">Histoires, recettes, traditions et savoirs locaux enrichis de médias
                            variés</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift group" data-aos="fade-up"
                        data-aos-delay="200">
                        <div
                            class="w-16 h-16 bg-benin-yellow/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl">🗣️</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Multilingue</h3>
                        <p class="text-gray-600">Contenus disponibles dans toutes les langues nationales du Bénin</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift group" data-aos="fade-up"
                        data-aos-delay="300">
                        <div
                            class="w-16 h-16 bg-benin-red/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl">🌍</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Par Région</h3>
                        <p class="text-gray-600">Découverte culturelle organisée par région et communauté</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section À Propos -->
        <section class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div data-aos="slide-in-left">
                        <h2 class="text-4xl font-bold text-gray-800 mb-6">Notre Vision</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            CultureBénin est née de la volonté de préserver et promouvoir le riche patrimoine culturel
                            et linguistique du Bénin. Notre plateforme sert de pont entre les générations, permettant
                            la transmission et la valorisation de notre héritage culturel.
                        </p>
                        <p class="text-lg text-gray-600 mb-4">
                            Créée en 2025, notre initiative vise à digitaliser la culture béninoise pour la rendre
                            accessible à tous, partout dans le monde.
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <span class="w-2 h-2 bg-benin-green rounded-full mr-3"></span>
                                <span class="text-gray-700">Promouvoir les langues locales</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-2 h-2 bg-benin-green rounded-full mr-3"></span>
                                <span class="text-gray-700">Valoriser le patrimoine culturel</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-2 h-2 bg-benin-green rounded-full mr-3"></span>
                                <span class="text-gray-700">Faciliter l'accès à la culture béninoise</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-benin-green rounded-2xl p-8 text-white" data-aos="zoom-in">
                        <h3 class="text-2xl font-bold mb-4">Chiffres Clés</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-benin-yellow mb-2">15+</div>
                                <div class="text-white">Langues locales</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-benin-yellow mb-2">77</div>
                                <div class="text-white">Communes</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-benin-yellow mb-2">50+</div>
                                <div class="text-white">Contenus culturels</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-benin-yellow mb-2">24/7</div>
                                <div class="text-white">Accès disponible</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-benin-green text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 max-w-4xl mx-auto text-center px-4" data-aos="zoom-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    Rejoignez la communauté Culture Bénin
                </h2>
                <p class="text-xl mb-8 text-green-100">
                    Contribuez à préserver et promouvoir notre riche patrimoine culturel pour les générations futures
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                        class="bg-white text-benin-green px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-2xl">
                        Créer un compte
                    </a>
                    <a href="{{ route('login') }}"
                        class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-benin-green transform hover:scale-105 transition-all duration-300">
                        Se connecter
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Public -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-10 w-auto rounded-lg">
                    <span class="text-xl font-bold">Culture<span class="text-benin-yellow">Bénin</span></span>
                </div>
                <p class="text-gray-400 mb-4">
                    Plateforme numérique pour la promotion de la culture et des langues du Bénin
                </p>
                <p class="text-gray-400">&copy; 2025 Culture Bénin. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>

    <script>
        // Initialisation AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Carrousel automatique
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.carousel-slide');
            let currentSlide = 0;

            // Afficher la première slide
            if (slides.length > 0) {
                slides[0].classList.add('opacity-100');
            }

            function nextSlide() {
                slides[currentSlide].classList.remove('opacity-100');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('opacity-100');
            }

            // Changer de slide toutes les 5 secondes
            setInterval(nextSlide, 5000);
        });

        // Effet de scroll sur la navigation
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('bg-white', 'shadow-lg');
                nav.classList.remove('bg-white/90');
            } else {
                nav.classList.remove('bg-white', 'shadow-lg');
                nav.classList.add('bg-white/90');
            }
        });
    </script>
</body>

</html>
