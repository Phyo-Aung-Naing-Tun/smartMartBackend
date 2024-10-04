import axios from "axios";
import { router } from "../router";

const apiClient = axios.create({
    //  baseUrl : "http://127.0.0.1:8000/api",
    baseURL: "https://fakestoreapi.com/",
     headers:{
        "Content-Type":"application/json"
     },
     timeout: 10000
});

apiClient.interceptors.request.use(
config => {
    let token = localStorage.getItem('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
      }
    return config
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
        if(error.response && error.response.status === 401){
            return router.go('/home');
        }
        return Promise.reject(error);
}
);

export default apiClient;