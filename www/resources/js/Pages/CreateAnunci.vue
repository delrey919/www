<template>
    <Navbar />
    <main class="container mx-auto px-4" role="main">
        <h1 class="text-xl md:text-2xl font-bold mb-4" role="heading" aria-level="1">Crear Anunci</h1>
        <div class="bg-white p-4 border rounded">
            <form @submit.prevent="submit" enctype="multipart/form-data" class="max-w-2xl mx-auto" role="form" aria-label="Formulario de creación de anunci">
                <!-- Campo para el nombre del anunci -->
                <div class="mb-3">
                    <label for="name" class="block mb-1">Nombre del anunci:</label>
                    <input 
                        type="text" 
                        id="name" 
                        v-model="form.name" 
                        class="w-full border p-2 rounded" 
                        required 
                        aria-required="true"
                        aria-label="Nombre del anunci"
                    />
                </div>

                <!-- Campo para la descripción del anunci -->
                <div class="mb-3">
                    <label for="description" class="block mb-1">Descripción:</label>
                    <textarea 
                        id="description" 
                        v-model="form.description" 
                        rows="3"
                        class="w-full border p-2 rounded" 
                        required 
                        aria-required="true"
                        aria-label="Descripción del anunci"
                    ></textarea>
                </div>

                <!-- Campo para el mail -->
                <div class="mb-3">
                    <label for="mail" class="block mb-1">Mail:</label>
                    <input 
                        type="email" 
                        id="mail" 
                        v-model="form.mail" 
                        class="w-full border p-2 rounded"
                        required 
                        aria-required="true"
                        aria-label="Mail"
                    />
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
                        aria-required="true"
                        aria-label="Fecha"
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
                        aria-required="true"
                        aria-label="Hora"
                    />
                </div>

                <!-- Selección de la categoría del anunci -->
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
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <!-- Botones para cancelar o guardar el anunci -->
                <div class="flex flex-col md:flex-row justify-between mt-4 space-y-2 md:space-y-0">
                    <Link 
                        :href="route('anunci.index')" 
                        class="w-full md:w-auto text-center bg-gray-300 px-3 py-1 rounded"
                        role="button"
                        aria-label="Cancelar creación de anunci"
                    >
                        Cancelar
                    </Link>
                    <button 
                        type="submit" 
                        class="w-full md:w-auto bg-blue-700 text-white px-3 py-1 rounded"
                        aria-label="Guardar anunci"
                    >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </main>
    <Footer />
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
    categories: Array,
});

const previewImage = ref(null);

const form = useForm({
    name: '',
    description: '',
    mail: '',
    date: '',
    hora: '',
    category_id: '',
});

function submit() {
    form.post(route('anunci.store'));
}
</script>