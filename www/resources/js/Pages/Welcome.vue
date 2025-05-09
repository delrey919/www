<template>
    <!-- Barra de navegación superior -->
    <Navbar />
    <div
        v-if="showCookieBanner"
        class="fixed bottom-0 left-0 w-full bg-gray-800 text-white p-4 flex justify-between items-center z-50"
    >
        <div>
            Aquest lloc utilita cookies per millorar la tevaexperiència. Al continuar navegant, accepta el nostre us de cookies.        </div>
        <button
            @click="acceptCookies"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Aceptar
        </button>
    </div>
    <div class="container mx-auto px-4">
        <!-- Logo centrado y responsive -->
        <div class="flex justify-center items-center mt-8 mb-4">
            <img
                src="/images/wow.png"
                alt="Logo"
                class="h-20 w-auto md:h-32 transition-all duration-300"
                style="max-width: 90vw;"
            />
        </div>
        <!-- Título principal, clicable para volver al inicio -->
        <div class="text-center text-3xl md:text-5xl p-4" @click="Welcome">
            Benvinguts a la nostra pàgina d'anuncis
        </div>
        <!-- Botones para crear zapatos o categorías -->
        <div class="text-center text-lg md:text-xl p-4 space-y-2 md:space-y-0 md:space-x-4">
            <button @click="CreateZapatos" class="w-full md:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Anuncis
            </button>
            <button @click="CreateCategories" class="w-full md:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Categorias
            </button>
        </div>        
    </div>
</template>

<script setup>
// Importa los helpers de Inertia y Vue
import { Link, router } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, computed } from 'vue';
// Importa los componentes de la barra de navegación y el pie de página
import Navbar from '@/Components/Navbar.vue';

// Props para recibir los datos de las tablas
const props = defineProps({
    zapatos: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
});


// Funciones de navegación
function Welcome(){
    router.visit('/');
}
function CreateZapatos(){
    router.visit('zapatos/create');
}
function CreateCategories(){
    router.visit('categories/create');
}

function acceptCookies() {
    localStorage.setItem('cookiesAccepted', 'true');
    showCookieBanner.value = false;
}
const showCookieBanner = ref(!localStorage.getItem('cookiesAccepted'));


</script>