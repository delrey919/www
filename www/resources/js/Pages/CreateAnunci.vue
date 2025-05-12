<template>
    <Navbar />
    <main class="container mx-auto px-4" role="main">
        <h1 class="text-xl md:text-2xl font-bold mb-4" role="heading" aria-level="1">Crear Anunci</h1>
        <div class="bg-white p-4 border rounded">
            <form @submit.prevent="submit" enctype="multipart/form-data" class="max-w-2xl mx-auto" role="form" aria-label="Formulario de creación de anunci">
                <!-- Campos igual que en CreateZapatos.vue, pero usando form.name, form.description, etc. -->
                <!-- ... -->
            </form>
        </div>
    </main>
    <Footer />
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps, onMounted, ref } from 'vue';
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
    category_id: '',
    photo: null,
});

const handleImageChange = (event) => {
    const file = event.target.files[0];
    form.photo = file;
    if (file) {
        previewImage.value = URL.createObjectURL(file);
    }
};

function submit() {
    form.post(route('anunci.store'));
}
</script>