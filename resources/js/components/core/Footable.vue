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
                <tr v-for="(body, index) in json.body" :key="index">
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
                        <span v-else-if="head === 'created at'">
                           {{ formatDate(body['created_at']) }}
                        </span>
                        <div v-else-if="head === 'actions'">
                            <FontAwesomeIcon :icon="faEdit" />
                            <FontAwesomeIcon :icon="faTrash" />
                            <FontAwesomeIcon :icon="faMagnifyingGlass" />
                        </div>
                        <span v-else>{{ body[head] }}</span> 
                    </td>
                </tr>
            </tbody>
        </table>
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
const actions = ref([

])

onBeforeMount(()=>{
    getBody();
    
})

function getBody(): void {
    let rawData: Array = [];
    props.data.forEach((data: any, index: Number) => {
        rawData[index] = data;
    });
    props.json.body = rawData;
}




// function transform(data) {
//     let raw = [];
//     data.data.forEach(
//         (data, index) =>
//             (raw[index] = {
//                 id: data.id,
//                 profile: data.profile,
//                 name: data.name,
//                 email: data.email,
//                 phone: data.phone,
//             })
//     );
//     json.body = raw;
//     json.meta = data.meta;
// }
// transform(products.value);
</script>
