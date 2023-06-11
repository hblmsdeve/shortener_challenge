<template>
    <div class="justify-content-center">
        <Link />
    </div>
</template>
<script setup>
    import { provide, defineProps } from 'vue';
    import Link from './Liste.vue';

    const props = defineProps({
        user_id: {
            type: Number,
            required: true
        }
    });
    provide('user_id', props.user_id);

</script>