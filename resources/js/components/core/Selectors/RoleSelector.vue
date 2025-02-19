<template>
    <div>
        <m-selector label="Select Roles" placeholder="Search Role" @change="searchRole" />
    </div>
</template>
<script setup>
import { inject } from 'vue';
import { RolePuller } from '@/composables/RolePuller';


const useDebounce = inject("useDebounce");

function searchRole(value){
    useDebounce(()=>{
     let result =  RolePuller(value);
     console.log(result);
    },500)
}

</script>