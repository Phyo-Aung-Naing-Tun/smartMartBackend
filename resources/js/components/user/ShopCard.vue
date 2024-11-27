<template>
    <div>
        <h1 class="text-gray-800 mb-4 text-lg tracking-wide font-bold">
            Seller's Shop
        </h1>
        <div class="rounded shadow p-3 bg-white tracking-wide text-gray-800">
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
                    <h1 class="primary_text font-bold text-lg">
                        {{ shop?.name }}
                    </h1>
                    <p class="text-sm">{{ shop?.email }}</p>
                    <p class="text-sm">{{ shop?.phone }}</p>
                    <div class="badge-green">{{ shop?.status }}</div>
                    <div class="badge-yellow">{{ shop?.status }}</div>
                    <div class="badge-red">{{ shop?.status }}</div>
                    <div class="badge-blue">{{ shop?.status }}</div>
                </div>
            </div>
        </div>
        <pre>{{ shop }}</pre>
    </div>
</template>
<script setup>
import { faStore } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

const { shop } = defineProps({
    shop: {
        type: Object,
        required: true,
    },
});
</script>
