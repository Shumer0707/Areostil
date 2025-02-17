<script setup>
import { usePage } from '@inertiajs/vue3';
</script>

<template>
    <div>
        <h1>Debug Ziggy</h1>
        <pre>{{ usePage().props }}</pre>
    </div>
</template>
