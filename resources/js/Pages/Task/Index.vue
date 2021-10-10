<template>
    <app-layout title="Projects">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <button
                        v-on:click="goto(route('web.projects.index'))"
                        class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-1 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded mb-2 block mr-1">
                        Back to projects
                    </button>
                    <button
                        v-on:click="goto(route('web.projects.tasks.create', { project_id: route().params.project_id }))"
                        class="bg-green-500 hover:bg-green-400 text-white font-bold py-1 px-4 border-b-4 border-green-700 hover:border-green-500 rounded mb-2">
                        New Task
                    </button>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Start</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Complete</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <TaskItem
                            v-for="task in tasks"
                            v-bind:key="task.id"
                            v-bind:task="task"
                        />
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import TaskItem from './Partials/TaskItem'

export default defineComponent({
    components: {
        AppLayout,
        TaskItem
    },
    data() {
        return {
            tasks: []
        }
    },
    mounted() {
        const params = route().params

        axios.get(route('api.projects.tasks.index', { project_id: params.project_id })).then(response => {
            this.tasks = response.data.payload
        }).catch(err => {
            console.log(err)
        })
    }
})
</script>
