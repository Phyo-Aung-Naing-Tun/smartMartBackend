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
                <tr class=" hover:bg-gray-200" v-for="(body, bodyIndex) in json.body" :key="bodyIndex">
                    <td
                        class="border p-2"
                        v-for="(head, index) in json.head"
                        :key="index"
                    >   
                        <div  v-if="head === 'profile'">
                            <img class=" rounded-full shadow  mx-auto w-10 h-10 flex  border border-blue-800" v-if="body[head]" :src="body[head]" />
                            <div v-else class=" rounded-full shadow bg-white mx-auto w-10 h-10 flex justify-center items-center border border-blue-800">
                                <FontAwesomeIcon class=" text-xl primary_text" :icon="faUser"/>
                            </div>
                        </div>
                        <span class="text-sm" v-else-if="head === 'created at'">
                           {{ formatDate(body['created_at']) }}
                        </span>
                        <div v-else-if="head === 'actions'" >
                          <div v-if="body[head]?.length" class=" grid text-lg grid-cols-3 primary_text">
                            <div class=" hover:scale-[1.1] transition ease-linear" v-for="(action, index) in body[head]" :key="index">
                                <Button v-if="action?.name === 'details'" :link="`${action?.link}`">
                                    <FontAwesomeIcon :icon="faMagnifyingGlass" />
                                </Button>
                                    
                                <Button v-else-if="action?.name === 'edit'" :link="`${action?.link}`">
                                    <FontAwesomeIcon :icon="faEdit" />
                                </Button>
                                    
                                <Button @click="toggleModal" classes="text-red-600" v-else-if="action?.name === 'delete'" >
                                    <FontAwesomeIcon :icon="faTrash" />
                                </Button>
                            </div> 
                          </div>
                          <div v-else class="test-sm tracking-wide text-red-400">
                            Need Action data!
                          </div>
                        </div>
                        <div  v-else-if="head === 'no'" class="text-sm text-center">{{ generateNo(bodyIndex) }}</div>
                        <span v-else class="text-sm">{{ body[head] }}</span> 
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="json?.meta" class=" mt-3 flex justify-end" >
            <div class="border">
                <button @click="changePage(link?.url)" :class="link?.active ? 'primary_bg text-white' : 'hover:bg-gray-200'" class=" px-4 border-e last:border-none  py-2" v-for="(link, index) in json?.meta?.links.slice(1,json?.meta?.links.length-1)" :key="index" :v-html="link.label">
                
                {{ link?.label }}
            </button>
            </div>
        </div>
        <CustomModal image="/images/deleteConfrim.gif" title="Confirm Delete" text="Are you sure to delete?" width="500px" :show="openModal" @dismiss="toggleModal" type="confirm"/>
    </div>
</template>
<script setup lang="ts">
import { icon } from '@fortawesome/fontawesome-svg-core';
import { faEdit, faMagnifyingGlass, faTrash, faUser } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { onBeforeMount, onMounted, ref, watch } from 'vue';
import { formatDate, generateActions } from '../../utlis/helpers';
import apiClient from '../../axios/axiosConfig';
import CustomModal from './modals/CustomModal.vue';
import Button from './Button.vue';
const openModal:Boolean = ref(false);
const targetId = ref(null);
const props = defineProps({
    json: {
        requierd: true,
    },
    data: {
        required: true,
        type: Array,
    },
});

const emits = defineEmits(['paginateData'])

watch(
    ()=>props.data,
    ()=>{
    formatBody();
    }
)

onBeforeMount(()=>{
    formatBody();    
})

function formatBody(): void {
    let rawData: Array = [];
    props.data.forEach((data: any, index: Number) => {
        if(props.json?.actions){
            data["actions"] =  generateActions(props.json?.actions,data?.id);
        }
        rawData[index] = data;
    });
    props.json.body = rawData;    
}

 
function changePage(link:String):void{
    apiClient.get(link,{
        params: {
            per_page : props.json.meta.per_page
        }
    })
    .then(response => {
        emits("paginateData",response);        
    })
    .catch(error => {
        console.log(error);
        
    })
    
}

function toggleModal(value:number|boolean):void{
    targetId.value = value;
    openModal.value = !openModal.value; 
}

function generateNo(data:number):number{    
let perPage = props.json.meta.per_page;
 let currentPage = props.json.meta.current_page
 if(currentPage > 1){
 return (data + 1) + ((currentPage - 1) * perPage)
 }else{
    return data + 1;
 }
}
</script>
