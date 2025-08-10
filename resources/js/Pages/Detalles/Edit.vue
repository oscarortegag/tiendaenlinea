<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Detalle de Orden</h1>

    <form @submit.prevent="submit">
      <!-- Producto -->
      <div class="mb-4">
        <label for="producto_id" class="block text-sm font-medium text-gray-700">Producto</label>
        <select
          v-model="form.producto_id"
          id="producto_id"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
        >
          <option value="">Seleccione un producto</option>
          <option v-for="producto in productos" :key="producto.id" :value="producto.id">
            {{ producto.nombre }} (Stock: {{ producto.stock }}) - ${{ Number(producto.precio).toFixed(2) }}
          </option>
        </select>
        <div v-if="form.errors.producto_id" class="text-red-600 text-sm">
          {{ form.errors.producto_id }}
        </div>
      </div>

      <!-- Cantidad -->
      <div class="mb-4">
        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
        <input
          type="number"
          id="cantidad"
          v-model="form.cantidad"
          min="1"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
        />
        <div v-if="form.errors.cantidad" class="text-red-600 text-sm">
          {{ form.errors.cantidad }}
        </div>
      </div>

      <!-- Botones -->
      <div class="flex space-x-4">
        <button
          type="submit"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
          Actualizar
        </button>
        <button
          type="button"
          @click="$inertia.visit(route('detalles.index'))"
          class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
        >
          Volver
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
  detalle: Object,
  productos: Array
});

const form = useForm({
  producto_id: props.detalle.producto_id,
  cantidad: props.detalle.cantidad
});

const submit = () => {
  form.put(route("detalles.update", props.detalle.id));
};
</script>