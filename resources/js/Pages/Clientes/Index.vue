<template>
  <div class="p-6">
    <div class="flex items-center justify-between mb-4">
      <!-- Izquierda: título y botón Nuevo Cliente -->
      <div class="flex items-center space-x-4">
        <h1 class="text-2xl font-bold">Listado de Clientes</h1>
        <Button @click="$inertia.visit(route('clientes.create'))">
          Nuevo Cliente
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
          <th class="py-2 px-4 border-b">Nombre</th>
          <th class="py-2 px-4 border-b">Email</th>
          <th class="py-2 px-4 border-b">Teléfono</th>
          <th class="py-2 px-4 border-b">Dirección</th>
          <th class="py-2 px-4 border-b align-middle">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cliente in clientes" :key="cliente.id" class="align-middle">
          <td class="py-2 px-4 border-b align-middle">{{ cliente.id }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ cliente.nombre }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ cliente.email }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ cliente.telefono }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ cliente.direccion }}</td>
          <td class="py-2 px-4 border-b align-middle">
            <Button
              @click="$inertia.visit(route('clientes.edit', cliente.id))"
              class="mr-3"
            >
              Editar
            </Button>
            <Button
              as="button"
              @click="eliminarCliente(cliente.id)"
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
  clientes: Array
})

function eliminarCliente(id) {
  if (confirm('¿Estás seguro de que quieres eliminar este cliente?')) {
    router.delete(route('clientes.destroy', id), {
      onSuccess: () => {
        router.visit(route('clientes.index'))
      },
      onError: (errors) => {
        alert('Error al eliminar el cliente.')
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