<template>
  <div class="p-6">
    <div class="flex items-center justify-between mb-4">
      <!-- Izquierda: título y botón Nueva Categoría -->
      <div class="flex items-center space-x-4">
        <h1 class="text-2xl font-bold">Listado de Categorías</h1>
        <Button @click="$inertia.visit(route('categorias.create'))">
          Nueva Categoría
        </Button>
      </div>

      <!-- Derecha: botón Volver -->
      <div>
        <Button @click="$inertia.visit(route('dashboard'))">
          Volver
        </Button>
      </div>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
      <thead>
        <tr class="text-left">
          <th class="py-2 px-4 border-b">ID</th>
          <th class="py-2 px-4 border-b">Descripción</th>
          <th class="py-2 px-4 border-b">Creado</th>
          <th class="py-2 px-4 border-b">Actualizado</th>
          <th class="py-2 px-4 border-b align-middle">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="categoria in categorias" :key="categoria.id" class="align-middle">
          <td class="py-2 px-4 border-b align-middle">{{ categoria.id }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ categoria.descripcion }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ new Date(categoria.created_at).toLocaleDateString() }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ new Date(categoria.updated_at).toLocaleDateString() }}</td>
          <td class="py-2 px-4 border-b align-middle">
            <Button
              @click="$inertia.visit(route('categorias.edit', categoria.id))"
              class="mr-3"
            >
              Editar
            </Button>
            <Button
              as="button"
              @click="eliminarCategoria(categoria.id)"
              class="bg-red-600 hover:bg-red-700"
            >
              Eliminar
            </Button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import { router } from '@inertiajs/vue3'  // <--- Importa router aquí
import Button from '@/Components/PrimaryButton.vue'

const props = defineProps({
  categorias: Array
})

function eliminarCategoria(id) {
  if (confirm('¿Estás seguro de que quieres eliminar esta categoría?')) {
    router.delete(route('categorias.destroy', id), {
      onSuccess: () => {
        router.visit(route('categorias.index'))  // Redirige al índice tras eliminar
      },
      onError: (errors) => {
        alert('Error al eliminar la categoría.')
        console.error(errors)
      }
    })
  }
}
</script>

<style scoped>
table {
  border-collapse: collapse;
}
</style>