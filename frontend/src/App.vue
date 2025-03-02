<template>
    <h1 class="title">ROCK PAPER SCISSOR</h1>
    <h1 v-if="currentRound <= 10">ROUND {{ currentRound }}</h1>
    <HandSigns @hand-selected="roundPlayProcessed" :round="currentRound"/>
    <TotalGameSummary :game-rounds="gameRounds" @reset-game="resetGame"/>
    <GameSummary :game-rounds="gameRounds"/>
</template>

<script setup>
import HandSigns from "./components/HandSigns.vue";
import GameSummary from "./components/GameSummary.vue";
import {ref} from "vue";
import TotalGameSummary from "./components/TotalGameSummary.vue";

const currentRound = ref(1)
const gameRounds = ref([]);

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
};
</script>

<style scoped>
.title {
    font-size: 64px;
}
</style>