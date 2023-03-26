<template>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <template v-for="(header, index) in headers" :key="index">
                    <th
                        :class="[
                            'py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
                            index === 0 ? 'rounded-l-lg' : '',
                            index === headers.length - 1 ? 'rounded-r-lg' : '',
                          ]"
                    >
                        {{ header }}
                    </th>
                </template>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <template v-for="(row, rowIndex) in data" :key="rowIndex">
                <tr :class="[rowIndex % 2 === 0 ? 'bg-gray-50' : '']">
                    <template v-for="(value, key, index) in row" :key="index">
                        <td
                            :class="[
                              'py-4 px-6 text-sm font-medium text-gray-900',
                              index === 0 ? 'rounded-l-lg' : '',
                              index === Object.keys(row).length - 1 ? 'rounded-r-lg' : '',
                            ]"
                        >
                            {{ value }}
                        </td>
                    </template>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>

const props = defineProps({
    headers: {
        type: Array,
        required: true,
    },
    data: {
        type: Array,
        required: true,
    },
    trClass: {
        type: String,
        default: '',
    },
    tdClass: {
        type: String,
        default: '',
    },
});
</script>
