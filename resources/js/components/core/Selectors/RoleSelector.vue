<template>
    <div>
        <m-selector label="Select Roles" placeholder="Search Role" @change="searchRole" />
    </div>
</template>
<script setup>
import { inject } from 'vue';
import { useRolesStore } from '@/stores/role';


const useDebounce = inject("useDebounce");
const rolesStore = useRolesStore();

function searchRole(value){
    useDebounce(()=>{
        let key =  value.replace(/\s+/g, '_')        
        rolesStore.pullRoles(key);
        
    },500)
}

</script>