<template>
    <div>
        <m-selector label="Select Roles" placeholder="Search Role" />
    </div>
</template>
<script setup>
import { computed } from 'vue';


const attributes = computed(()=>{
    return {
        label : "Select Roles",
        placeholder : "Search Role"
    }
});
</script>