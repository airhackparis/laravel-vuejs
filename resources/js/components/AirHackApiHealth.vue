<template>
    <div>
        <p>Check Dev Console to get AirHack API Health!</p>
    </div>
</template>


<script>
    export default {
        mounted() {
            this.$http.get('/api/airHackApiHealth').then(response => {
                console.log(response.data)
            })
        }
    }
</script>
