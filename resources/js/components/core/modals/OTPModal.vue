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
                            <div class="my-10 otp-modal flex justify-center">
                                <v-otp-input
                                    ref="otpInput"
                                    input-classes="otp"
                                    separator=":"
                                    inputType="letter-numeric"
                                    :num-inputs="6"
                                    :should-auto-focus="true"
                                    :should-focus-order="true"
                                    @on-complete="handleOnComplete"
                                />
                            </div>

                            <Button
                                text="Confirm"
                                classes="bg-blue-600 text-white w-full h-[40px]"
                            />
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup lang="ts">
import Button from "../Button.vue";
import { ref } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

const isOpen = ref(false);
const otp = ref(null);
const emits = defineEmits(["dismiss"]);
const props = defineProps({
    width: {
        type: String,
    },
    title: {
        type: String,
        default: null,
    },
});

function closeModal() {
    emits("dismiss", true);
}

const handleOnComplete = (value: string) => {
    console.log(value);

    otp.value = value;
};
</script>

<style>
.otp-modal .otp {
    width: 35px;
    height: 35px;
    padding: 5px;
    margin: 0 10px;
    font-size: 20px;
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.3);
    text-align: center;
}

/* Background colour of an input field with value */
.otp-modal .otp.is-complete {
    background-color: #e4e4e4;
}
.otp-modal .otp::-webkit-inner-spin-button,
.otp-modal .otp::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.otp-modal input::placeholder {
    font-size: 15px;
    text-align: center;
    font-weight: 600;
}
</style>
