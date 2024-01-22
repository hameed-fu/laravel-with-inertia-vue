

<template>
  <Head title="Files" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Files</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <Link
          :href="route('file.create')"
          class="bg-blue-700 rounded px-3 py-2 hover:bg-blue-800 font-bold text-white"
          >Add New</Link
        >
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
          <div class="p-6 text-gray-900">
            <div
              v-if="$page.props.flash.success"
              class="container text-blue-700 font-bold mt-2 text-start bg-sky-200 rounded p-2"
            >
              {{ $page.props.flash.success }}
            </div>
            <div class="text-2xl font-bold">Files</div>

            <div class="relative overflow-x-auto">
              <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
              >
                <thead
                  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                  <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">File</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="file in files"
                    :key="file.id"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                  >
                  <th>{{ 1 }}</th>
                    <th
                      scope="row"
                      class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                    <img :src="getImageUrl('files',file.file)" alt="File Image" class="w-20 h-20 mt-2 object-cover rounded">

                    </th>

                    <td class="px-6 py-4">
                      <Link
                        :href="route('file.edit',file.id)"
                        class="bg-orange-400 rounded px-2 py-1 hover:bg-orange-500 font-bold mr-1 text-white"
                        >
                        Edit
                      </Link>

                      <button
                        @click="deleteFile(file.id)"
                        class="bg-red-700 rounded px-2 py-1 hover:bg-red-800 font-bold text-white"
                        >
                        Delete
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { useForm } from '@inertiajs/vue3';
import { getImageUrl } from "../../Components/FileUtils.vue";

defineProps({
  files: Object,
});

components :{
    Link, Head,getImageUrl
}



const form = useForm({
  id: "",
})

const deleteFile = (id) => {
  if (confirm("Are you sure you want to delete this record?")) {
    return form.get(route("file.delete", id));
  }
};

</script>

