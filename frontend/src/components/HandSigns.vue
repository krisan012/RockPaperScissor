<template>
    <div class="button-container">
        <button v-for="(hand, index) in hands" :key="index" class="game-button" :class="hand.class" @click="selectSign(hand.name)" :disabled="isLoading">
            <span v-if="isLoading" class="loader"></span>
            <img :src="hand.image" :alt="hand.name" class="logo" />
        </button>
    </div>
</template>

<script setup>
import {ref} from "vue";
import rockImg from "@/assets/rock.png";
import paperImg from "@/assets/paper.png";
import scissorImg from "@/assets/scissors.png";
import api from "../config/axios.js";

const hands = ref([
    { name: "Rock", image: rockImg, class: "rock" },
    { name: "Paper", image: paperImg, class: "paper" },
    { name: "Scissors", image: scissorImg, class: "scissors" },
]);
const isLoading = ref(false)

const emit = defineEmits(["hand-selected"]);

const selectSign = async (sign) => {
    if (isLoading.value) return

    isLoading.value = true;

    try {
        const result = await sendSelection(sign.toLowerCase());
        emit("hand-selected", result);
    } finally {
        isLoading.value = false; // Reset loading state after response
    }

}

const sendSelection = async (signSelected) => {
    try {
        const response = await api.post("/play-round", { handSign: signSelected });
        return response.data;
    } catch (error) {
        console.error("Error Sending Data", error);
        return null;
    }
}
</script>

<style scoped>
.button-container {
    display: flex;
    gap: 50px; /* Add space between buttons */
    justify-content: center; /* Center align */
    margin: 100px 0;
}

button {
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
.rock {
    background-color: #d55555;
}

.paper {
    background-color: #30a4f1;
}

.scissors {
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
