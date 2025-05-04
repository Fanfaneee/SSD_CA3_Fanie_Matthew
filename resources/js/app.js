import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    console.log('Festivals:', festivals); // Vérifiez que les festivals sont bien injectés

    const calendarGrid = document.querySelector('#calendar-days'); // Cible uniquement la grille des jours
    const monthYear = document.getElementById('month-year');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const festivalInfo = document.getElementById('festival-info'); // Conteneur des infos du festival
    const festivalDetails = document.getElementById('festival-details'); // Détails du festival

    let currentDate = new Date();

    // Tableau de couleurs pour les festivals (utilisant les couleurs personnalisées de Tailwind)
    const festivalColors = [
        'bg-custom-blue',
        'bg-custom-purple',
        'bg-custom-pink',
        'bg-custom-orange',
        'bg-custom-yellow'
    ];

    function renderCalendar(date) {
        calendarGrid.innerHTML = ''; // Réinitialise uniquement la grille des jours
        const year = date.getFullYear();
        const month = date.getMonth();

        // Mettre à jour le titre du mois
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        monthYear.textContent = `${monthNames[month]} ${year}`;

        // Obtenir le premier jour et le nombre de jours dans le mois
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Ajouter des cases vides pour les jours avant le début du mois
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('text-gray-400', 'border', 'p-2', 'rounded', 'bg-gray-50');
            calendarGrid.appendChild(emptyCell);
        }

        // Ajouter les jours du mois
        for (let day = 1; day <= daysInMonth; day++) {
            const cell = document.createElement('div');
            cell.classList.add('h-32', 'border', 'p-2', 'rounded', 'bg-gray-100', 'hover:bg-gray-200', 'relative', 'flex', 'flex-col');

            // Conteneur pour le numéro du jour
            const dayNumber = document.createElement('div');
            dayNumber.textContent = day;
            dayNumber.classList.add('text-lg', 'font-bold', 'mb-2'); // Style pour le numéro du jour
            cell.appendChild(dayNumber);

            // Conteneur pour les lignes des festivals
            const festivalContainer = document.createElement('div');
            festivalContainer.classList.add('flex', 'flex-col', 'gap-1', 'mt-auto'); // Conteneur pour les lignes
            cell.appendChild(festivalContainer);

            // Vérifier si le jour est dans l'intervalle d'un festival
            const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            let festivalCount = 0; // Compteur pour gérer les lignes multiples
            festivals.forEach((festival, index) => {
                const startDate = new Date(festival.start_date);
                const endDate = new Date(festival.end_date);

                if (new Date(dateString) >= startDate && new Date(dateString) <= endDate) {
                    // Créer une ligne colorée pour le festival
                    const festivalLine = document.createElement('div');
                    festivalLine.textContent = festival.name;
                    festivalLine.classList.add('text-xs', 'text-white', 'p-1', 'rounded', 'bg-opacity-80', 'cursor-pointer');
                    
                    // Attribuer une couleur unique à partir du tableau des couleurs
                    const colorClass = festivalColors[index % festivalColors.length];
                    festivalLine.classList.add(colorClass);

                    // Ajouter un gestionnaire de clic pour afficher les infos du festival
                    festivalLine.addEventListener('click', () => {
                        // Mettre à jour le titre avec le nom du festival
                        const festivalTitle = document.querySelector('#festival-info h2');
                        festivalTitle.textContent = festival.name;

                        // Mettre à jour les détails du festival
                        festivalDetails.innerHTML = `
                            <p><strong>Start Date:</strong> ${festival.start_date}</p>
                            <p><strong>End Date:</strong> ${festival.end_date}</p>
                            <p><strong>Location:</strong> ${festival.location || 'Unknown'}</p>
                            <p><strong>Genre:</strong> ${festival.genre || 'Unknown'}</p>
                            <p><strong>Lineup:</strong> ${festival.lineup || 'Unknown'}</p>
                            <p><strong>Price:</strong> ${festival.price || 'Unknown'}</p>
                        `;

                        // Afficher la section des détails
                        festivalInfo.classList.remove('hidden');

                        // Faire défiler jusqu'à la section des détails
                        festivalInfo.scrollIntoView({ behavior: 'smooth' });
                    });

                    // Ajouter la ligne dans le conteneur des festivals
                    festivalContainer.appendChild(festivalLine);
                    festivalCount++;
                }
            });

            calendarGrid.appendChild(cell);
        }

        // Ajouter des cases pour compléter la grille
        const totalCells = firstDay + daysInMonth;
        const remainingCells = 7 - (totalCells % 7);
        if (remainingCells < 7) {
            for (let i = 1; i <= remainingCells; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.classList.add('text-gray-400', 'border', 'p-2', 'rounded', 'bg-gray-50');
                calendarGrid.appendChild(emptyCell);
            }
        }
    }

    // Gestion des boutons précédent/suivant
    prevMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    nextMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    // Initialiser le calendrier
    renderCalendar(currentDate);
});

