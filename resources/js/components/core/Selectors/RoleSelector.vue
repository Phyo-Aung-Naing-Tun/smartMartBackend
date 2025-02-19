<template>
    <div>
        <m-selector label="Select Roles" placeholder="Search Role" @change="searchRole" />
    </div>
</template>
<script setup>
import { inject } from 'vue';


const useDebounce = inject("useDebounce");

function searchRole(value){
    useDebounce(()=>{
        console.log(value);
    },500)
}


</script>