<template>
    <div class=" w-full h-screen bg-blue-500">
        <div>auth</div>
        <div>
            <RouterView/>
        </div>
    </div>
</template>
<script setup >
import { RouterView } from 'vue-router';
</script>