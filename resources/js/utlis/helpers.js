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

//to easily show image
export function getDomain() {
    return import.meta.env.VITE_IMAGE_BASE_URL;
}

export function transformDropDownData(key, value, active) {
    return {
        key,
        value,
        active,
    };
}

//action generator for footable
export function generateActions(actions, targetId) {
    let result = [];
    if (actions?.length) {
        actions.forEach((action, i) => {
            result.push({
                id: i,
                name: action?.name,
                link: action.link + targetId,
            });
        });
    }
    return result;
}

export default {
    notiSuccess,
    notiError,
    formatDate,
    transformDropDownData,
    generateActions,
};
