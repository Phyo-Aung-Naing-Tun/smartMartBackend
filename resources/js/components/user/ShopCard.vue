<template>
    <div>
        <h1 class="text-gray-800 mb-4 text-lg tracking-wide font-bold">
            Seller's Shop
        </h1>
        <div
            class="rounded shadow px-3 py-4 flex justify-between items-start space-y-2 bg-white tracking-wide text-gray-800"
        >
            <div class="flex items-start gap-7">
                <div class="mb-3">
                    <img
                        class="rounded-full shadow mx-auto w-[100px] h-[100px] flex border border-blue-800"
                        v-if="shop?.profile"
                        :src="shop?.profile"
                    />
                    <div
                        v-else
                        class="rounded-full shadow bg-white mx-auto w-[100px] h-[100px] flex justify-center items-center border border-blue-800"
                    >
                        <FontAwesomeIcon
                            class="text-[50px] primary_text"
                            :icon="faStore"
                        />
                    </div>
                </div>
                <div class="space-y-1">
                    <h1 class="flex items-center gap-3">
                        <span class="primary_text font-bold text-lg"
                            >{{ shop?.name }}
                        </span>
                        <span :class="generateBadgeClass(shop?.status)">
                            {{ shop?.status }}
                        </span>
                    </h1>
                    <p class="text-sm">{{ shop?.email }}</p>
                    <p class="text-sm">{{ shop?.phone }}</p>
                </div>
            </div>
            <div class="me-2">
                <m-button
                    classes=" border w-[30px] h-[30px] rounded-full border-blue-700 shadow-md hover:scale-[1.1]"
                >
                    <FontAwesomeIcon
                        :icon="faAngleRight"
                        class="primary_text"
                    />
                </m-button>
            </div>
        </div>
    </div>
</template>
<script setup>
import { faAngleRight, faStore } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { generateBadgeClass } from "../../utlis/helpers";

const { shop } = defineProps({
    shop: {
        type: Object,
        required: true,
    },
});
</script>
