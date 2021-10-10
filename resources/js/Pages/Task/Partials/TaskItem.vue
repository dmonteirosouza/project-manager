<template>
    <tr>
        <td class="px-6 py-4 text-left whitespace-nowrap">{{ task.project.name }}</td>
        <td class="px-6 py-4 text-left whitespace-nowrap">{{ task.name }}</td>
        <td class="px-6 py-4 text-center whitespace-nowrap">{{ moment(task.start) }}</td>
        <td class="px-6 py-4 text-center whitespace-nowrap">{{ moment(task.finish) }}</td>
        <td class="px-6 py-4 text-center whitespace-nowrap">
            <div>
              <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white" v-bind:class="{
                  'bg-green-600': task.status,
                  'bg-pink-600': !task.status,
              }">
                {{ task.status ? 'Yes' : 'No' }}
              </span>
            </div>
        </td>
        <td class="px-6 py-4 text-center whitespace-nowrap">

        </td>
    </tr>
</template>

<script>
export default {
    name: "TaskItem",
    props: ['task']
}
</script>
