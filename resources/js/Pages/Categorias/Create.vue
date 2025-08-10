<template>
  <div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Crear Nueva Categoría</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
        <input
          id="descripcion"
          type="text"
          v-model="form.descripcion"
          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
          autocomplete="off"
          autofocus
        />
        <p v-if="errors.descripcion" class="text-red-600 text-sm mt-1">{{ errors.descripcion }}</p>
      </div>

      <div class="flex justify-end space-x-2">
        <PrimaryButton type="submit">Guardar</PrimaryButton>
        <PrimaryButton type="button" @click="cancel">Cancelar</PrimaryButton>
      </div>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'


const form = useForm({
  descripcion: '',
})

const errors = reactive({})

function submit() {
  form.post(route('categorias.store'), {
    onError: (errs) => {
      Object.assign(errors, errs)
    },
  })
}

function cancel() {
  // Vuelve a la lista de categorías
  window.location.href = route('categorias.index')
}
</script>