<template>
    <app-layout title="Projects">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projects
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <button
                    v-on:click="goto(route('web.projects.create'))"
                    class="bg-green-500 hover:bg-green-400 text-white font-bold py-1 px-4 border-b-4 border-green-700 hover:border-green-500 rounded mb-2 block ml-auto">
                    New Project
                </button>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Start</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Complete</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Overdue</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <ProjectItem
                                v-for="project in projects"
                                v-bind:key="project.id"
                                v-bind:project="project"
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
import ProjectItem from './Partials/ProjectItem'
import emitter from 'tiny-emitter/instance'

export default defineComponent({
    components: {
        AppLayout,
        ProjectItem
    },
    data() {
        return {
            projects: []
        }
    },
    methods: {
        loadProjects() {
            axios.get(route('api.projects.index')).then(response => {
                this.projects = response.data.payload
            }).catch(err => {
                console.log(err)
            })
        }
    },
    mounted() {
        emitter.on('deleteProject', () => {
            this.loadProjects()
        })
        this.loadProjects()
    }
})
</script>
