<template>
    <h1 class="title">ROCK PAPER SCISSOR</h1>
    <h1>ROUND {{ round }}</h1>
    <HandSigns @hand-selected="roundPlayProcessed"/>
    <GameSummary :game-rounds="gameRounds"/>
</template>

<script setup>
import HandSigns from "./components/HandSigns.vue";
import GameSummary from "./components/GameSummary.vue";
import {ref} from "vue";

const round = ref(1)
const selectedHandSign = ref(null)
const gameRounds = ref([
]);

const roundPlayProcessed = (result) => {
    gameRounds.value.push({
        round: round.value,
        ...result
    })
    round.value++
    console.log(result)
}
</script>

<style scoped>
.title {
    font-size: 64px;
}
</style>