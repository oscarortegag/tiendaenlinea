<template>
  <div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Editar Empleado</h1>

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
        <p v-if="form.errors.nombre" class="text-red-600 text-sm mt-1">{{ form.errors.nombre }}</p>
      </div>

      <div class="mb-4">
        <label for="email" class="block font-medium mb-1">Email</label>
        <input
          v-model="form.email"
          type="email"
          id="email"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.email }"
          autocomplete="off"
          required
        />
        <p v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</p>
      </div>

      <div class="mb-4">
        <label for="puesto" class="block font-medium mb-1">Puesto</label>
        <input
          v-model="form.puesto"
          type="text"
          id="puesto"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.puesto }"
          autocomplete="off"
          required
        />
        <p v-if="form.errors.puesto" class="text-red-600 text-sm mt-1">{{ form.errors.puesto }}</p>
      </div>

      <div class="flex justify-between">
        <PrimaryButton type="submit">Guardar Cambios</PrimaryButton>
        <PrimaryButton
          type="button"
          class="bg-gray-500 hover:bg-gray-600"
          @click="$inertia.visit(route('empleados.index'))"
        >
          Cancelar
        </PrimaryButton>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { defineProps } from 'vue'

const props = defineProps({
  empleado: Object
})

const form = useForm({
  nombre: props.empleado.nombre || '',
  email: props.empleado.email || '',
  puesto: props.empleado.puesto || '',
})

function submit() {
  form.put(route('empleados.update', props.empleado.id))
}
</script>