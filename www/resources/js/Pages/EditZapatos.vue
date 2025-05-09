<template>
    <!-- Barra de navegación superior -->
    <Navbar />
    <div class="container mx-auto px-4">
        <!-- Título principal de la página -->
        <h1 class="text-xl md:text-2xl font-bold mb-4">Editar Zapatos</h1>
        <div class="bg-white p-4 border rounded">
            <!-- Formulario para editar un zapato -->
            <form @submit.prevent="submit" enctype="multipart/form-data" class="max-w-2xl mx-auto">
                <!-- Campo para el nombre del zapato -->
                <div class="mb-3">
                    <label for="name" class="block mb-1">name:</label>
                    <input type="text" id="name" v-model="form.name" class="w-full border p-2 rounded" required />
                </div>

                <!-- Campo para la descripción del zapato -->
                <div class="mb-3">
                    <label for="description" class="block mb-1">description:</label>
                    <input type="text" id="description" v-model="form.description" class="w-full border p-2 rounded" required />
                </div>  

                <!-- Campo para el número del zapato -->
                <div class="mb-3">
                    <label for="mail" class="block mb-1">mail:</label>
                    <input type="text" id="mail" v-model="form.mail" class="w-full border p-2 rounded" required />
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
                        class="w-full border p-2 rounded"
                    >
                        <option value="">Seleccione una categoría</option>
                        <!-- Lista de categorías recibidas por props -->
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    <</select>
                </div>   

                <!-- Botones para cancelar o guardar los cambios -->
                <div class="flex flex-col md:flex-row justify-between mt-4 space-y-2 md:space-y-0">
                    <Link :href="route('zapatos.index')" class="w-full md:w-auto text-center bg-gray-300 px-3 py-1 rounded">
                        Cancelar
                    </Link>
                    <button type="submit" class="w-full md:w-auto bg-blue-700 text-white px-3 py-1 rounded">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Pie de página -->
    <Footer/>
</template>

<script setup>
// Importa los helpers de Inertia y Vue
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps, onMounted, ref } from 'vue';
// Importa los componentes de la barra de navegación y el pie de página
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';

// Recibe el zapato a editar y las categorías como props
const props = defineProps({
    zapatos: Object,
    categories: Array,
});

// Variable reactiva para la vista previa de la imagen seleccionada
const previewImage = ref(null);

// Formulario reactivo para el zapato, con método PUT
const form = useForm({
    name: '',
    description: '',
    mail: '',
    category_id: '',
    photo: null,
    _method: 'put',
});

// Maneja el cambio de imagen y muestra la vista previa
const handleImageChange = (event) => {
    const file = event.target.files[0];
    form.photo = file;
    
    if (file) {
        previewImage.value = URL.createObjectURL(file);
    }
};

// Al montar el componente, rellena el formulario con los datos actuales del zapato
onMounted(() => {
    if (props.zapatos) {
        form.name = props.zapatos.name;
        form.description = props.zapatos.description;
        form.mail = props.zapatos.mail;
        form.category_id = props.zapatos.category_id;
    }
});

// Función que se ejecuta al enviar el formulario
function submit() {
    // Envía los datos del formulario a la ruta 'zapatos.update' usando POST (con _method: 'put')
    form.post(route('zapatos.update', props.zapatos.id));
}
</script>

