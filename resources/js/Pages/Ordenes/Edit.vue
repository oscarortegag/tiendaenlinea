<template>
  <div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Editar Orden de Compra</h1>

    <form @submit.prevent="submit">
      <!-- Producto: solo lectura, se actualiza al cambiar detalle_id -->
      <div class="mb-4">
        <label for="producto_nombre" class="block font-medium mb-1">Producto</label>
        <input
          type="text"
          id="producto_nombre"
          class="w-full rounded border-gray-300 bg-gray-100 cursor-not-allowed"
          :value="productoNombre"
          readonly
        />
      </div>

      <div class="mb-4">
        <label for="cliente_id" class="block font-medium mb-1">Cliente</label>
        <select v-model="form.cliente_id" id="cliente_id" class="w-full rounded border-gray-300" required>
          <option value="" disabled>Selecciona un cliente</option>
          <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
            {{ cliente.nombre }}
          </option>
        </select>
        <p v-if="form.errors.cliente_id" class="text-red-600 text-sm mt-1">{{ form.errors.cliente_id }}</p>
      </div>

      <div class="mb-4">
        <label for="empleado_id" class="block font-medium mb-1">Empleado</label>
        <select v-model="form.empleado_id" id="empleado_id" class="w-full rounded border-gray-300" required>
          <option value="" disabled>Selecciona un empleado</option>
          <option v-for="empleado in empleados" :key="empleado.id" :value="empleado.id">
            {{ empleado.nombre }}
          </option>
        </select>
        <p v-if="form.errors.empleado_id" class="text-red-600 text-sm mt-1">{{ form.errors.empleado_id }}</p>
      </div>

      <div class="mb-4">
        <label for="detalle_id" class="block font-medium mb-1">Detalle de Orden</label>
        <select
          v-model="form.detalle_id"
          id="detalle_id"
          class="w-full rounded border-gray-300"
          required
          @change="actualizarProducto"
        >
          <option value="" disabled>Selecciona un detalle</option>
          <option v-for="detalle in detalles" :key="detalle.id" :value="detalle.id">
            {{ detalle.id }} - {{ detalle.producto.nombre }}
          </option>
        </select>
        <p v-if="form.errors.detalle_id" class="text-red-600 text-sm mt-1">{{ form.errors.detalle_id }}</p>
      </div>

      <div class="flex justify-between">
        <PrimaryButton type="submit">Actualizar Orden</PrimaryButton>
        <PrimaryButton
          type="button"
          class="bg-gray-500 hover:bg-gray-600"
          @click="$inertia.visit(route('ordenes.index'))"
        >
          Cancelar
        </PrimaryButton>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { defineProps } from 'vue'

const props = defineProps({
  orden: Object,
  clientes: Array,
  empleados: Array,
  detalles: Array,
})

const form = useForm({
  producto_id: props.orden.producto_id,
  cliente_id: props.orden.cliente_id,
  empleado_id: props.orden.empleado_id,
  detalle_id: props.orden.detalle_id,
})

const productoNombre = ref('')

// Función para actualizar el nombre del producto al cambiar detalle_id
function actualizarProducto() {
  const detalleSeleccionado = props.detalles.find(detalle => detalle.id === form.detalle_id)
  if (detalleSeleccionado && detalleSeleccionado.producto) {
    form.producto_id = detalleSeleccionado.producto.id
    productoNombre.value = detalleSeleccionado.producto.nombre
  } else {
    form.producto_id = ''
    productoNombre.value = ''
  }
}

// Inicializa el nombre del producto al cargar el formulario
actualizarProducto()

function submit() {
  form.put(route('ordenes.update', props.orden.id))
}
</script>