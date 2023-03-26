<template>
    <div class="dropdown relative">
        <button
            class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            @click="isOpen = !isOpen"
        >
            {{ selectedOption }}
            <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10.293 14.293a1 1 0 0 1-1.414 0l-4-4a1 1 0 1 1 1.414-1.414L10 11.586l3.293-3.293a1 1 0 1 1 1.414 1.414l-4 4z" clip-rule="evenodd" />
            </svg>
        </button>
        <ul
            v-show="isOpen"
            class="absolute z-10 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
        >
            <li
                v-for="(option, index) in options"
                :key="index"
                @click="selectOption(option)"
                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900"
            >
                {{ option }}
            </li>
        </ul>
    </div>
</template>

<script setup>
import {ref, watch} from 'vue';

const props = defineProps({
    options : {
        type: Object,
        required: true
    },
    selectedOption : {
        type: String,
        required: true
    }
});

const isOpen = ref(false);

const selectedOption = ref(props.selectedOption);

function selectOption(option) {
    selectedOption.value = option;
    isOpen.value = false;
}
</script>
