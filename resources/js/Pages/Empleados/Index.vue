<template>
  <div class="p-6">
    <div class="flex items-center justify-between mb-4">
      <!-- Izquierda: título y botón Nuevo Empleado -->
      <div class="flex items-center space-x-4">
        <h1 class="text-2xl font-bold">Listado de Empleados</h1>
        <Button @click="$inertia.visit(route('empleados.create'))">
          Nuevo Empleado
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
          <th class="py-2 px-4 border-b">Puesto</th>
          <th class="py-2 px-4 border-b">Creado</th>
          <th class="py-2 px-4 border-b">Actualizado</th>
          <th class="py-2 px-4 border-b align-middle">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="empleado in empleados" :key="empleado.id" class="align-middle">
          <td class="py-2 px-4 border-b align-middle">{{ empleado.id }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ empleado.nombre }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ empleado.email }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ empleado.puesto }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ new Date(empleado.created_at).toLocaleDateString() }}</td>
          <td class="py-2 px-4 border-b align-middle">{{ new Date(empleado.updated_at).toLocaleDateString() }}</td>
          <td class="py-2 px-4 border-b align-middle">
            <Button
              @click="$inertia.visit(route('empleados.edit', empleado.id))"
              class="mr-3"
            >
              Editar
            </Button>
            <Button
              as="button"
              @click="eliminarEmpleado(empleado.id)"
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
import { router } from '@inertiajs/vue3'  // Importa router de Inertia
import Button from '@/Components/PrimaryButton.vue'

const props = defineProps({
  empleados: Array
})

function eliminarEmpleado(id) {
  if (confirm('¿Estás seguro de que quieres eliminar este empleado?')) {
    router.delete(route('empleados.destroy', id), {
      onSuccess: () => {
        router.visit(route('empleados.index'))  // Redirigir al índice después de eliminar
      },
      onError: (errors) => {
        alert('Error al eliminar el empleado.')
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