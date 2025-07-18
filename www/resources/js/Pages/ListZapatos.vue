<template>
    <!-- Barra de navegación superior -->
    <Navbar />
    <main class="container mx-auto px-4" role="main">
        <!-- Título principal, clicable para volver al inicio -->
        <h1 class="text-center text-3xl md:text-5xl p-4" @click="Welcome" role="heading" aria-level="1">
            Benvinguts a la nostra pàgina d'anuncis
        </h1>
        <!-- Botón para crear un nuevo zapato -->
        <div class="text-center text-lg md:text-xl p-4">
            <button 
                @click="CreateZapatos" 
                class="w-full md:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                aria-label="Crear nuevo zapato"
            >
                Crear Anuncis
            </button>
        </div>

        <!-- Buscador de zapatos por nombre o categoría -->
        <div class="search-container text-center mt-8" role="search">
            <label for="zapato-search" class="sr-only">Buscar Anuncis</label>
            <input 
                id="zapato-search"
                type="text" 
                v-model="search" 
                placeholder="Buscar por nombre o categoría..." 
                class="w-full md:w-1/2 px-4 py-2 border rounded-lg shadow-sm"
                aria-label="Buscar zapatos por nombre o categoría"
            />
            <!-- Filtro por categoría con accesibilidad -->
            <label for="category-select" class="sr-only">Filtrar por categoría</label>
            <select
                id="category-select"
                v-model="selectedCategory"
                class="w-full md:w-1/4 px-4 py-2 border rounded-lg shadow-sm mt-2 md:mt-0 md:ml-4"
                aria-label="Filtrar por categoría"
            >
                <option value="">Todas las categorías</option>
                <option v-for="category in uniqueCategories" :key="category" :value="category">
                    {{ category }}
                </option>
            </select>
        </div>

        <!-- Tabla responsive que muestra la lista de zapatos -->
        <div class="overflow-x-auto p-4" role="region" aria-label="Lista de zapatos">
            <table class="w-full border min-w-[800px]" role="grid">
                <thead>
                    <tr class="bg-gray-400 text-left">
                        <th scope="col" class="p-2 border border-black">Name</th>
                        <th scope="col" class="p-2 border border-black">Categoria</th>
                        <th scope="col" class="p-2 border border-black">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorre los zapatos paginados y muestra cada uno en una fila -->
                    <tr v-for="zapato in paginatedZapatos" :key="zapato.id" role="row">
                        <td class="p-2 border border-black" role="cell">{{ zapato.name }}</td>
                        <td class="p-2 border border-black" role="cell">
                            <select
                                v-model="zapato.category_id"
                                @change="updateCategory(zapato)"
                                class="border rounded"
                            >
                                <option v-for="cat in allCategories" :key="cat.id" :value="cat.id">
                                    {{ cat.name }}
                                </option>
                            </select>
                        </td>
                        <td class="p-2 border border-black" role="cell">
                            <!-- Acciones: Ver, Editar, Eliminar -->
                            <div class="flex gap-2">
                                <Link 
                                    :href="route('zapatos.show', zapato.id)" 
                                    class="text-green-500 hover:underline"
                                    aria-label="Ver detalles del zapato"
                                >
                                    Ver
                                </Link>
                                <Link 
                                    :href="route('zapatos.edit', zapato.id)" 
                                    class="text-blue-500 hover:underline"
                                    aria-label="Editar zapato"
                                >
                                    Editar
                                </Link>
                                <button 
                                    @click="DeleteZapatos(zapato.id)" 
                                    class="text-red-500 hover:underline"
                                    aria-label="Eliminar zapato"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Controles de paginación -->
            <div class="flex justify-center items-center mt-4 space-x-2">
                <button
                    @click="currentPage--"
                    :disabled="currentPage === 1"
                    class="px-3 py-1 bg-gray-300 rounded disabled:opacity-50"
                >
                    Anterior
                </button>
                <span>Página {{ currentPage }} de {{ totalPages }}</span>
                <button
                    @click="currentPage++"
                    :disabled="currentPage === totalPages"
                    class="px-3 py-1 bg-gray-300 rounded disabled:opacity-50"
                >
                    Siguiente
                </button>
            </div>
        </div>
    </main>

    <!-- Pie de página -->
    <Footer />
</template>

<script setup>
// Importaciones necesarias
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, defineProps, computed, onMounted, onUnmounted } from 'vue';
import axios from 'axios';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';

// Definición de las props que recibe el componente
const props = defineProps({
    zapatos: Array,
});

// Variables reactivas
const search = ref(''); // Para el input de búsqueda
const currentIndex = ref(0); // Índice actual del carrusel
const autoplayInterval = ref(null); // Intervalo para el autoplay del carrusel
const selectedCategory = ref(''); // Categoría seleccionada en el <select>
const showCarousel = ref(true); // NUEVO: Controla la visibilidad del carrusel

// --- Paginación local (5 elementos por página) ---
const currentPage = ref(1); // Página actual
const itemsPerPage = 5;     // Zapatos por página

// function DeleteZapatos(id){
//     router.delete(route('zapatos.destroy', id))
// }


// Función para eliminar un zapato
function DeleteZapatos(id) {
  router.delete(route('zapatos.destroy', id), {
    preserveScroll: true,
    onSuccess: () => {
        zapato.value = zapato.value.filter(zapato => zapato.id !== id);
    }
  });
}

// Función para ir a la página de inicio
function Welcome(){
    router.visit('/');
}

// Función para ir a la página de crear zapatos
function CreateZapatos(){
    router.visit('zapatos/create');
}

// Función para ir a la siguiente imagen del carrusel
const nextImage = () => {
    if (props.zapatos.length > 0) {
        currentIndex.value = (currentIndex.value + 1) % props.zapatos.length;
    }
};

// Computed para filtrar los zapatos según el texto de búsqueda
const filteredEvents = computed(() =>
  props.zapatos.filter(event =>
    (
      event.name.toLowerCase().includes(search.value.toLowerCase()) ||
      (event.category && event.category.name &&
        event.category.name.toLowerCase().includes(search.value.toLowerCase()))
    ) &&
    (selectedCategory.value === '' || event.category?.name === selectedCategory.value)
  )
);

// Computed para obtener los zapatos de la página actual
const paginatedZapatos = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return filteredEvents.value.slice(start, end);
});

// Computed para saber cuántas páginas hay
const totalPages = computed(() => {
  return Math.ceil(filteredEvents.value.length / itemsPerPage);
});

// Cuando el componente se monta, inicia el autoplay del carrusel
onMounted(() => {
  if (props.zapatos.length > 0) {
    autoplayInterval.value = setInterval(nextImage, 3000);
  }
});

// Cuando el componente se desmonta, limpia el intervalo del autoplay
onUnmounted(() => {
  if (autoplayInterval.value) {
    clearInterval(autoplayInterval.value);
  }
});

const uniqueCategories = computed(() => {
  const categories = new Set();
  props.zapatos.forEach(zapato => {
    if (zapato.category?.name) {
      categories.add(zapato.category.name);
    }
  });
  return Array.from(categories);
});

const allCategories = ref([]);

onMounted(() => {
  axios.get('/api/categories').then(res => {
    allCategories.value = res.data;
  });
});

function updateCategory(zapato) {
  axios.put(`/zapatos/${zapato.id}/category`, { category_id: zapato.category_id });
}
</script>