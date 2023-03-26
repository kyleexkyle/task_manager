<template>
  <textarea
      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :rows="rows"
      :cols="cols"
      :placeholder="placeholder"
  ></textarea>
</template>

<script setup>
const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    rows: {
        type: Number,
        default: 4,
    },
    cols: {
        type: Number,
        default: 50,
    },
    placeholder: {
        type: String,
        default: "",
    },
});
</script>
