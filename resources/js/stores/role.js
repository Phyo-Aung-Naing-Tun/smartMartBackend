import { defineStore } from "pinia";
import {ref} from 'vue';
import apiClient from "@/axios/axiosConfig";

export const useRolesStore = defineStore("roles",()=>{

    const roles = ref([]);
    const cacheRoles = ref([]);
    const key = ref("");
    
    function pullRoles(param){
        let cacheRole = cacheRoles.value.find(role => role?.key == param);

        if(cacheRole){            
            roles.value = cacheRole?.roles;
        }else{
            apiClient.get('/roles')
            .then(response => {
                console.log(response.data.data);
            })
            .catch(error => {
                console.log(error)
            })
        }
        return param;
    }

    return {roles,key,pullRoles};

});