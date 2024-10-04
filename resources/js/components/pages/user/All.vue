<template>
      <div>
        <div class="text-red-600">hello world</div>
        <Footable :json="json"/>
      </div>
</template>
<script setup>
import Footable from '../../core/Footable.vue';
import json from '../../../directives/user.json';
</script>
