<template>
    <div>
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
            <tbody>
                <tr v-for="(body, index) in json.body" :key="index">
                    <td
                        class="border p-2"
                        v-for="(head, index) in json.head"
                        :key="index"
                    >
                        {{ body[head] }}
                    </td>
                
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script setup lang="ts">
import { required } from "@vuelidate/validators";

const props = defineProps({
    json: {
        requierd: true,
    },
    data: {
        required: true,
        type: Array,
    },
});

function getBody(): void {
    let rawData: Array = [];
    props.data.forEach((data: any, index: Number) => {
        rawData[index] = data;
    });
    props.json.body = rawData;
}
getBody();

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
