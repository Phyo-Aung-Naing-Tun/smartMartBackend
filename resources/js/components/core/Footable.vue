<template>
    <div >
        <table class="table-auto w-full">
            <thead>
                <th
                    class="capitalize  text-white border-white border p-2 primary_bg"
                    v-for="(data, index) in json.head"
                    :key="index"
                >
                 <td>
                    {{ data }}
                 </td>
                </th>
            </thead>
            <tbody v-if="json?.body.length">
                <tr class=" hover:bg-gray-200" v-for="(body, index) in json.body" :key="index">
                    <td
                        class="border p-2"
                        v-for="(head, index) in json.head"
                        :key="index"
                    >   
                        <div  v-if="head === 'profile'">
                            <img class=" rounded-full shadow  mx-auto w-10 h-10 flex  border border-blue-800" v-if="body[head]" :src="body[head]" />
                            <div class=" rounded-full shadow bg-white mx-auto w-10 h-10 flex justify-center items-center border border-blue-800">
                                <FontAwesomeIcon class=" text-xl primary_text" :icon="faUser"/>
                            </div>
                        </div>
                        <span class="text-sm" v-else-if="head === 'created at'">
                           {{ formatDate(body['created_at']) }}
                        </span>
                        <div v-else-if="head === 'actions'" class=" grid text-lg grid-cols-3 primary_text">
                            <div class=" hover:scale-[1.1] transition ease-linear" v-for="(action, index) in body[head]" :key="index">
                                <router-link v-if="action?.name === 'details'" to="/">
                                    <FontAwesomeIcon :icon="faMagnifyingGlass" />
                                </router-link>
                                <router-link v-else-if="action?.name === 'edit'" to="/">
                                    <FontAwesomeIcon :icon="faEdit" />
                                </router-link>
                                <router-link class="text-red-600" v-else-if="action?.name === 'delete'" to="/">
                                    <FontAwesomeIcon :icon="faTrash" />
                                </router-link>
                            </div> 
                        </div>
                        <span v-else class="text-sm">{{ body[head] }}</span> 
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="json?.meta" class=" mt-3 flex justify-end" >
            <div class="border">
                <button :class="link?.active ? 'primary_bg text-white' : 'hover:bg-gray-200'" class=" px-4 border-e last:border-none  py-2" v-for="(link, index) in json?.meta?.links.slice(1,json?.meta?.links.length-1)" :key="index" :v-html="link.label">
                
                {{ link?.label }}
            </button>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { icon } from '@fortawesome/fontawesome-svg-core';
import { faEdit, faMagnifyingGlass, faTrash, faUser } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { onBeforeMount, onMounted, ref } from 'vue';
import { formatDate } from '../../utlis/helpers';


const props = defineProps({
    json: {
        requierd: true,
    },
    data: {
        required: true,
        type: Array,
    },
});


onBeforeMount(()=>{
    formatBody();
    console.log(props.json.meta);
    
})

function formatBody(): void {
    let rawData: Array = [];
    props.data.forEach((data: any, index: Number) => {
        if(props.json?.actions){
            data["actions"] = props.json?.actions?.map((action:any) => action);
        }
        rawData[index] = data;
        
    });
    props.json.body = rawData;    
}
</script>
