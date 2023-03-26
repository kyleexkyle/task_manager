a<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link} from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Table from '@/Components/Table.vue'
import Swal from "sweetalert2";
import {useForm} from "@inertiajs/vue3";
import {ref, watch} from "vue";

const props = defineProps({
    tasks : {
        type: Object,
        required: true
    },
    taskStates : {
        type: Object,
        required: true
    }
});

const form = useForm({});

const toggleStatusForm = useForm({
    status: ''
});

const deleteTask = (task,index) => {
    Swal.fire({
        icon: "warning",
        title: 'Are you sure you want to delete this task?',
        text: "You will not be able to recover this task once deleted",
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, cancel it!"
    }).then(
        function (result) {
            if (result['isConfirmed']){

                form.delete(route('tasks.destroy',{task:task.id}), {
                    onSuccess: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Task has been deleted!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },onError: (error) => {
                        console.log(error)
                    }
                });

                props.tasks.data.splice(index,1);
            }

        },
        function () { return false; });
}

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
    <Head title="My Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Tasks</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">

                <Link :href="route('tasks.create')"
                      class="inline-flex justify-self-end px-4 py-2 bg-gray-800 border
                      border-transparent rounded-md font-semibold text-xs text-white
                      uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700
                      active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500
                      focus:ring-offset-2 transition ease-in-out duration-150">
                    Create Task
                </Link>

                <div class="bg-white shadow-sm sm:rounded-lg">

                    <table
                        class="shadow w-full text-sm text-left text-gray-500 lg:overflow-auto overflow-x-scroll"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50"
                        >
                        <tr>
                            <th scope="col" class="uppercase px-6 py-3">Title</th>
                            <th scope="col" class="uppercase px-6 py-3">Description</th>
                            <th scope="col" class="uppercase px-6 py-3">Due Date</th>
                            <th scope="col" class="uppercase px-6 py-3">Status</th>
                            <th scope="col" class="uppercase px-6 py-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            class="bg-white border-b odd:bg-white even:bg-gray-50"
                            v-for="(task,index) in tasks.data[0]"
                            :key="task.id"
                        >
                            <td class="px-6 py-4">
                                {{ task.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ task.description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ task.due_date }}
                            </td>
                            <td class="px-6 py-4 flex flex-row space-x-2">
                                <span
                                    :class="'text-'+task.status.color+'-800 bg-'+task.status.color+'-300'"
                                    class="px-3 py-1 rounded-md">
                                    {{ task.status.name }}
                                </span>

                                <svg @click="toggleTaskStatus(task,'complete')"
                                    v-if="task.status.name == 'incomplete'"
                                    xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5 text-green-500 my-auto">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>

                                <svg @click="toggleTaskStatus(task,'incomplete')"
                                    v-if="task.status.name == 'complete'"
                                    xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5 text-red-500 my-auto">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>

                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <Link class="text-green-500 " :href="route('tasks.show',{task:task.id})">
                                    View
                                </Link>

                                <Link class="text-yellow-500 " :href="route('tasks.edit',{task:task.id})">
                                    Edit
                                </Link>

                                <button @click="deleteTask(task,index)" class="text-red-500">Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <div class="text-red-800 bg-red-300 text-green-800 bg-green-300">

    </div>
</template>
