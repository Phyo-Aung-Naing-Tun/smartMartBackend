<template>
    <button @click="makeAction" v-bind="objectOfAttrs">
        <div v-if="!isLoading">
            <span v-if="text?.length">{{ text }}</span>
            <span>
                <slot> <!-- for icon --></slot>
            </span>
        </div>
        <div
            v-else
            class="w-5 h-5 rounded-full animate-spin absolute border-2 border-solid border-white border-t-transparent"
        ></div>
    </button>
</template>
<script setup lang="ts">
import { computed } from "vue";
import { router } from "../../router";

const props = defineProps({
    link: {
        type: String,
    },
    text: {
        type: String,
        defaulte: "",
    },
    icon: {
        type: String,
        default: "",
    },
    classes: {
        type: String,
    },
    isLoading: {
        type: Boolean,
        default: false,
    },
    isDisable: {
        type: Boolean,
        default: false,
    },
});
const emits = defineEmits(["action"]);

const objectOfAttrs: Object = computed(() => {
    return {
        class: `${props.classes} ${
            props.isDisable && "opacity-20"
        } rounded tracking-wide transition ease-linear  flex justify-center  items-center gap-3`,
        disabled: props.isDisable,
    };
});

function makeAction(): void {
    if (props.link?.length) {
        router.push(props.link);
    }
    emits("action", true);
}
</script>
