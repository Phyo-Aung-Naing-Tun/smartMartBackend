<template>
      <div>
        <div class="text-red-600">hello world</div>
        <Footable :json="json"/>
        <pre>{{ products }}</pre>
      </div>
</template>
<script setup>
import Footable from '../../core/Footable.vue';
import json from '../../../directives/user.json';
import apiClient from '../../../axios/axiosConfig';
import {ref , onMounted} from "vue";
let products = ref(null);

onMounted(getProducts);
function getProducts(){
  apiClient.get('/user').then(response => {
    products.value = response.data;
    console.log(response);
  }).catch(error=>{
    console.log(error);  
  }).finally(()=>{
    console.log('finally');
    
  })
}

</script>
