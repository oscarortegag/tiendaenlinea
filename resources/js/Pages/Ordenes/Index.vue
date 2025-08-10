<template>
  <div class="p-6">
    <div class="flex items-center justify-between mb-4">
      <!-- Izquierda: título y botón Nuevo Orden -->
      <div class="flex items-center space-x-4">
        <h1 class="text-2xl font-bold">Listado de Órdenes de Compra</h1>
        <Button @click="$inertia.visit(route('ordenes.create'))">
          Nueva Orden
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
          <th class="py-2 px-4 border-b">Producto</th>
          <th class="py-2 px-4 border-b">Cliente</th>
          <th class="py-2 px-4 border-b">Empleado</th>
          <th class="py-2 px-4 border-b">Folio</th>
          <th class="py-2 px-4 border-b">Fecha</th>
          <th class="py-2 px-4 border-b align-middle">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="orden in ordenes" :key="orden.id">
          <td class="py-2 px-4 border-b">{{ orden.id }}</td>
          <td class="py-2 px-4 border-b">{{ orden.producto.nombre }}</td>
          <td class="py-2 px-4 border-b">{{ orden.cliente.nombre }}</td>
          <td class="py-2 px-4 border-b">{{ orden.empleado.nombre }}</td>
          <td class="py-2 px-4 border-b">{{ orden.detalle.id }}</td>
          <td class="py-2 px-4 border-b">{{ new Date(orden.created_at).toLocaleDateString() }}</td>
          <td class="py-2 px-4 border-b">
            <Button @click="$inertia.visit(route('ordenes.edit', orden.id))" class="mr-3">
              Editar
            </Button>
            <Button
              as="button"
              @click="eliminarOrden(orden.id)"
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
import { router } from '@inertiajs/vue3'  // Aquí está el cambio
import Button from '@/Components/PrimaryButton.vue'

const props = defineProps({
  ordenes: Array,
})

function eliminarOrden(id) {
  if (confirm('¿Estás seguro de que quieres eliminar esta orden?')) {
    router.delete(route('ordenes.destroy', id), {
      onSuccess: () => {
        router.visit(route('ordenes.index'))  // Refresca la lista después de eliminar
      },
      onError: (errors) => {
        alert('Error al eliminar la orden.')
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