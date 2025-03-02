
<template>
    <div class="card" v-if="gameRounds.length >= 1">
        <h2>Game Summary</h2>
        <table >
            <thead>
            <tr>
                <th>Round</th>
                <th>Player 1</th>
                <th>Player 2</th>
                <th>Player result</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(round, index) in gameRounds" :key="index">
                <td>
                    {{round.round}}
                </td>
                <td>
                    <img :src="getIcon(round.player_1)" alt="Player 1 Action" class="icon" />
                </td>
                <td>
                    <img :src="getIcon(round.player_2)" alt="Player 2 Action" class="icon" />
                </td>
                <td>
                    <span :class="round.result">{{ round.result }}</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="card">

    </div>
    <p>
        Check out
        <a href="https://github.com/krisan012/RockPaperScissor" target="_blank"
        >Rock Paper Scissors</a
        > Repository
    </p>

    <p class="read-the-docs">A Rock Paper Scissors mini game</p>
</template>

<script setup>
defineProps({
    gameRounds: {
        type: Array,
        required: true
    }
})

const images = import.meta.glob("/src/assets/*.png", { eager: true });

const getIcon = (move) => {
    return images[`/src/assets/${move}.png`]?.default || "";
};
</script>

<style scoped>
.read-the-docs {
    color: #888;
}

table{
    width: 100%;
    //border: 1px solid #3e3e3a;
}
table th{
    border-right: 1px solid #3e3e3a;
    border-bottom: 1px solid #3e3e3a;
    border-top: 1px solid #3e3e3a;
    border-left: 1px solid #3e3e3a;
}
table td{
    border-right: 1px solid #3e3e3a;
    border-bottom: 1px solid #3e3e3a;
    border-top: 1px solid #3e3e3a;
    border-left: 1px solid #3e3e3a;
}

table img {
    height: 30px;
    width: 30px;
}
.win {
    color: #42f36d;
}
.lose {
    color: #f34248;
}
.draw {
    color: #f3ea42;
}
</style>
