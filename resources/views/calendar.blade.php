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
    <div id="festival-info" class="mt-8 p-4 bg-gray-800 text-white rounded-lg shadow hidden">
        <h2 class="text-xl font-bold mb-4">Festival Details</h2>
        <div id="festival-details">
        </div>
    </div>
</div>

<script>
    // Injecter les festivals depuis Laravel dans une variable JavaScript
    const festivals = @json($festivals);
</script>

@endsection