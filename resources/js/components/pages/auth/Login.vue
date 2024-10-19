<template>
    <div>
        <h1 class="text-xl font-bold leading-tight tracking-tight text-center mb-3 text-gray-900 md:text-2xl">
                  Login 
              </h1>
              <form @submit.prevent="login" class="space-y-4 md:space-y-6" action="#">              
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                      <input v-model="form.email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required>
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                      <input v-model="form.password" type="password" name="password" id="password" required placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                  </div>                 
                  <button type="submit" class="w-full text-white bg-blue-900  focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Sign In</button>
                  <p class="text-sm font-light text-gray-500">
                      Don't have an account? <RouterLink to="/auth/register" class="font-medium text-primary-600 hover:underline ">Register here</RouterLink>
                  </p>
              </form>
    </div>
</template>
<script setup>
import { reactive } from 'vue';
import { RouterLink } from 'vue-router';
import apiClient from '../../../axios/axiosConfig';
import { notiError } from '../../../helpers/utlis';
const form = reactive({
    email : null,
    password :null,
})

function login() {
    apiClient.post('/login',form)
    .then((response)=>{
        if(response.data.data.success){
            console.log('success');
            
        };
        
    })
    .catch((error)=>{
        notiError(error.response.data.message)
        console.log(error.response.data.message);
        
    })
    
}


</script>