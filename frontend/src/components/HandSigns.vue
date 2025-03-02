<template>
    <transition name="fade-scale">
        <div class="button-container" v-if="round <= 10">
            <button v-for="(hand, index) in hands" :key="index" class="game-button" :class="hand.class" @click="selectSign(hand.name)" :disabled="isLoading">
                <span v-if="isLoading" class="loader"></span>
                <img :src="hand.image" :alt="hand.name" class="logo" />
            </button>
        </div>
    </transition>

    <button class="button" v-if="round > 1 && round < 10" @click="resetGame">Reset Game</button>
</template>

<script setup>
import {ref, defineProps, onMounted} from "vue";
import rockImg from "@/assets/rock.png";
import paperImg from "@/assets/paper.png";
import scissorImg from "@/assets/scissors.png";
import api from "../config/axios.js";

const props = defineProps({
    round: {
        required: true
    }
})

const hands = ref([
    { name: "Rock", image: rockImg, class: "rock" },
    { name: "Paper", image: paperImg, class: "paper" },
    { name: "Scissors", image: scissorImg, class: "scissors" },
]);
const isLoading = ref(false)
const sessionId = ref(localStorage.getItem("session_id"))

const emit = defineEmits(["hand-selected", "game-summary", "reset-game"]);

const selectSign = async (sign) => {
    if (isLoading.value) return
    if (props.round > 10) return
    if (!sessionId.value) return;

    isLoading.value = true;

    try {
        const result = await sendSelection(sign.toLowerCase());
        emit("hand-selected", result);
    } finally {
        isLoading.value = false; // Reset loading state after response
    }

    if(props.round === 10)
    {
        const result = await getGameSummary();
        emit("game-summary", result);
    }
}

const sendSelection = async (signSelected) => {
    try {
        const response = await api.post("/play-round", { handSign: signSelected, session_id: sessionId.value });
        return response.data;
    } catch (error) {
        console.error("Error Sending Data", error);
        return null;
    }
}

const getGameSummary = async () => {
    try {
        const response = await api.get(`/summary?session_id=${sessionId.value}`);
        return response.data;
    } catch (error) {
        console.error("Error Getting Data", error);
        return null;
    }
}

const startGame = async () => {
    if (!sessionId.value) {
        isLoading.value = true
        const response = await api.post("/start");
        const data = await response.data;
        sessionId.value = data.session_id;
        localStorage.setItem("session_id", sessionId.value);
        isLoading.value = false
    }
}

const resetGame = () => {
    emit("reset-game", []);
}

onMounted(startGame)
</script>

<style scoped>
.button-container {
    display: flex;
    gap: 50px; /* Add space between buttons */
    justify-content: center; /* Center align */
    margin: 100px 0 50px 0;
}

button.game-button {
    width: 150px;
    height: 150px;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background-color: transparent;
    cursor: pointer;
    transition: transform 0.2s ease-in-out;
}

button.rock:hover {
    transform: scale(1.1); /* Add hover effect */
    box-shadow: 0 0 10px 3px #f41042; /* White glowing effect */
}
button.paper:hover {
    transform: scale(1.1); /* Add hover effect */
    box-shadow: 0 0 10px 3px #1058f4; /* White glowing effect */
}
button.scissors:hover {
    transform: scale(1.1); /* Add hover effect */
    box-shadow: 0 0 10px 3px #f4e110; /* White glowing effect */
}
button:hover {
    transform: scale(1.1); /* Add hover effect */
    box-shadow: 0 0 10px 3px white; /* White glowing effect */
}

.logo {
    width: 90%;
    height: 90%;
    object-fit: contain;
}

/* Background colors for buttons */
.game-button.rock {
    background-color: #d55555;
}

.game-button.paper {
    background-color: #30a4f1;
}

.game-button.scissors {
    background-color: #ede966;
}

.game-button:disabled {
    cursor: not-allowed;
    opacity: 0.6;
}

.loader {
    position: absolute;
    width: 30px;
    height: 30px;
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
