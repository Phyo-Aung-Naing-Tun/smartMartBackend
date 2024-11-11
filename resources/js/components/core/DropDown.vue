<template>
    <div class="relative">
        <div @click="toggle">
            <div v-bind="attributes" class="select-none capitalize">
                {{ active?.value }}
            </div>
        </div>
        <ul
            :class="show ? 'absolute' : 'hidden'"
            class="shadow left-0 transition-[1s] ease-linear right-0 bg-white"
        >
            <li
                @click="select(value.key)"
                v-for="value in loopData"
                :key="value.key"
                class="px-3 select-none border-b last:border-none py-2 cursor-pointer hover:bg-gray-50 capitalize"
            >
                {{ value.value }}
            </li>
        </ul>
    </div>
</template>
<script setup lang="ts">
import { computed, ref } from "vue";
const show = ref(false);
const props = defineProps({
    data: {
        type: Array,
        required: true,
    },

    classes: {
        type: String,
    },
});
const emits = defineEmits(["selectValue"]);
const active = computed(() => {
    return props.data.find((data) => data.active);
});
const loopData = computed(() => {
    return props.data.filter((data) => !data.active);
});
const attributes: object = computed(() => {
    return {
        class: `${props.classes} border border-gray-700 px-4 py-2 cursor-pointer block w-full`,
        disabled: true,
    };
});
function toggle() {
    show.value = !show.value;
}
function select(key: string) {
    props.data.map((data) => {
        if (data?.key == key) {
            data.active = true;
        } else {
            data.active = false;
        }
        return data;
    });
    emits("selectValue", key);
    toggle();
}
</script>
