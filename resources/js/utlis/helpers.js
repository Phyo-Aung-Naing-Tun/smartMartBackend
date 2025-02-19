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

export function generateBadgeClass(status) {
    let classes = {
        active: "badge-green",
        suspend: "badge-red",
        pending: "badge-yellow",
    };
    return classes[status];
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

export function generaCustomId(){
    let words = [
        "1",
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8",
        "9",
        "0",
        "A",
        "b",
        "C",
        "d",
        "E",
        "f",
    ];
    let id = [];
    for (let i = 0; i < 6; i++) {
        let index = parseInt(Math.random() * words.length);
        id.push(words[index]);
    }
    return id.join("");
}

export default {
    notiSuccess,
    notiError,
    formatDate,
    transformDropDownData,
    generateActions,
    generateBadgeClass,
    generaCustomId,
};
