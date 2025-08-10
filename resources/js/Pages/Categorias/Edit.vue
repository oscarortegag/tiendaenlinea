<template>
  <div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Editar Categoría</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="descripcion" class="block font-medium mb-1">Descripción</label>
        <input
          v-model="form.descripcion"
          type="text"
          id="descripcion"
          class="w-full rounded border-gray-300"
          :class="{ 'border-red-500': form.errors.descripcion }"
          autocomplete="off"
          required
        />
        <p v-if="form.errors.descripcion" class="text-red-600 text-sm mt-1">
          {{ form.errors.descripcion }}
        </p>
      </div>

      <div class="flex justify-between">
        <PrimaryButton type="submit">Guardar cambios</PrimaryButton>
        <PrimaryButton
          type="button"
          class="bg-gray-500 hover:bg-gray-600"
          @click="$inertia.visit(route('categorias.index'))"
        >
          Cancelar
        </PrimaryButton>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue'


const props = defineProps({
  categoria: Object,
})




const form = useForm({
  descripcion: props.categoria.descripcion || '',
})

function submit() {
  form.put(route('categorias.update', props.categoria.id))
}
</script>
