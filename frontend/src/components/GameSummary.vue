<script setup>

</script>

<template>
    <h2>Game Summary</h2>
    <table>
        <thead>
        <tr>
            <th>Player 1</th>
            <th>Player 2</th>
            <th>Player result</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <img src="@/assets/rock.png">
            </td>
            <td>
                <img src="@/assets/paper.png">
            </td>
            <td>
                <span class="win">Win</span>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="card">
        <button type="button" @click="count++">count is {{ count }}</button>
        <p>
            Edit
            <code>components/HelloWorld.vue</code> to test HMR
        </p>
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

<style scoped>
.read-the-docs {
    color: #888;
}

table{
    width: 100%;
    border: 1px solid #3e3e3a;
}

table img {
    height: 20px;
    width: 20px;
}
</style>
