@extends('layouts.app')

@section('content')

<div class="bg-custom-pink text-center p-2.5">
    <h1 class="text-white text-xl font-bold font-custom-rubik">Find out your favorite festivals on the map!</h1>
</div>

<!-- Conteneur principal -->
<div class="container mx-auto mt-8">
    <!-- Carte -->
    <div id="map" class="w-full h-[600px] border-4 border-gray-700 rounded-lg shadow-lg"></div>

    <!-- Conteneur pour les informations du festival -->
    <div id="festival-info" class="mt-8 p-4 bg-custom-background-dark text-white rounded-lg shadow hidden">
        <h2 class="text-xl font-bold mb-4">Festival Details</h2>
        <div id="festival-details">
            <p class="text-gray-400">Click on a marker to see festival details.</p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Initialiser la carte centrée sur l'Irlande
    var map = L.map('map', {
        center: [53.41291, -8.24389], // Coordonnées de l'Irlande
        zoom: 7,                      // Niveau de zoom initial
        minZoom: 6,                   // Niveau de zoom minimal
        maxZoom: 19                   // Niveau de zoom maximal
    });

    // Ajouter une couche de tuiles (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Définir les limites géographiques de l'Irlande
    var bounds = [
        [51.3861, -10.4701], // Sud-Ouest (latitude, longitude)
        [55.3818, -5.4310]   // Nord-Est (latitude, longitude)
    ];

    // Appliquer les limites à la carte
    map.setMaxBounds(bounds);
    map.fitBounds(bounds);

    // Ajouter les marqueurs pour chaque festival
    var festivals = @json($festivals); // Récupérer les festivals depuis le contrôleur
    festivals.forEach(function(festival) {
        if (festival.latitude && festival.longitude) {
            var marker = L.marker([festival.latitude, festival.longitude]).addTo(map);

            // Ajouter un événement de clic sur le marqueur
            marker.on('click', function() {
                // Afficher les informations du festival dans le conteneur
                var infoContainer = document.getElementById('festival-info');
                var detailsContainer = document.getElementById('festival-details');
                var festivalTitle = document.querySelector('#festival-info h2');

                // Reformater les dates
                const formatDate = (dateString) => {
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    return new Date(dateString).toLocaleDateString('en-US', options);
                };

                const startDate = festival.start_date ? formatDate(festival.start_date) : 'Unknown';
                const endDate = festival.end_date ? formatDate(festival.end_date) : 'Unknown';

                // Mettre à jour le titre avec un lien vers la page du festival
                festivalTitle.innerHTML = `<a href="/festivals/${festival.id}" class="text-custom-pink no-underline hover:text-custom-pink-dark">${festival.name}</a>`;

                // Insérer les informations du festival
                detailsContainer.innerHTML = `
                    <p><strong>Location:</strong> ${festival.location}</p>
                    <p><strong>Genre:</strong> ${festival.genre}</p>
                    <p><strong>Lineup:</strong> ${festival.lineup}</p>
                    <p><strong>Price:</strong> ${festival.price ? '$' + festival.price : 'Free'}</p>
                    <p><strong>Start Date:</strong> ${startDate}</p>
                    <p><strong>End Date:</strong> ${endDate}</p>
                `;

                // Afficher le conteneur d'informations
                infoContainer.classList.remove('hidden');

                // Faire défiler jusqu'à la section des détails
                infoContainer.scrollIntoView({ behavior: 'smooth' });
            });
        }
    });
</script>

@endsection