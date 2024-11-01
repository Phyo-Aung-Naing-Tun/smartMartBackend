import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export function notiSuccess(message) {
    toast(message, {
        autoClose: 1000,
        type: "success",
    });
}
export function notiError(message) {
    toast(message, {
        autoClose: 1000,
        type: "error",
    });
}

export function formatDate(time) {
    let months = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "July",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ];
    let date = new Date(time);

    return `${date.getDate()} ${
        months[date.getMonth() - 1]
    } , ${date.getFullYear()}`;
}

export default {
    notiSuccess,
    notiError,
    formatDate,
};
