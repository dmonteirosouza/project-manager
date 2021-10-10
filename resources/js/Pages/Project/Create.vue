<template>
    <app-layout title="ProjectCreate">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Project
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4">
                    <div class="max-w-3xl mx-auto">
                        <form v-on:submit.prevent="submitForm">
                            <div class="mb-4">
                                <label for="name">
                                    Name:
                                </label>
                                <input type="text" id="name" class="w-full" v-model="form.name">
                            </div>
                            <div class="mb-4 flex justify-between">
                                <div class="w-2/5">
                                    <label for="start">
                                        Start at:
                                    </label>
                                    <input type="date" id="start" class="w-full" v-model="form.start">
                                </div>
                                <div class="w-2/5">
                                    <label for="finish">
                                        Finish at:
                                    </label>
                                    <input type="date" id="finish" class="w-full" v-model="form.finish">
                                </div>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="bg-green-500 hover:bg-green-400 text-white font-bold py-1 px-4 border-b-4 border-green-700 hover:border-green-500 rounded mr-2">
                                    Save
                                </button>
                                <button type="button"
                                    v-on:click="goto(route('web.projects.index'))"
                                    class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-1 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                                    Back to the list
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

export default defineComponent({
    components: {
        AppLayout,
    },
    data() {
        return {
            form: {
                name: '',
                start: '',
                finish: '',
            }
        }
    },
    methods: {
        submitForm() {
            axios.post(route('api.projects.store'), this.form).then(response => {
                this.form = {
                    name: '',
                    start: '',
                    finish: '',
                }
                this.$swal('Project was created successfully!', '', 'success')
            }).catch(err => {
                this.$swal(err.response.data.message || err.response.data.payload, '', 'error')
            })
        }
    }
})
</script>
