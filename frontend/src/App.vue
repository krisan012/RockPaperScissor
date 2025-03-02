<template>
    <h1 class="title">ROCK PAPER SCISSOR</h1>
    <h1>ROUND {{ round }}</h1>
    <HandSigns @hand-selected="HandSignSelected"/>
    <GameSummary/>
</template>

<script setup>
import HandSigns from "./components/HandSigns.vue";
import GameSummary from "./components/GameSummary.vue";
import {ref} from "vue";

const round = ref(0)
const selectedHandSign = ref(null)

const HandSignSelected = (sign) => {
    round.value++
    selectedHandSign.value = sign.toLowerCase()
    console.log(sign.toLowerCase())
}
</script>

<style scoped>
.title {
    font-size: 64px;
}
</style>