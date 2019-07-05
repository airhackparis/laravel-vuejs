<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome to this hackathon</div>

                    <div class="card-body">
                        <p>I'm an example component called HelloWorld.vue.</p>
                        <p>This boilerplate application already contains front-end libraries such as Axios, VueX and VueRouter.</p>
                        <p>The example component, VueX and VueRouter files are located in this directory : /resources/js/</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Hello world !')
        }
    }
</script>
