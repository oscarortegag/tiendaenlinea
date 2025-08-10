<template>
  <div class="p-6">
    <div class="flex items-center justify-between mb-4">
      <!-- Izquierda: título y botón Nuevo Detalle -->
      <div class="flex items-center space-x-4">
        <h1 class="text-2xl font-bold">Listado de Detalles de Orden</h1>
        <Button @click="$inertia.visit(route('detalles.create'))">
          Nuevo Detalle
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
          <th class="py-2 px-4 border-b">Folio</th>
          <th class="py-2 px-4 border-b">Producto</th>
          <th class="py-2 px-4 border-b">Cantidad</th>
          <th class="py-2 px-4 border-b">Precio Total</th>
          <th class="py-2 px-4 border-b">Fecha</th>
             <th class="py-2 px-4 border-b">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="detalle in detalles" :key="detalle.id">
          <td class="py-2 px-4 border-b">{{ detalle.id }}</td>
          <td class="py-2 px-4 border-b">{{ detalle.producto?.nombre ?? 'N/A' }}</td>
          <td class="py-2 px-4 border-b">{{ detalle.cantidad }}</td>
          <td class="py-2 px-4 border-b">
            ${{ Number(detalle.precio || 0).toFixed(2) }}
          </td>
          <td class="py-2 px-4 border-b">
            {{ new Date(detalle.created_at).toLocaleDateString() }}
          </td>
           <td class="py-2 px-4 border-b">
            <Button
              @click="$inertia.visit(route('detalles.edit', detalle.id))"
              class="mr-3"
            >
              Editar
            </Button>
            <Button
              as="button"
              @click="eliminarDetalle(detalle.id)"
              class="bg-red-600 hover:bg-red-700"
            >
              Eliminar
            </Button>
          </td>
        </tr>
        <tr v-if="!detalles.length">
          <td colspan="5" class="py-4 text-center text-gray-500">
            No hay detalles de orden registrados.
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
  detalles: Array
})

function eliminarDetalle(id) {
  if (confirm('¿Estás seguro de que quieres eliminar este detalle?')) {
    router.delete(route('detalles.destroy', id), {
      onSuccess: () => {
        router.visit(route('detalles.index')) // Opcional, recarga la lista después de eliminar
      },
      onError: (errors) => {
        alert('Error al eliminar el detalle.')
        console.error(errors)
      }
    })
  }
}
</script>