<template>
    <section class="bg-blue-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 ">
          <img class="w-20 h-20 mr-2 rounded-full" src="../assets/public/images/png/smartmartlogo.png" alt="logo">
      </a>
      <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0 ">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <RouterView/>
          </div>
      </div>
  </div>
</section>
</template>
<script setup >
import { RouterView } from 'vue-router';
</script>