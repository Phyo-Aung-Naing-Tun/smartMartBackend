<template>
    <div>
       <h1>table</h1>
       <div>
        <pre>{{ json }}</pre>
       </div>
    </div>
</template>
<script setup>
const props = defineProps({
    json:{
        requierd:true
    }
})
</script>