<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Tienda en linea" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tienda En linea
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6 flex space-x-4">
                    <button
                        @click="$inertia.visit(route('detalles.index'))"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    >
                         Detalles de Compra
                    </button>
                    <button
                        @click="$inertia.visit(route('ordenes.index'))"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
                    >
                         Orden de Compra
                    </button>
                    <button
                        @click="$inertia.visit(route('ordenes.historial'))"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
                    >
                         Historial de pedidos
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>