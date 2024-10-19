import axios from "axios";
import { router } from "../router";

const apiClient = axios.create({
    baseURL : "http://127.0.0.1:8000/api",
    // baseURL: "https://fakestoreapi.com/",
     headers:{
        "Content-Type":"application/json",
        'Accept': 'application/json',
     },
     timeout: 10000
});

apiClient.interceptors.request.use(
config => {
    let token = JSON.parse(localStorage.getItem('token'));
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
      }
    return config;
}, 
error => {
    return Promise.reject(error);
}
);

apiClient.interceptors.response.use(
    response => {
    return response;
},
    error => {                
        if(error.response && error.response.status === 401 && window.location.pathname != "/auth/login" ){
            return router.push('/auth/login');
        }
        return Promise.reject(error);
}
);

export default apiClient;