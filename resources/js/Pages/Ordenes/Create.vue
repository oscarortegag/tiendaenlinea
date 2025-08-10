<template>
  <div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Registrar Orden de Compra</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="cliente_id" class="block font-medium mb-1">Cliente</label>
        <select
          id="cliente_id"
          v-model="form.cliente_id"
          class="w-full rounded border-gray-300"
          required
        >
          <option value="" disabled>Seleccione un cliente</option>
          <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
            {{ cliente.nombre }}
          </option>
        </select>
      </div>

      <div class="mb-4">
        <label for="empleado_id" class="block font-medium mb-1">Empleado</label>
        <select
          id="empleado_id"
          v-model="form.empleado_id"
          class="w-full rounded border-gray-300"
          required
        >
          <option value="" disabled>Seleccione un empleado</option>
          <option v-for="empleado in empleados" :key="empleado.id" :value="empleado.id">
            {{ empleado.nombre }} - {{ empleado.puesto }}
          </option>
        </select>
      </div>

      <div class="mb-4">
        <label for="detalle_id" class="block font-medium mb-1">Detalle de Orden</label>
        <select
          id="detalle_id"
          v-model="form.detalle_id"
          class="w-full rounded border-gray-300"
          required
        >
          <option value="" disabled>Seleccione un detalle de orden</option>
          <option v-for="detalle in detalles" :key="detalle.id" :value="detalle.id">
            Pedido #{{ detalle.id }} - Producto: {{ detalle.producto.nombre }} - Cantidad: {{ detalle.cantidad }}
          </option>
        </select>
      </div>

      <PrimaryButton type="submit">Guardar</PrimaryButton>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
  clientes: Array,
  empleados: Array,
  detalles: Array,  // Aquí envías los detalles de orden
})

const form = useForm({
  cliente_id: '',
  empleado_id: '',
  detalle_id: '',
})

function submit() {
  if (!form.cliente_id || !form.empleado_id || !form.detalle_id) {
    alert('Debe seleccionar cliente, empleado y detalle de orden')
    return
  }

  form.post(route('ordenes.store'), {
    onError: (errors) => {
      console.log(errors)
    },
  })
}
</script>