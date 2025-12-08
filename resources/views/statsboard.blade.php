@extends('layouts.app')

@section('title', 'Tableau de Bord - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Tableau de <span class="text-benin-green">Bord</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Statistiques et insights de la plateforme Culture Bénin
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Contenus -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-benin-green/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Contenus</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_contenus'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Utilisateurs -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-benin-yellow/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-benin-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Utilisateurs</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_utilisateurs'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Régions -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-benin-red/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-benin-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Régions</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_regions'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Langues -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-500/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Langues</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_langues'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Répartition des contenus par type -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Contenus par type</h3>
                <div class="h-80">
                    <canvas id="typeContenuChart"></canvas>
                </div>
            </div>

            <!-- Répartition des contenus par région -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Contenus par région</h3>
                <div class="h-80">
                    <canvas id="regionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Additional Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Évolution mensuelle des contenus -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Évolution mensuelle</h3>
                <div class="h-80">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>

            <!-- Statut des contenus -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Statut des contenus</h3>
                <div class="h-80">
                    <canvas id="statutChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Actions rapides</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('contenus.create') }}" 
                   class="flex items-center justify-center space-x-2 bg-benin-green text-white px-4 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                   </svg>
                   <span>Nouveau contenu</span>
                </a>

                <a href="{{ route('medias.create') }}" 
                   class="flex items-center justify-center space-x-2 bg-benin-yellow text-gray-900 px-4 py-3 rounded-lg hover:bg-yellow-500 transition-all duration-300 transform hover:scale-105 font-medium">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                   </svg>
                   <span>Upload média</span>
                </a>

                <a href="{{ route('users.index') }}" 
                   class="flex items-center justify-center space-x-2 bg-benin-red text-white px-4 py-3 rounded-lg hover:bg-red-700 transition-all duration-300 transform hover:scale-105 font-medium">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                   </svg>
                   <span>Gérer utilisateurs</span>
                </a>

                <a href="{{ route('commentaires.index') }}" 
                   class="flex items-center justify-center space-x-2 bg-purple-500 text-white px-4 py-3 rounded-lg hover:bg-purple-600 transition-all duration-300 transform hover:scale-105 font-medium">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                   </svg>
                   <span>Modérer commentaires</span>
                </a>
            </div>
        </div>

    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Colors for charts
    const colors = {
        benin: ['#008751', '#FCD116', '#E8112D', '#8B5CF6', '#06B6D4', '#10B981'],
        light: ['#008751', '#34D399', '#FBBF24', '#F87171', '#60A5FA', '#A78BFA'],
        dark: ['#008751', '#10B981', '#F59E0B', '#EF4444', '#3B82F6', '#8B5CF6']
    };

    // Chart 1: Répartition des contenus par type
    const typeContenuCtx = document.getElementById('typeContenuChart').getContext('2d');
    new Chart(typeContenuCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($charts['types_contenu']['labels']) !!},
            datasets: [{
                data: {!! json_encode($charts['types_contenu']['data']) !!},
                backgroundColor: colors.benin,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: document.documentElement.classList.contains('dark') ? '#fff' : '#374151',
                        padding: 20,
                        usePointStyle: true
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    // Chart 2: Répartition des contenus par région
    const regionCtx = document.getElementById('regionChart').getContext('2d');
    new Chart(regionCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($charts['regions']['labels']) !!},
            datasets: [{
                label: 'Contenus',
                data: {!! json_encode($charts['regions']['data']) !!},
                backgroundColor: colors.benin[0],
                borderColor: colors.benin[0],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'
                    },
                    grid: {
                        color: document.documentElement.classList.contains('dark') ? '#374151' : '#E5E7EB'
                    }
                },
                x: {
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Chart 3: Évolution mensuelle
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($charts['monthly']['labels']) !!},
            datasets: [{
                label: 'Contenus créés',
                data: {!! json_encode($charts['monthly']['data']) !!},
                borderColor: colors.benin[0],
                backgroundColor: colors.benin[0] + '20',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'
                    },
                    grid: {
                        color: document.documentElement.classList.contains('dark') ? '#374151' : '#E5E7EB'
                    }
                },
                x: {
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'
                    },
                    grid: {
                        color: document.documentElement.classList.contains('dark') ? '#374151' : '#E5E7EB'
                    }
                }
            }
        }
    });

    // Chart 4: Statut des contenus
    const statutCtx = document.getElementById('statutChart').getContext('2d');
    new Chart(statutCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($charts['statuts']['labels']) !!},
            datasets: [{
                data: {!! json_encode($charts['statuts']['data']) !!},
                backgroundColor: [colors.benin[0], colors.benin[1], colors.benin[2], '#6B7280'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: document.documentElement.classList.contains('dark') ? '#fff' : '#374151',
                        padding: 20,
                        usePointStyle: true
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
});

// Update charts on theme change
document.getElementById('theme-toggle').addEventListener('click', function() {
    setTimeout(() => {
        // Re-render charts to update colors
        Chart.getChart('typeContenuChart')?.update();
        Chart.getChart('regionChart')?.update();
        Chart.getChart('monthlyChart')?.update();
        Chart.getChart('statutChart')?.update();
    }, 500);
});
</script>
@endsection