<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" class="relative z-10">
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
                                class="text-lg flex justify-between items-center font-medium leading-6 text-gray-900"
                            >
                                <span>{{ title }}</span>
                                <m-button
                                    @action="closeModal"
                                    classes="hover:scale-[1.1]"
                                >
                                    <FontAwesomeIcon
                                        class="text-red-600"
                                        :icon="faCircleXmark"
                                    />
                                </m-button>
                            </DialogTitle>

                            <div class="mt-10 otp-modal flex justify-center">
                                <v-otp-input
                                    ref="otpInput"
                                    input-classes="otp"
                                    separator=":"
                                    inputType="number"
                                    :num-inputs="6"
                                    :should-auto-focus="true"
                                    :should-focus-order="true"
                                    @on-change="handleOnChange"
                                    @on-complete="handleOnComplete"
                                />
                            </div>
                            <div class="my-6">
                                <Counter
                                    :seconds="secondsForTimmer"
                                    @timesup="timesup"
                                />
                            </div>

                            <m-button
                                v-if="!isTimesUp"
                                @action="submitOtp"
                                :isDisable="isDisableButton"
                                text="Confirm"
                                classes="bg-blue-600 hover:bg-blue-400 text-white w-full h-[40px]"
                            />
                            <m-button
                                v-else
                                @action="resendCode"
                                text="Resend Code"
                                classes="bg-blue-600 hover:bg-blue-400 text-white w-full h-[40px]"
                            />
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup lang="ts">
import { ref } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import Counter from "../Counter.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faCircleXmark } from "@fortawesome/free-solid-svg-icons";

let isOpen: Boolean = ref(false);
let isDisableButton: Boolean = ref(true);
let isTimesUp: Boolean = ref(false);
let otp = ref(null);
const emits = defineEmits(["dismiss", "submit", "rerequest"]);
const props = defineProps({
    width: {
        type: String,
    },
    title: {
        type: String,
        default: null,
    },
    secondsForTimmer: {
        type: Number,
        default: 0,
    },
});

function closeModal() {
    emits("dismiss", true);
}

function submitOtp() {
    emits("submit", otp.value);
}

function resendCode() {
    emits("rerequest", true);
}

function timesup(): void {
    isTimesUp.value = true;
}

const handleOnComplete = (value: string) => {
    isDisableButton.value = false;
    otp.value = value;
};

const handleOnChange = (value: string) => {
    if (value?.length === 6) {
        isDisableButton.value = false;
    } else {
        isDisableButton.value = true;
    }
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
