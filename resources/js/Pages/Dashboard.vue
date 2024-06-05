<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const counter = ref(50000000); // Beispiel-Zählerwert, ersetze ihn durch deine tatsächlichen Daten
const bounceCount = ref(0);
const upgrades = ref(5); // Anzahl der Upgrades, initialer Wert

const units = [
    '', 'thousand', 'million', 'billion', 'trillion', 'quadrillion',
    'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion',
    'decillion', 'undecillion', 'duodecillion', 'tredecillion',
    'quattuordecillion', 'quindecillion', 'sexdecillion', 'septendecillion',
    'octodecillion', 'novemdecillion', 'vigintillion',
    'unvigintillion', 'duovigintillion', 'tresvigintillion',
    'quattuorvigintillion', 'quinvigintillion', 'sesvigintillion',
    'septemvigintillion', 'octovigintillion', 'novemvigintillion',
    'trigintillion', 'untrigintillion', 'duotrigintillion',
    'trestrigintillion', 'quattuortrigintillion', 'quintrigintillion',
    'sestrigintillion', 'septentrigintillion', 'octotrigintillion',
    'noventrigintillion', 'quadragintillion', 'quinquadragintillion',
    'sexquadragintillion', 'septenquadragintillion', 'octoquadragintillion',
    'novenquadragintillion', 'quinquagintillion', 'unquinquagintillion',
    'duoquinquagintillion', 'trequinquagintillion', 'quattuorquinquagintillion',
    'quinquinquagintillion', 'sesquinquagintillion', 'septenquinquagintillion',
    'octoquinquagintillion', 'novenquinquagintillion', 'sexagintillion',
    'unsexagintillion', 'duosexagintillion', 'tresexagintillion',
    'quattuorsexagintillion', 'quinsexagintillion', 'sessexagintillion',
    'septensexagintillion', 'octosexagintillion', 'novensexagintillion',
    'septuagintillion', 'unseptuagintillion', 'duoseptuagintillion',
    'treseptuagintillion', 'quattuorseptuagintillion', 'quinseptuagintillion',
    'sesseptuagintillion', 'septenseptuagintillion', 'octoseptuagintillion',
    'novenseptuagintillion', 'octogintillion', 'unoctogintillion',
    'duooctogintillion', 'tresoctogintillion', 'quattuoroctogintillion',
    'quinoctogintillion', 'sesoctogintillion', 'septoctogintillion',
    'octooctogintillion', 'novemoctogintillion', 'nonagintillion',
    'unnonagintillion', 'duononagintillion', 'trenonagintillion',
    'quattuornonagintillion', 'quinnonagintillion', 'sesnonagintillion',
    'septnonagintillion', 'octononagintillion', 'novenonagintillion',
    'centillion', 'uncentillion', 'duocentillion', 'trescentillion',
    'quattuorcentillion', 'quincentillion', 'sescentillion',
    'septencentillion', 'octocentillion', 'novencentillion', 'nongenti'
];

const formatCounter = (count) => {
    if (count === 0) return { value: 0, unit: units[0] };

    const i = Math.floor(Math.log10(count) / 3);
    const value = (count / Math.pow(10, i * 3)).toFixed(3);

    return { value, unit: units[i] };
};

const formattedCounter = computed(() => formatCounter(counter.value));
const clicks = ref([]);

const fetchCounter = async () => {
    //const response = 0;
    //counter.value = response;
};

const incrementCounter = async (event) => {
    counter.value++;
    addClick(event);

    const imgElement = event.target;
    const bounceClass = `bounce${(bounceCount.value % 2) + 1}`;
    bounceCount.value++;

    imgElement.classList.add(bounceClass);
    setTimeout(() => {
        imgElement.classList.remove(bounceClass);
    }, 300); // Dauer der Bounce-Animation
};

const addClick = (event) => {
    const randomRotation = (Math.random() - 0.5) * 60; // Zufällige Rotation zwischen -30 und 30 Grad
    const clickStyle = {
        left: `${event.clientX}px`,
        top: `${event.clientY}px`,
        transform: `rotate(${randomRotation}deg)`,
        animation: 'fall 1s forwards'
    };

    clicks.value.push({ style: clickStyle });

    setTimeout(() => {
        clicks.value.shift();
    }, 1000);
};

const incrementPerSecond = computed(() => {
    return upgrades.value * 10000000; // Beispiel: Jede Upgrade erhöht den Zähler um 10 pro Sekunde
});

const startCounterIncrement = () => {
    setInterval(() => {
        counter.value += incrementPerSecond.value;
    }, 1000);
};

onMounted(() => {
    fetchCounter();
    startCounterIncrement();
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="grid grid-cols-12 w-full" style="height: calc(100vh - 65px);">
            <div class="col-span-3 w-full h-full border-y-green-950">
                <div class="h-full flex flex-col items-center justify-center">
                    <div class="relative w-full h-72">
                        <div class="counter text-center absolute left-1/2 bg-gray-950/40 w-full text-white -translate-y-32">
                            <div class="cookie-clicker-container">
                                <div class="cookie-count">{{ formattedCounter.value }} </div>
                                <div class="cookie-count -translate-y-2">{{formattedCounter.unit}}</div>
                            </div>
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-72 h-72 bg-yellow-500 rounded-full animate-pulse"></div>
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="/goebel.svg" alt="cookie" class="w-48 cursor-pointer" @click="incrementCounter"/>
                        </div>
                    </div>
                    <div v-for="(click, index) in clicks" :key="index" :style="click.style" class="absolute">
                        <img src="/goebel.svg" alt="cookie" class="w-12" />
                    </div>
                </div>
            </div>
            <div class="col-span-7 w-full h-full bg-red-700">Test</div>
            <div class="col-span-2 w-full h-full bg-yellow-500">Test</div>
        </div>
        <!--div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div class="relative w-72 h-72">
                <span class="counter text-center">{{ counter }}</span>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-72 h-72 bg-yellow-500 rounded-full animate-pulse"></div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <img src="/goebel.svg" alt="cookie" class="w-48 cursor-pointer" @click="incrementCounter"/>
                </div>
            </div>
            <div v-for="(click, index) in clicks" :key="index" :style="click.style" class="absolute">
                <img src="/goebel.svg" alt="cookie" class="w-12" />
            </div>
        </div-->
    </AuthenticatedLayout>
</template>

<style>
body {
    font-family: 'Georgia', serif;
}

.counter {
    font-family: 'Georgia', serif;
    font-size: 24px; /* Passe die Größe nach Bedarf an */
    color: #fff; /* Passe die Farbe nach Bedarf an */
    text-align: center;
}

.cookie-clicker-title {
    font-family: 'Georgia', serif;
    font-size: 48px; /* Passe die Größe nach Bedarf an */
    color: #fff; /* Passe die Farbe nach Bedarf an */
    text-align: center;
}

.cookie-clicker-container {
    text-align: center;
    font-family: 'Georgia', serif;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.cookie-per-second {
    font-size: 1rem;
}

@keyframes fall {
    to {
        transform: translateY(100px);
        opacity: 0;
    }
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

.bounce {
    animation: bounce 0.3s;
}

.relative {
    position: relative;
    display: inline-block;
}

.absolute {
    position: absolute;
    top: 0;
    left: 0;
}

.bg-yellow-500 {
    background-color: #f59e0b; /* Scheinwerferfarbe */
}

.rounded-full {
    border-radius: 50%;
}

.animate-pulse {
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.5;
    }
}

@keyframes bounce1 {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-30px);
    }
    60% {
        transform: translateY(-15px);
    }
}

@keyframes bounce2 {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-30px);
    }
    60% {
        transform: translateY(-15px);
    }
}

.bounce1 {
    animation: bounce1 0.3s;
}

.bounce2 {
    animation: bounce2 0.3s;
}

</style>
