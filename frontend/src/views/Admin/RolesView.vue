<script setup lang="ts">
import {onMounted, ref} from "vue";
import useRoles from "@/axios/useRoles";
import type {Role} from "@/types/Role";
import usePermissions from "@/axios/usePermissions";
import type {Permission} from "@/types/Permission";
import useRolePermissions from "@/axios/useRolePermissions";
import type {RolePermission} from "@/types/RolePermission";
import AdminLayout from "@/layouts/AdminLayout.vue";

const {indexRoles, deleteRoles} = useRoles();
const roles = ref<Role[]>();

const {indexPermissions, deletePermissions} = usePermissions();
const permissions = ref<Permission[]>();

const {indexRolePermissions} = useRolePermissions();
const rolePermissions = ref<RolePermission[]>();

const hasPermission = async (role: number, permissions: number) => {

}

onMounted(async () => {
  roles.value = await indexRoles();
  permissions.value = await indexPermissions();
  rolePermissions.value = await indexRolePermissions();

  console.log(roles.value);
  console.log(permissions.value);
  console.log(rolePermissions.value);
});
</script>

<template>
  <AdminLayout>
    <h1 class="text-center mb-5">Управление правами ролей</h1>

    <div class="flex gap-4 mb-6">
      <!--      <div class="flex-1">-->
      <!--        <input-->
      <!--          v-model="newRoleName"-->
      <!--          placeholder="Новая роль"-->
      <!--          class="w-full p-2 border rounded"-->
      <!--          @keyup.enter="addNewRole"-->
      <!--        />-->
      <!--      </div>-->
      <!--      <div class="flex-1">-->
      <!--        <input-->
      <!--          v-model="newPermissionName"-->
      <!--          placeholder="Новое право"-->
      <!--          class="w-full p-2 border rounded"-->
      <!--          @keyup.enter="addNewPermission"-->
      <!--        />-->
      <!--      </div>-->
    </div>

    <!-- Таблица -->
    <div class="overflow-x-auto shadow-md rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th class="px-6 py-3">Права / Роли</th>
          <th
            v-for="role in roles"
            :key="role.id"
            class="px-6 py-3 whitespace-nowrap"
          >
            <div class="flex items-center justify-between">
              <span>{{ role.name }}</span>
              <button
                @click="deleteRoles(role.id)"
                class="text-red-500 hover:text-red-700 ml-2"
              >
                ×
              </button>
            </div>
          </th>
        </tr>
        </thead>

        <tbody>
        <tr
          v-for="permission in permissions"
          :key="permission.id"
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
        >
          <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
            <div class="flex items-center">
              <span>{{ permission.name }}</span>
              <button
                @click="deletePermissions(permission.id)"
                class="text-red-500 hover:text-red-700 ml-2"
              >
                ×
              </button>
            </div>
          </td>

          <td
            v-for="role in roles"
            :key="role.id"
            class="px-6 py-4"
          >
            <input
              type="checkbox"
              :checked="hasPermission(role.id, permission.id)"
              @change="togglePermission(role, permission, $event.target.checked)"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />
          </td>
        </tr>
        </tbody>
      </table>

      <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
              class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              type="button">
        Toggle modal
      </button>

      <div id="crud-modal" tabindex="-1" aria-hidden="true"
           class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
              class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Create New Product
              </h3>
              <button type="button"
                      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                      data-modal-toggle="crud-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>

            <!-- Modal body -->
            <form class="p-4 md:p-5">
              <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                  <label for="name"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
                  <input type="text" name="name" id="name"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         placeholder="Type product name" required="">
                </div>
                <div class="col-span-2 sm:col-span-1">
                  <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                  <input type="number" name="price" id="price"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         placeholder="$2999" required="">
                </div>
                <div class="col-span-2">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    Description</label>
                  <textarea id="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write product description here"></textarea>
                </div>
              </div>

              <button type="submit"
                      class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
                Сохранить
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<style scoped>

</style>
