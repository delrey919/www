<template>
    <!-- Barra de navegación superior -->
    <Navbar />
    <main class="container mx-auto px-4" role="main">
        <!-- Título principal de la página -->
        <h1 class="text-xl md:text-2xl font-bold mb-4" role="heading" aria-level="1">Crear Zapatos</h1>
        <div class="bg-white p-4 border rounded">
            <!-- Formulario para crear un zapato -->
            <form @submit.prevent="submit" enctype="multipart/form-data" class="max-w-2xl mx-auto" role="form" aria-label="Formulario de creación de zapato">
                <!-- Campo para el nombre del zapato -->
                <div class="mb-3">
                    <label for="name" class="block mb-1">Nombre del zapato:</label>
                    <input 
                        type="text" 
                        id="name" 
                        v-model="form.name" 
                        class="w-full border p-2 rounded" 
                        required 
                        aria-required="true"
                        aria-label="Nombre del zapato"
                    />
                </div>

                <!-- Campo para la descripción del zapato -->
                <div class="mb-3">
                    <label for="description" class="block mb-1">Descripción:</label>
                    <textarea 
                        id="description" 
                        v-model="form.description" 
                        rows="3"
                        class="w-full border p-2 rounded" 
                        required 
                        aria-required="true"
                        aria-label="Descripción del zapato"
                    ></textarea>
                </div>

                <!-- Campo para el número del zapato -->
                <div class="mb-3">
                    <label for="mail" class="block mb-1">Mail:</label>
                    <input 
                        type="text" 
                        id="mail" 
                        v-model="form.mail" 
                        class="w-full border p-2 rounded"
                        required 
                        aria-required="true"
                        aria-label="mail"
                    />
                </div>

                <!-- Selección de la categoría del zapato -->
                <div class="mb-3">
                    <label for="category_id" class="block mb-1">Categoría:</label>
                    <select 
                        id="category_id" 
                        v-model="form.category_id" 
                        required
                        aria-required="true"
                        aria-label="Seleccionar categoría"
                    >
                        <option value="">Seleccione una categoría</option>
                        <!-- Lista de categorías recibidas por props -->
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <!-- Campo para la fecha -->
                <div class="mb-3">
                    <label for="date" class="block mb-1">Fecha:</label>
                    <input 
                        type="date" 
                        id="date" 
                        v-model="form.date" 
                        class="w-full border p-2 rounded"
                        required

                    />
                </div>

                <!-- Campo para la hora -->
                <div class="mb-3">
                    <label for="hora" class="block mb-1">Hora:</label>
                    <input 
                        type="time" 
                        id="hora" 
                        v-model="form.hora" 
                        class="w-full border p-2 rounded"
                        required

                    />
                </div>

                <!-- Botones para cancelar o guardar el zapato -->
                <div class="flex flex-col md:flex-row justify-between mt-4 space-y-2 md:space-y-0">
                    <Link 
                        :href="route('zapatos.index')" 
                        class="w-full md:w-auto text-center bg-gray-300 px-3 py-1 rounded"
                        role="button"
                    >
                        Cancelar
                    </Link>
                    <button 
                        type="submit" 
                        class="w-full md:w-auto bg-blue-700 text-white px-3 py-1 rounded"
                    >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </main>
    <!-- Pie de página -->
    <Footer />
</template>

<script setup>
// Importa los helpers de Inertia y Vue
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps, onMounted, ref } from 'vue';
// Importa los componentes de la barra de navegación y el pie de página
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';

// Recibe las categorías como prop para el select
const props = defineProps({
    categories: Array,
});

// Formulario reactivo para el zapato
const form = useForm({
    name: '',
    description: '',
    date: '',
    hora: '',
    mail: '',
    category_id: '',

});

// Función que se ejecuta al enviar el formulario
function submit() {
    // Envía los datos del formulario a la ruta 'zapatos.store' usando POST
    form.post(route('zapatos.store'));
}
</script>