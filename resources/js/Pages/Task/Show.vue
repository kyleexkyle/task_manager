a<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from "sweetalert2";
import {Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    task : {
        type: Object,
        required: true
    }
});

const toggleStatusForm = useForm({
    status: ''
});


const toggleTaskStatus = (task,status) => {
    toggleStatusForm.status = status

    toggleStatusForm.put(route('task.status.update',{task:task.id},{
        onSuccess: (response) => {
            Swal.fire({
                icon: 'success',
                title: 'Task has been edited!',
                showConfirmButton: false,
                timer: 1500
            });
        },onError: (error) => {
            console.log(error)
        }
    }))
}

</script>

<template>
    <Head title="Show Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Show Task</h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div class="flex flex-col space-y-2">
                        <div class="flex justify-between">
                            <p class="font-semibold">{{ task.data.title }}</p>
                            <p class="text-gray-500 text-sm">Due on: {{ task.data.due_date }}</p>
                        </div>
                        <div class="text-gray-500"> {{ task.data.description }}</div>
                        <div class="text-gray-500 flex flex-row space-x-2">
                            <span
                                :class="'text-'+task.data.status.color+'-800 bg-'+task.data.status.color+'-300'"
                                class="px-3 py-1 rounded-md">
                              {{ task.data.status.name }}
                            </span>

                            <svg @click="toggleTaskStatus(task.data,'complete')"
                                 v-if="task.data.status.name == 'incomplete'"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5 text-green-500 my-auto">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>

                            <svg @click="toggleTaskStatus(task.data,'incomplete')"
                                 v-if="task.data.status.name == 'complete'"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5 text-red-500 my-auto">
                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
