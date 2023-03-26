a<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Swal from "sweetalert2";
import {Head, useForm } from '@inertiajs/vue3';
import {defineProps} from "vue";

const props = defineProps({
    data : {
        type: Object,
        required: true
    }
});

const form = useForm({
    title: props.data.task.title,
    description: props.data.task.description,
    due_date: props.data.task.due_date,
    status: props.data.task.status
});

const submit = () => {
    form.transform(data => ({
        ...data,
    })).patch(route('tasks.update',{task:props.data.task.id}), {
        onSuccess: () => {
            Swal.fire({
                icon: 'success',
                title: 'Task has been edited!',
                showConfirmButton: false,
                timer: 1500
            });
        },onError: (error) => {
            console.log(error)

        }
    });
};

</script>

<template>
    <Head title="Edit Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Task</h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">

                    <InputLabel for="title" value="Edit Task" />
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="title" value="Title" />

                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                autofocus
                                autocomplete="title"
                            />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="flex flex-wrap">
                            <InputLabel for="status" value="Status" />
                            <select
                                id="status"
                                v-model="form.status"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="status">
                                <option v-for="(value, id, index) in data.taskStates.status"
                                        :key="index" :value="value">{{ value }}</option>
                            </select>
                        </div>

                        <div>
                            <InputLabel for="description" value="Description" />

                            <TextArea
                                v-bind:modelValue="form.description"
                                v-on:update:modelValue="val => form.description = val"
                                placeholder="Enter the description"
                            />

                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div>
                            <InputLabel for="dueDate" value="Due Date" />

                            <TextInput
                                id="dueDate"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.due_date"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.due_date" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                            </Transition>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
