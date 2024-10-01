<template>
    <div>
        <router-link to="/">Home</router-link>
        <router-link to="/about">About</router-link>
        <Header/>
        <main>
            <RouterView/>
        </main>
        <Footer/>
    </div>
</template>
<script setup>
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import { RouterView } from 'vue-router';
</script>