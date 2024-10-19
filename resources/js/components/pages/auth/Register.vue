<template>
    <div>
        <h1 class="text-xl font-bold leading-tight tracking-tight text-center mb-3 text-gray-900 md:text-2xl">
                  Create an account
              </h1>
              <form @submit.prevent="register" class="space-y-4 md:space-y-6" action="#">
                <div>
                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Your Name</label>
                      <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter your name" required v-model="form.name">
                  </div>
                <div>
                      <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Your Phone</label>
                      <input type="phone" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="09*********" required v-model="form.phone">
                      
                  </div>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required v-model="form.email" >
                      
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required v-model="form.password">
                     

                  </div>
                  <div>
                      <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm password</label>
                      <input type="confirm-password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " required v-model="form.password_confirmation">
                  </div>
                  <div class="flex items-start">
                      <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300" required v-model="form.is_accept">
                      </div>
                      <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 ">I accept the <a class="font-medium text-primary-600 hover:underline " href="#">Terms and Conditions</a></label>
                      </div>
                  </div>
                  <button :disabled="!activeButton" :class="!activeButton && 'opacity-50'" type="submit" class="w-full text-white bg-blue-900  focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Create an account</button>
                  <p class="text-sm font-light text-gray-500">
                      Already have an account? <RouterLink to="/auth/login" class="font-medium text-primary-600 hover:underline ">Login here</RouterLink>
                  </p>
              </form>
    </div>
</template>
<script setup lang="ts">
import { RouterLink } from 'vue-router';
import {reactive,ref,computed} from "vue";
import apiClient from '../../../axios/axiosConfig';
import { router } from '../../../router';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { logHello, notiError, notiSuccess } from '../../../helpers/utlis';
const form  = reactive({
    name : "",
    phone : "",
    email : "",
    password : "",
    password_confirmation : "",
    is_accept: false,
});

const loading = ref(true);



const activeButton = computed(()=>{
    if(form.name && form.phone && form.email && form.password && form.password_confirmation && form.is_accept){
        return true;
    }else{
        return false;
    }
});


function register(){
    loading.value = true;
    apiClient.post('/register',form)
    .then((response) => {
        notiSuccess('Registered Successful');
        localStorage.setItem('user',JSON.stringify(response.data.data.data));
        localStorage.setItem('token',JSON.stringify(response.data.data.token));
        return router.push('/');        
    })
    .catch((error)=>{
        notiError(error.response.data.message)
        console.log(error.response.data.message);
        
    })
    .finally(()=>{
    loading.value = false;

    })
    
}



</script>
