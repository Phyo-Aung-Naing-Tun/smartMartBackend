<template>
    <div class="text-center text-red-600">
        <span v-if="duration">{{ duration }}</span>
        <span v-else>Time's up</span>
    </div>
</template>
<script setup lang="ts">
import { ref, onMounted } from "vue";

const props = defineProps({
    seconds: {
        type: Number,
        default: 0,
    },
});
const emits = defineEmits(["timesup"]);

const duration: Number = ref(props.seconds);

onMounted(() => {
    let timer = setInterval(() => {
        if (duration.value == 0) {
            emits("timesup", true);
            clearInterval(timer);
        } else {
            duration.value--;
        }
    }, 1000);
});
</script>
