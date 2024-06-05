<template>
    <div v-if="globalState.isLoading" class="fixed inset-0 flex items-center justify-center bg-white z-50">
        <div class="shining-effect">
            <img src="/goebel.svg" alt="Loading" class="animated-loader"/>
        </div>
    </div>
</template>

<script>
import { inject } from 'vue';

export default {
    setup() {
        const globalState = inject('globalState');
        return { globalState };
    },
};
</script>

<style scoped>
.animated-loader {
    width: 100px;
    height: 100px;
    animation: scale 0.5s infinite ease-in-out;
}

.shining-effect {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 150px; /* Größe des äußeren Containers */
    height: 150px;
}

.shining-effect::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    border: 2px solid rgba(255, 255, 255, 0.5); /* Farbe und Transparenz des Shining-Effekts */
    border-radius: 50%;
    animation: rotate 2s linear infinite;
}

@keyframes scale {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
