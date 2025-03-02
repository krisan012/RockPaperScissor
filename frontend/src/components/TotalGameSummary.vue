<template>
    <transition name="fade-scale">
        <div class="summary-card" v-if="gameRounds.length >= 10">
            <h2 style="color: #3e3e3a">Game Summary</h2>
            <div  class="stats">
                <div class="stat">
                    <span class="label">Total Rounds:</span>
                    <span class="value">{{ summary.total_rounds }}</span>
                </div>
                <div class="stat">
                    <span class="label">Player 1 Wins:</span>
                    <span class="value">{{ summary.player_1_wins }}</span>
                </div>
                <div class="stat">
                    <span class="label">Player 2 Wins (You):</span>
                    <span class="value">{{ summary.player_2_wins }}</span>
                </div>
                <div class="stat">
                    <span class="label">Ties:</span>
                    <span class="value">{{ summary.ties }}</span>
                </div>
                <div class="stat">
                    <span class="label">Player 1 Win %:</span>
                    <span class="value">{{ summary.player_1_win_percentage ?? 0 }}%</span>
                </div>
                <div class="stat">
                    <span class="label">Player 2 Win %:</span>
                    <span class="value">{{ summary.player_2_win_percentage ?? 0 }}%</span>
                </div>
            </div>

            <div>
                <button class="play-again-btn" @click="resetGame">Play Again</button>
            </div>

        </div>
    </transition>
</template>

<script setup>

const props = defineProps({
    gameRounds: Array,
    summary: Object
});

const emit = defineEmits(["reset-game"]);

const resetGame = () => {
    emit("reset-game");
};

</script>

<style scoped>
.summary-card {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(209, 201, 201, 0.1);
    text-align: center;
    background: white;
}

/* Vue Transition Animations */
.fade-scale-enter-active,
.fade-scale-leave-active {
    transition: all 0.5s ease;
}

.fade-scale-enter-from,
.fade-scale-leave-to {
    opacity: 0;
    transform: scale(0.8);
}

h2 {
    margin-bottom: 15px;
    font-size: 1.5rem;
}

.stats {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
}

.stat {
    display: flex;
    justify-content: space-between;
    padding: 8px 12px;
    background: #f7f7f7;
    border-radius: 5px;
}

.label {
    font-weight: bold;
    color: #333;
}

.value {
    font-weight: bold;
    color: #007bff;
}

.play-again-btn {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: bold;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.play-again-btn:hover {
    background-color: #0056b3;
}

/* Vue Transition Animations */
.fade-scale-enter-active,
.fade-scale-leave-active {
    transition: all 0.5s ease;
}

.fade-scale-enter-from,
.fade-scale-leave-to {
    opacity: 0;
    transform: scale(0.8);
}
</style>