<template>
    <h1 class="title">ROCK PAPER SCISSOR</h1>
    <h1 v-if="currentRound <= 10">ROUND {{ currentRound }}</h1>
    <HandSigns @hand-selected="roundPlayProcessed" :round="currentRound" @game-summary="summaryDetailsFn" @reset-game="resetGame"/>
    <TotalGameSummary :game-rounds="gameRounds" @reset-game="resetGame" :summary="summary"/>
    <GameSummary :game-rounds="gameRounds"/>
</template>

<script setup>
import HandSigns from "./components/HandSigns.vue";
import GameSummary from "./components/GameSummary.vue";
import {ref} from "vue";
import TotalGameSummary from "./components/TotalGameSummary.vue";
import api from "./config/axios.js";

const currentRound = ref(1)
const gameRounds = ref([]);
const summary = ref({})
const sessionId = ref(localStorage.getItem("session_id"))

const roundPlayProcessed = (result) => {
    gameRounds.value.push({
        round: currentRound.value,
        ...result
    })
    currentRound.value++
}

const resetGame = () => {
    gameRounds.value = []; // Clear rounds
    currentRound.value = 1;

    sendRequestResetGame()
};

const sendRequestResetGame = async () => {
    try {
        const response = await api.post("/reset", { session_id: sessionId.value });
    } catch (error) {
        console.error("Error Sending Data", error);
        return null;
    }
}

const summaryDetailsFn = (data) => {
    summary.value = data
}
</script>

<style scoped>
.title {
    font-size: 64px;
}
</style>