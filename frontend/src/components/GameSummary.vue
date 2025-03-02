
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

    <p>
        Check out
        <a href="https://vuejs.org/guide/quick-start.html#local" target="_blank"
        >create-vue</a
        >, the official Vue + Vite starter
    </p>
    <p>
        Learn more about IDE Support for Vue in the
        <a
            href="https://vuejs.org/guide/scaling-up/tooling.html#ide-support"
            target="_blank"
        >Vue Docs Scaling up Guide</a
        >.
    </p>
    <p class="read-the-docs">Click on the Vite and Vue logos to learn more</p>
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
