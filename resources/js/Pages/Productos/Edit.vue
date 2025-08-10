<template>
  <div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Editar Producto</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="nombre" class="block font-medium mb-1">Nombre</label>
        <input
          v-model="form.nombre"
          type="text"
          id="nombre"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.nombre }"
          autocomplete="off"
          required
        />
        <p v-if="form.errors.nombre" class="text-red-600 text-sm mt-1">
          {{ form.errors.nombre }}
        </p>
      </div>

      <div class="mb-4">
        <label for="descripcion" class="block font-medium mb-1">Descripción</label>
        <textarea
          v-model="form.descripcion"
          id="descripcion"
          rows="3"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.descripcion }"
          required
        ></textarea>
        <p v-if="form.errors.descripcion" class="text-red-600 text-sm mt-1">
          {{ form.errors.descripcion }}
        </p>
      </div>

      <div class="mb-4">
        <label for="precio" class="block font-medium mb-1">Precio</label>
        <input
          v-model.number="form.precio"
          type="number"
          step="0.01"
          min="0"
          id="precio"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.precio }"
          required
        />
        <p v-if="form.errors.precio" class="text-red-600 text-sm mt-1">
          {{ form.errors.precio }}
        </p>
      </div>

      <div class="mb-4">
        <label for="stock" class="block font-medium mb-1">Stock</label>
        <input
          v-model.number="form.stock"
          type="number"
          min="0"
          id="stock"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.stock }"
          required
        />
        <p v-if="form.errors.stock" class="text-red-600 text-sm mt-1">
          {{ form.errors.stock }}
        </p>
      </div>

      <div class="mb-4">
        <label for="categoria_id" class="block font-medium mb-1">Categoría</label>
        <select
          v-model="form.categoria_id"
          id="categoria_id"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.categoria_id }"
          required
        >
          <option value="" disabled>Selecciona una categoría</option>
          <option v-for="cat in categorias" :key="cat.id" :value="cat.id">{{ cat.descripcion }}</option>
        </select>
        <p v-if="form.errors.categoria_id" class="text-red-600 text-sm mt-1">
          {{ form.errors.categoria_id }}
        </p>
      </div>

      <div class="flex justify-between">
        <Button type="submit">Guardar cambios</Button>
        <Button type="button" class="bg-gray-500 hover:bg-gray-600" @click="$inertia.visit(route('productos.index'))">
          Cancelar
        </Button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import Button from '@/Components/PrimaryButton.vue'
import { defineProps } from 'vue'

const props = defineProps({
  producto: Object,
  categorias: Array
})

const form = useForm({
  nombre: props.producto.nombre || '',
  descripcion: props.producto.descripcion || '',
  precio: props.producto.precio || null,
  stock: props.producto.stock || null,
  categoria_id: props.producto.categoria_id || '',
})

function submit() {
  form.put(route('productos.update', props.producto.id))
}
</script>