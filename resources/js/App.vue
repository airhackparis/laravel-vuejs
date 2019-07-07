<template>
    <div id="app">
        <img class="logo" src="images/airbnb-logo.png" />
        <h1>Welcome to AirHack</h1>
        <p>
            <router-link to="/">Home</router-link> -
            <router-link to="/airhack-api-health">AirHack Api Health</router-link>
        </p>
        <hr class="separator" />
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: 'app'
    }
</script>

<style scoped>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }

    .logo {
        width: 200px;
    }

    .separator {
        margin-top: 80px;
        margin-bottom: 80px;
        border: 0;
        height: 1px;
        width: 70%;
        background: #ccc;
    }

    h1 {
        margin-top: 0;
    }

    a {
        text-decoration: none;
    }
</style>