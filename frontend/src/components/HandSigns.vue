<template>
    <div class="button-container">
        <button v-for="(hand, index) in hands" :key="index" :class="hand.class" @click="selectSign(hand.name)">
            <img :src="hand.image" :alt="hand.name" class="logo"  />
        </button>
    </div>
</template>

<script setup>
import {ref} from "vue";
import rockImg from "@/assets/rock.png";
import paperImg from "@/assets/paper.png";
import scissorImg from "@/assets/scissor.png";

const hands = ref([
    { name: "Rock", image: rockImg, class: "rock" },
    { name: "Paper", image: paperImg, class: "paper" },
    { name: "Scissor", image: scissorImg, class: "scissor" },
]);

const emit = defineEmits(["hand-selected"]);

const selectSign = (sign) => {
    emit("hand-selected", sign)
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
button.scissor:hover {
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

.scissor {
    background-color: #ede966;
}
</style>
