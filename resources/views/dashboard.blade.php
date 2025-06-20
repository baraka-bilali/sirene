<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertes Incendie - Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .alert-critical {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        .alert-high {
            border-left: 4px solid #f97316;
        }

        .alert-medium {
            border-left: 4px solid #eab308;
        }

        .alert-low {
            border-left: 4px solid #22c55e;
        }

        .header-gradient {
            background: linear-gradient(135deg, #ef4444 0%, #f97316 100%);
        }
    </style>
    @livewireStyles
</head>

<body class="min-h-screen">
    <div class="flex flex-col min-h-screen">
        <!-- Header -->
        <header class="header-gradient text-white shadow-lg">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-fire text-3xl"></i>
                        <h1 class="text-2xl font-bold">Système d'Alertes Incendie</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-bell mr-1"></i>
                            <span id="alert-count">0</span> alertes
                        </span>
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Profile"
                                class="w-10 h-10 rounded-full cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 py-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Alertes en temps réel</h2>
                        <div class="flex space-x-2">
                            <button
                                class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200 transition">
                                <i class="fas fa-filter mr-1"></i> Filtrer
                            </button>
                            <button
                                class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200 transition">
                                <i class="fas fa-sync-alt mr-1"></i> Actualiser
                            </button>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-red-50 p-4 rounded-lg border-l-4 border-red-500">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium text-red-700">Nombres des Alertes</p>
                                    <p class="text-2xl font-bold text-red-900" id="critical-count">0</p>
                                </div>
                                <i class="fas fa-fire text-red-500 text-xl"></i>
                            </div>
                        </div>


                    </div>

                    <!-- Alerts Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-tag mr-1"></i> Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-comment-alt mr-1"></i> Message
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-clock mr-1"></i> Heure
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-cog mr-1"></i> Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="alerts-body" class="bg-white divide-y divide-gray-200">
                                <!-- Sample alerts - would be replaced with dynamic data -->
                                @foreach ($alerts as $alert)
                                    <tr class="alert-critical bg-red-50 hover:bg-red-100 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                {{ $alert->type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $alert->message }}</div>
                                            <div class="text-sm text-gray-500">Bâtiment A, étage 3</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <i class="far fa-clock mr-1"></i> {{ $alert->alert_time }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="deleteAlert({{ $alert->id }})"
                                                class="text-red-600 hover:text-red-900 mr-3">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button class="text-gray-600 hover:text-gray-900">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Carte des alertes</h2>
                    <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center">
                        <i class="fas fa-map-marked-alt text-4xl text-gray-400"></i>
                        <p class="ml-3 text-gray-500">Carte interactive des alertes en temps réel</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm">
                            &copy; 2023 Système de Gestion des Alertes Incendie. Tous droits réservés.
                        </p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fas fa-question-circle"></i> Aide
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fas fa-cog"></i> Paramètres
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        async function fetchAlertCount() {
            try {
                const response = await fetch("http://127.0.0.1:8000/api/alert-count");
                const data = await response.json();
                document.getElementById('critical-count').textContent = data.count;
            } catch (error) {
                console.error("Erreur lors du chargement du compteur d'alertes :", error);
            }
        }

        // Rafraîchir toutes les 5 secondes
        setInterval(fetchAlertCount, 5000);
        fetchAlertCount(); // au chargement initial
        async function deleteAlert(id) {
            if (!confirm("Voulez-vous vraiment supprimer cette alerte ?")) return;

            try {
                const response = await fetch(`http://127.0.0.1:8000/api/alert/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    alert("Alerte supprimée !");
                    location.reload(); // recharge la page pour voir la mise à jour
                } else {
                    const error = await response.json();
                    alert("Erreur : " + error.message);
                }
            } catch (error) {
                alert("Erreur de connexion au serveur.");
                console.error(error);
            }
        }
        async function fetchAlertCounts() {
            try {
                const response = await fetch("http://127.0.0.1:8000/api/alert");
                const data = await response.json();

                let critical = 0,
                    high = 0,
                    medium = 0,
                    low = 0;

                data.forEach(alert => {
                    const valeur = alert.valeur;

                    if (valeur >= 150) {
                        critical++;
                    } else if (valeur >= 120) {
                        high++;
                    } else if (valeur >= 90) {
                        medium++;
                    } else {
                        low++;
                    }
                });

                const total = critical + high + medium + low;

                document.getElementById('critical-count').textContent = critical;
                document.getElementById('high-count').textContent = high;
                document.getElementById('medium-count').textContent = medium;
                document.getElementById('low-count').textContent = low;
                document.getElementById('alert-count').textContent = total;

            } catch (error) {
                console.error("Erreur lors du chargement des alertes :", error);
            }
        }

        // Rafraîchir toutes les 5 secondes
        setInterval(fetchAlertCounts, 5000);
        fetchAlertCounts(); // au chargement initial
    </script>
    @livewireScripts

</body>

</html>
