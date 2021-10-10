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
                class="text-white font-bold py-1 px-4 border-b-4 rounded mb-2">
                {{ task.status ? 'Yes' : 'No' }}
            </button>
        </td>
    </tr>
</template>

<script>
export default {
    name: "TaskItem",
    props: ['task'],
    methods: {
        change(task) {
            axios.put(route('api.projects.tasks.update', { project_id: task.project_id, task_id: task.id }), {}).then(response => {
                task.status = response.data.payload

                this.$swal('Project was changed successfully!', '', 'success');
            }).catch(err => {
                this.$swal(err.response.data.message || err.response.data.payload, '', 'error');
            })
        }
    }
}
</script>
