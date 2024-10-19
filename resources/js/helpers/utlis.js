import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export function notiSuccess(message){
    toast(message, {
        autoClose: 1000,
        type: 'success'
      });
}
export function notiError(message){
    toast(message, {
        autoClose: 1000,
        type: 'error'
      });
}

export default {
    notiSuccess,
    notiError
}