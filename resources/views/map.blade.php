@extends('layouts.app')

@section('content')

<div class="bg-custom-pink text-center p-2.5">
    <h1 class="text-white text-xl font-bold font-custom-rubik">Find out your favorite festivals on the map!</h1>
</div>

<!-- Conteneur principal -->
<div class="flex justify-center items-center h-screen">
    <!-- Carte -->
    <div id="map" class="w-2/3 h-2/3 border-4 border-gray-700 rounded-lg shadow-lg"></div>

    <!-- Conteneur pour les informations du festival -->
    <div id="festival-info" class="w-1/3 h-2/3 bg-gray-800 text-white p-4 overflow-y-auto hidden">
        <h2 class="text-xl font-bold mb-4">Festival Details</h2>
        <div id="festival-details">
            <!-- Les informations du festival seront insérées ici -->
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

            // Reformater les dates
            const formatDate = (dateString) => {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('en-US', options);
            };

            const startDate = festival.start_date ? formatDate(festival.start_date) : 'Unknown';
            const endDate = festival.end_date ? formatDate(festival.end_date) : 'Unknown';

            // Insérer les informations du festival
            detailsContainer.innerHTML = `
                <h3 class="text-lg font-bold">${festival.name}</h3>
                <p><strong>Location:</strong> ${festival.location}</p>
                <p><strong>Genre:</strong> ${festival.genre}</p>
                <p><strong>Lineup:</strong> ${festival.lineup}</p>
                <p><strong>Price:</strong> ${festival.price ? '$' + festival.price : 'Free'}</p>
                <p><strong>Start Date:</strong> ${startDate}</p>
                <p><strong>End Date:</strong> ${endDate}</p>
            `;

            // Afficher le conteneur d'informations
            infoContainer.classList.remove('hidden');
        });
    }
});
</script>

@endsection