<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Registrar Detalle de Orden</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block mb-1 font-medium">Producto</label>
        <select v-model="form.producto_id" class="border p-2 rounded w-full" @change="updatePrecio">
          <option value="">Seleccione un producto</option>
          <option v-for="producto in productos" :key="producto.id" :value="producto.id">
            {{ producto.nombre }} - Stock: {{ producto.stock }} - ${{ Number(producto.precio).toFixed(2) }}
          </option>
        </select>
        <div v-if="errors.producto_id" class="text-red-500 text-sm">{{ errors.producto_id }}</div>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-medium">Cantidad</label>
        <input type="number" v-model.number="form.cantidad" min="1" class="border p-2 rounded w-full" />
        <div v-if="errors.cantidad" class="text-red-500 text-sm">{{ errors.cantidad }}</div>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-medium">Precio Total</label>
        <input type="text" :value="precioTotalDisplay" disabled class="border p-2 rounded w-full bg-gray-100" />
      </div>

      <div class="flex space-x-4">
        <Button type="submit">Guardar</Button>
        <Button type="button" @click="$inertia.visit(route('detalles.index'))">Volver</Button>
      </div>

      <div v-if="stockInsuficiente" class="mt-4 text-red-600 font-semibold">
        Stock insuficiente para la cantidad seleccionada.
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Button from '@/Components/PrimaryButton.vue'

const props = defineProps({
  productos: Array,
  errors: Object
})

const form = useForm({
  producto_id: '',
  cantidad: 1
})

const stockInsuficiente = ref(false)
const precioUnitario = ref(0)

const updatePrecio = () => {
  const prod = props.productos.find(p => p.id === form.producto_id)
  precioUnitario.value = prod ? Number(prod.precio) : 0
}

const precioTotalDisplay = computed(() => {
  return (precioUnitario.value * form.cantidad).toFixed(2)
})

const submit = () => {
  const producto = props.productos.find(p => p.id === form.producto_id)

  if (producto && producto.stock < form.cantidad) {
    stockInsuficiente.value = true
    return
  }

  stockInsuficiente.value = false
  form.post(route('detalles.store'))
}
</script>