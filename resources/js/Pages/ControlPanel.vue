<script setup lang="ts">
import { ChevronRightIcon } from '@heroicons/vue/20/solid';
import { Head } from '@inertiajs/vue3';

// Define props and their types
interface User {
    id: number;
    name: string;
    email: string;
    // Add other user fields as needed
}

defineProps<{ user: User }>();

// Optional: Uncomment to log the user prop for debugging
// console.log('user', user);
</script>

<template>
    <Head title="Control Panel" />
    <div class="relative isolate overflow-hidden bg-gray-900 text-white">
        <div class="p-6">
            <p class="mb-2">Email: {{ user.email }}</p>
            <p>User ID: {{ user.id }}</p>
            <!-- Add more user details as needed -->
        </div>
    </div>
</template>

<style scoped>
/* Add any component-specific styles here */
</style>
