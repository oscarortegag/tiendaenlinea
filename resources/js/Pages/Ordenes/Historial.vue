<template>
  <div class="p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Historial de Pedidos</h1>
      <div>
        <Button @click="$inertia.visit(route('dashboard'))">
          Volver
        </Button>
      </div>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
      <thead>
        <tr class="text-left">
          <th class="py-2 px-4 border-b">ID Detalle</th>
          <th class="py-2 px-4 border-b">Producto</th>
          <th class="py-2 px-4 border-b">Fecha</th>
          <th class="py-2 px-4 border-b">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="orden in ordenes" :key="orden.id">
          <td class="py-2 px-4 border-b">{{ orden.detalle?.id ?? 'N/A' }}</td>
          <td class="py-2 px-4 border-b">{{ orden.detalle?.producto?.nombre ?? 'N/A' }}</td>
          <td class="py-2 px-4 border-b">{{ new Date(orden.created_at).toLocaleDateString() }}</td>
          <td class="py-2 px-4 border-b">
            <button
              @click="verDetalle(orden)"
              class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700"
            >
              Ver
            </button>
          </td>
        </tr>
        <tr v-if="!ordenes.length">
          <td colspan="4" class="py-4 text-center text-gray-500">No hay pedidos en el historial.</td>
        </tr>
      </tbody>
    </table>

    <!-- Modal -->
    <div v-if="modalVisible" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
        <h2 class="text-xl font-semibold mb-4">Información del Pedido</h2>
        
        <p><strong>Producto:</strong> {{ selectedOrden?.detalle?.producto?.nombre ?? 'N/A' }}</p>
        <p><strong>Cliente:</strong> {{ selectedOrden?.cliente?.nombre ?? 'N/A' }}</p>
        <p><strong>Empleado:</strong> {{ selectedOrden?.empleado?.nombre ?? 'N/A' }}</p>
        <p><strong>Cantidad:</strong> {{ selectedOrden?.detalle?.cantidad ?? 'N/A' }}</p>
        <p><strong>Precio Total:</strong> ${{ Number(selectedOrden?.detalle?.precio ?? 0).toFixed(2) }}</p>
        
        <button
          @click="modalVisible = false"
          class="mt-6 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
        >
          Cerrar
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps } from 'vue'
import Button from '@/Components/PrimaryButton.vue'

const props = defineProps({
  ordenes: Array,
})

const modalVisible = ref(false)
const selectedOrden = ref(null)

function verDetalle(orden) {
  selectedOrden.value = orden
  modalVisible.value = true
}
</script>