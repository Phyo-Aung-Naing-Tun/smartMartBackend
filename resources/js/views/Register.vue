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
                      <input type="confirm-password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " required v-model="form.confrim_password">
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
import { required,email, minLength, maxLength, sameAs } from '@vuelidate/validators';
import useVuelidate from '@vuelidate/core';
const form  = reactive({
    name : "",
    phone : "",
    email : "",
    password : "",
    confrim_password : "",
    is_accept: false,
});

const rules = {
  form: {
    name : {required},
    phone : {required, minLength : minLength(6) , maxLength: maxLength(12)},
    email : {required , email},
    password : {required,minLength : minLength(6)},
    confrim_password :  {sameAsPassword: sameAs(() => form.password)},
    is_accept: {required},
  }
};
const activeButton = computed(()=>{
    if(form.name && form.phone && form.email && form.password && form.confrim_password && form.is_accept){
        return true;
    }else{
        return false;
    }
});


function register(){
    $v.value.$touch()
    if ($v.value.$invalid) {
        
        console.log('Form is invalid',$v.value);
        return;
    }
    console.log('Form is valid:', form);
    
}
</script>
