<template>
    <!-- Overlay para bloquear la interacción -->
    <div
        v-if="showCookieBanner"
        class="fixed inset-0 bg-black bg-opacity-50 z-40"
        style="pointer-events: all;"
    ></div>
    <!-- Barra de navegación superior -->
    <Navbar />
    <div
        v-if="showCookieBanner"
        class="fixed bottom-0 left-0 w-full bg-gray-800 text-white p-4 flex justify-between items-center z-50"
        style="pointer-events: all;"
    >
        <div>
            Aquest lloc utiliza cookies per millorar la teva experiència. Al continuar navegant, acceptes el nostre ús de cookies.        </div>
        <button
            @click="acceptCookies"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Acceptar
        </button>
    </div>
    <div class="container mx-auto px-4" :aria-hidden="showCookieBanner ? 'true' : 'false'">
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
import { ref, onMounted, onUnmounted, computed, watch } from 'vue';
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
    document.body.classList.remove('overflow-hidden');
}
const showCookieBanner = ref(!localStorage.getItem('cookiesAccepted'));

// Evita el scroll cuando el banner está activo
watch(showCookieBanner, (val) => {
    if (val) {
        document.body.classList.add('overflow-hidden');
    } else {
        document.body.classList.remove('overflow-hidden');
    }
});
onMounted(() => {
    if (showCookieBanner.value) {
        document.body.classList.add('overflow-hidden');
    }
});
onUnmounted(() => {
    document.body.classList.remove('overflow-hidden');
});

</script>