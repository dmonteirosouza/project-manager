<template>
    <tr>
        <td class="px-6 py-4 text-left whitespace-nowrap">{{ project.name }}</td>
        <td class="px-6 py-4 text-center whitespace-nowrap">{{ moment(project.start) }}</td>
        <td class="px-6 py-4 text-center whitespace-nowrap">{{ moment(project.finish) }}</td>
        <td class="px-6 py-4 text-center whitespace-nowrap">
            <div class="relative pt-1">
                <div class="flex mb-2 items-center justify-between">
                    <div class="text-right">
                      <span class="text-xs font-semibold inline-block" v-bind:class="{
                          'text-pink-600': project.percent <= 33.33,
                          'text-yellow-600': project.percent > 33.33 && project.percent <= 66.66,
                          'text-green-600': project.percent > 66.66,
                      }">
                        {{ project.percent }}%
                      </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded" v-bind:class="{
                          'bg-pink-200': project.percent <= 33.33,
                          'bg-yellow-200': project.percent > 33.33 && project.percent <= 66.66,
                          'bg-green-200': project.percent > 66.66,
                      }">
                    <div :style="{ width: project.percent + '%' }" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center" v-bind:class="{
                          'bg-pink-600': project.percent <= 33.33,
                          'bg-yellow-600': project.percent > 33.33 && project.percent <= 66.66,
                          'bg-green-600': project.percent > 66.66,
                      }"></div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4 text-center whitespace-nowrap">
            <div>
              <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white" v-bind:class="{
                  'bg-green-600': !project.deadline,
                  'bg-pink-600': project.deadline,
              }">
                {{ project.deadline ? 'Yes' : 'No' }}
              </span>
            </div>
        </td>
        <td class="px-6 py-4 text-center whitespace-nowrap">
            <button
                v-on:click="goto(route('web.projects.tasks.index', {project_id: project.id}))"
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-1 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded mr-1"
            >
                Tasks
            </button>

            <button
                v-on:click="deleteProject(project)"
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
    name: "ProjectItem",
    props: ['project'],
    methods: {
        deleteProject(project) {
            this.$swal({
                title: "Delete this project?",
                text: "Are you sure? You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Yes, Delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(route('api.projects.destroy', {project_id: project.id})).then(response => {
                        emitter.emit('deleteProject')

                        this.$swal('Project was removed successfully!', '', 'success')
                    }).catch(err => {
                        console.log(err)
                    })
                }
            })
        }
    }
}
</script>
