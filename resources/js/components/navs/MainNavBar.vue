<template>
    <div class=" flex justify-between primary_bg py-2 text-white px-10">
        <h1 class="text-xl font-bold tracking-wide">Smart Mart</h1>
        <ul class=" flex gap-5 items-center">
            <li class="text-lg font-bold"><FontAwesomeIcon class="text-white text-xl cursor-pointer" :icon="faBell" /></li>
            <li><FontAwesomeIcon class="text-white text-xl cursor-pointer" :icon="faCircleUser" /></li>
        </ul>
    </div>
</template>
<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faCircleUser } from '@fortawesome/free-solid-svg-icons';
import { faBell } from '@fortawesome/free-regular-svg-icons';
</script>