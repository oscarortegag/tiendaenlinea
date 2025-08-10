<template>
  <div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Editar Cliente</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="nombre" class="block font-medium mb-1">Nombre</label>
        <input
          v-model="form.nombre"
          id="nombre"
          type="text"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.nombre }"
          autocomplete="off"
          required
        />
        <p v-if="form.errors.nombre" class="text-red-600 text-sm mt-1">{{ form.errors.nombre }}</p>
      </div>

      <div class="mb-4">
        <label for="email" class="block font-medium mb-1">Email</label>
        <input
          v-model="form.email"
          id="email"
          type="email"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.email }"
          autocomplete="off"
          required
        />
        <p v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</p>
      </div>

      <div class="mb-4">
        <label for="telefono" class="block font-medium mb-1">Teléfono</label>
        <input
          v-model="form.telefono"
          id="telefono"
          type="text"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.telefono }"
          autocomplete="off"
          required
        />
        <p v-if="form.errors.telefono" class="text-red-600 text-sm mt-1">{{ form.errors.telefono }}</p>
      </div>

      <div class="mb-4">
        <label for="direccion" class="block font-medium mb-1">Dirección</label>
        <input
          v-model="form.direccion"
          id="direccion"
          type="text"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.direccion }"
          autocomplete="off"
          required
        />
        <p v-if="form.errors.direccion" class="text-red-600 text-sm mt-1">{{ form.errors.direccion }}</p>
      </div>

      <div class="flex space-x-4">
        <PrimaryButton type="submit">Guardar cambios</PrimaryButton>
        <PrimaryButton type="button" class="bg-gray-500 hover:bg-gray-600" @click="$inertia.visit(route('clientes.index'))">
          Cancelar
        </PrimaryButton>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { defineProps } from 'vue'

const props = defineProps({
  cliente: Object,
})

const form = useForm({
  nombre: props.cliente.nombre || '',
  email: props.cliente.email || '',
  telefono: props.cliente.telefono || '',
  direccion: props.cliente.direccion || '',
})

function submit() {
  form.put(route('clientes.update', props.cliente.id))
}
</script>