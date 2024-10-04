<template>
    <div>
        <nav>
            <MainNavBar/>
        </nav>
        <main class=" flex">
            <div class="w-[250px]">
                <SideBar/>
            </div>
            <div class="flex-grow min-h-screen pt-10">
                <RouterView/>
            </div>  
        </main>
    </div>
</template>
<script setup>
import MainNavBar from '../components/navs/MainNavBar.vue';
import SideBar from '../components/navs/SideBar.vue';
import { RouterView } from 'vue-router';
</script>