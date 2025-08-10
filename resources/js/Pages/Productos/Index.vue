<template>
  <div class="p-6">
    <div class="flex items-center justify-between mb-4">
      <div class="flex items-center space-x-4">
        <h1 class="text-2xl font-bold">Listado de Productos</h1>
        <Button @click="$inertia.visit(route('productos.create'))">
          Nuevo Producto
        </Button>
      </div>

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
          <th class="py-2 px-4 border-b">Nombre</th>
          <th class="py-2 px-4 border-b">Descripción</th>
          <th class="py-2 px-4 border-b">Precio</th>
          <th class="py-2 px-4 border-b">Stock</th>
          <th class="py-2 px-4 border-b">Categoría</th>
          <th class="py-2 px-4 border-b">Creado</th>
          <th class="py-2 px-4 border-b">Actualizado</th>
          <th class="py-2 px-4 border-b">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="producto in productos" :key="producto.id">
          <td class="py-2 px-4 border-b">{{ producto.id }}</td>
          <td class="py-2 px-4 border-b">{{ producto.nombre }}</td>
          <td class="py-2 px-4 border-b">{{ producto.descripcion }}</td>
          <td class="py-2 px-4 border-b">${{ Number(producto.precio).toFixed(2) }}</td>
          <td class="py-2 px-4 border-b">{{ producto.stock }}</td>
          <td class="py-2 px-4 border-b">{{ producto.categoria?.descripcion || 'N/A' }}</td>
          <td class="py-2 px-4 border-b">{{ new Date(producto.created_at).toLocaleDateString() }}</td>
          <td class="py-2 px-4 border-b">{{ new Date(producto.updated_at).toLocaleDateString() }}</td>
          <td class="py-2 px-4 border-b">
            <Button
              @click="$inertia.visit(route('productos.edit', producto.id))"
              class="mr-3"
            >
              Editar
            </Button>
            <Button
              as="button"
              @click="eliminarProducto(producto.id)"
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
import { router } from '@inertiajs/vue3'
import Button from '@/Components/PrimaryButton.vue'

const props = defineProps({
  productos: Array
})

function eliminarProducto(id) {
  if (confirm('¿Seguro quieres eliminar este producto?')) {
    router.delete(route('productos.destroy', id), {
      onSuccess: () => router.visit(route('productos.index')),
      onError: () => alert('Error al eliminar el producto.')
    })
  }
}
</script>

<style scoped>
table {
  border-collapse: collapse;
}
</style>