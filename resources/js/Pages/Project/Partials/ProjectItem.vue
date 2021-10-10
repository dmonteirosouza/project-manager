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
                          'text-amber-200': project.percent > 33.33 && project.percent <= 66.66,
                          'text-emerald-300': project.percent > 33.33 && project.percent <= 66.66,
                      }">
                        {{ project.percent }}%
                      </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-pink-200">
                    <div :style="{ width: project.percent + '%' }" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center" v-bind:class="{
                          'bg-pink-600': project.percent <= 33.33,
                          'bg-yellow-200': project.percent > 33.33 && project.percent <= 66.66,
                          'bg-green-300': project.percent > 33.33 && project.percent <= 66.66,
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
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-1 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
            >
                Tasks
            </button>
        </td>
    </tr>
</template>

<script>
export default {
    name: "ProjectItem",
    props: ['project']
}
</script>
