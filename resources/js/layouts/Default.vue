<template>
    <div>
        <nav>
            <MainNavBar/>
        </nav>
        <main>
            <div>
                <SideBar/>
            </div>
            <div>
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