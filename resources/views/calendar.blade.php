@extends('layouts.app')

@section('content')

<div class="bg-custom-orange text-center p-2.5">
    <h1 class="text-white text-xl font-bold font-custom-rubik">Find out the perfect festivals with your holidays dates!</h1>
</div>

<div class="container mx-auto mt-8">
    <div id="calendar" class="bg-custom-background-dark shadow-lg rounded-lg p-4">
        <div class="flex flex-col mb-4">
            <!-- Boutons et titre du mois -->
            <div class="flex justify-between items-center mb-4">
                <button id="prev-month" class="pl-8 pr-8 pb-1 pt-1 bg-custom-blue hover:bg-custom-blue-dark text-3xl text-center text-white rounded">←</button>
                <h2 id="month-year" class="text-xl text-white font-bold"></h2>
                <button id="next-month" class="px-8 py-1 bg-custom-blue hover:bg-custom-blue-dark text-3xl text-center text-white rounded">→</button>
            </div>

            <!-- Noms des jours -->
            <div class="grid grid-cols-7 gap-2 text-center font-bold text-white">
                <div>Monday</div>
                <div>Tuesday</div>
                <div>Wednesday</div>
                <div>Thursday</div>
                <div>Friday</div>
                <div>Saturday</div>
                <div>Sunday</div>
            </div>
        </div>

        <!-- Grille des jours -->
        <div id="calendar-days" class="grid grid-cols-7 gap-2 text-center">
            <!-- Les jours du calendrier seront générés ici -->
        </div>
    </div>

    <!-- Conteneur pour les informations du festival -->
    <div id="festival-info" class="mt-8 p-4 bg-custom-background-dark text-white rounded-lg shadow hidden">
        <h2 id="name-festival-like" class="text-xl t font-bold mb-4">Festival Details</h2>
        <div id="festival-details">
            <p class="text-gray-400">Click on a date to see festival details.</p>
        </div>
    </div>
</div>

<script>
    // Injecter les festivals depuis Laravel dans une variable JavaScript
    const festivals = @json($festivals);

    // Ajouter un événement de clic sur une date pour afficher les détails des festivals
    document.getElementById('calendar-days').addEventListener('click', function (event) {
        const clickedDate = event.target.getAttribute('data-date');
        if (!clickedDate) return;

        // Filtrer les festivals correspondant à la date cliquée
        const filteredFestivals = festivals.filter(festival => {
            const startDate = new Date(festival.start_date).toISOString().split('T')[0];
            const endDate = new Date(festival.end_date).toISOString().split('T')[0];
            return startDate === clickedDate || endDate === clickedDate;
        });

        const infoContainer = document.getElementById('festival-info');
        const detailsContainer = document.getElementById('festival-details');
        const festivalTitle = document.querySelector('#festival-info h2'); // Sélectionner le titre principal

        if (filteredFestivals.length > 0) {
            // Mettre à jour le titre principal avec le nom du premier festival comme lien cliquable
            festivalTitle.innerHTML = `<a href="/festivals/${filteredFestivals[0].id}" class="text-custom-pink no-underline hover:text-custom-pink-dark">${filteredFestivals[0].name}</a>`;

            // Insérer les informations des festivals dans le conteneur des détails
            detailsContainer.innerHTML = filteredFestivals.map(festival => {
                const startDate = new Date(festival.start_date).toISOString().split('T')[0];
                const endDate = new Date(festival.end_date).toISOString().split('T')[0];
                return `
                    <div class="mb-4">
                        <h3 class="text-lg font-bold">
                            <a href="/festivals/${festival.id}" class="text-blue-400 underline hover:text-blue-600">${festival.name}</a>
                        </h3>
                        <p><strong>Location:</strong> ${festival.location}</p>
                        <p><strong>Genre:</strong> ${festival.genre}</p>
                        <p><strong>Lineup:</strong> ${festival.lineup}</p>
                        <p><strong>Price:</strong> ${festival.price ? '$' + festival.price : 'Free'}</p>
                        <p><strong>Start Date:</strong> ${startDate}</p>
                        <p><strong>End Date:</strong> ${endDate}</p>
                        <hr class="my-4 border-gray-600">
                    </div>
                `;
            }).join('');
        } else {
            // Si aucun festival n'est trouvé, afficher un message par défaut
            festivalTitle.textContent = "Festival Details";
            detailsContainer.innerHTML = `<p class="text-gray-400">No festivals found for this date.</p>`;
        }

        // Afficher le conteneur d'informations
        infoContainer.classList.remove('hidden');
        infoContainer.scrollIntoView({ behavior: 'smooth' });
    });
</script>

@endsection