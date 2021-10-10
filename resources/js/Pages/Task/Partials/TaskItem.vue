<template>
    <tr>
        <td class="px-6 py-4 text-left whitespace-nowrap">{{ task.project.name }}</td>
        <td class="px-6 py-4 text-left whitespace-nowrap">{{ task.name }}</td>
        <td class="px-6 py-4 text-center whitespace-nowrap">{{ moment(task.start) }}</td>
        <td class="px-6 py-4 text-center whitespace-nowrap">{{ moment(task.finish) }}</td>
        <td class="px-6 py-4 text-center whitespace-nowrap">
            <button
                v-on:click="change(task)"
                v-bind:class="{
                    'bg-green-500 hover:bg-green-400 border-green-700 hover:border-green-500' : task.status,
                    'bg-pink-500 hover:bg-pink-400 border-pink-700 hover:border-pink-500' : !task.status,
                }"
                class="text-white font-bold py-1 px-4 border-b-4 rounded mb-2 mr-1">
                {{ task.status ? 'Mark as not completed' : 'Mark as completed' }}
            </button>

            <button
                v-on:click="deleteTask(task)"
                class="bg-pink-500 hover:pink text-white font-bold py-1 px-4 border-b-4 border-pink-700 hover:border-pink-500 rounded"
            >
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
import emitter from 'tiny-emitter/instance'

export default {
    name: "TaskItem",
    props: ['task'],
    methods: {
        change(task) {
            axios.put(route('api.projects.tasks.update', { project_id: task.project_id, task_id: task.id }), {}).then(response => {
                task.status = response.data.payload

                this.$swal('Task was changed successfully!', '', 'success')
            }).catch(err => {
                this.$swal(err.response.data.message || err.response.data.payload, '', 'error')
            })
        },
        deleteTask(task) {
            this.$swal({
                title: "Delete this task?",
                text: "Are you sure? You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Yes, Delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(route('api.projects.tasks.destroy', { project_id: task.project_id, task_id: task.id }), {}).then(response => {
                        emitter.emit('deleteProject')

                        this.$swal('Task was removed successfully!', '', 'success')
                    }).catch(err => {
                        this.$swal(err.response.data.message || err.response.data.payload, '', 'error')
                    })
                }
            })
        }
    }
}
</script>
