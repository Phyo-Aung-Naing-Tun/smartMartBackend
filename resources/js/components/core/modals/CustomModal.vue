<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/50" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            :style="`width:${width}`"
                            :class="` transform overflow-hidden rounded bg-white p-6 text-left align-middle shadow-xl transition-all`"
                        >
                            <DialogTitle
                                v-if="title"
                                as="h3"
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                {{ title }}
                            </DialogTitle>
                            <div class="mt-2">
                                <img
                                    class="w-[230px] my-3 mx-auto"
                                    v-if="image"
                                    :src="`${getDomain()}/storage${image}`"
                                    alt="image"
                                />
                                <p
                                    v-if="text"
                                    class="my-3 text-lg text-center text-gray-600"
                                >
                                    {{ text }}
                                </p>
                            </div>

                            <div
                                class="mt-5 flex justify-end gap-2"
                                v-if="type === 'confirm'"
                            >
                                <button
                                    type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-red-200 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-500 focus:outline-none hover:text-white focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2"
                                    @click="closeModal"
                                >
                                    Cancle
                                </button>
                                <button
                                    type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="closeModal"
                                >
                                    Confirm
                                </button>
                            </div>
                            <div
                                class="mt-5 flex justify-center"
                                v-if="type === 'alert'"
                            >
                                <button
                                    type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="closeModal"
                                >
                                    OK
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { onMounted, ref } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import { faL } from "@fortawesome/free-solid-svg-icons";
import { getDomain } from "../../../utlis/helpers";

const isOpen = ref(false);
// const width = ref("500px");
const emits = defineEmits(["dismiss"]);
const props = defineProps({
    width: {
        type: String,
    },
    title: {
        type: String,
        default: null,
    },
    type: {
        type: String,
        default: "confirm",
    },
    image: {
        type: String,
    },
    text: {
        type: String,
    },
});

function closeModal() {
    emits("dismiss", true);
}
</script>
