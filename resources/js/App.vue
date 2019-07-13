<template>
    <div id="app">
        <header class="header">
            <img class="header-image" height="64" src="images/logo2.png"/>
            City Manager
        </header>
        <div class="map-container">
            <div class="tasker-list" >
                <div :class="[item === selectedTasker ?  'selected' : '']" @click="onClickTasker(item)" class="list-item" v-for="(item) in taskers">
                    Tasker n°{{item}}
                </div>
            </div>
            <LMap
                :zoom="zoom"
                :center="center"
            >
                <LTileLayer :url="url"></LTileLayer>
                <v-marker-cluster>
                    <LMarker v-for="task in filteredTasks" :lat-lng="[task.lat, task.lng]" ></LMarker>
                </v-marker-cluster>
            </LMap>
        </div>

    </div>
</template>

<script>
  import {LMap, LTileLayer, LMarker, LPolyline } from 'vue2-leaflet';
  import test from './data.json';

  export default {
        name: 'app',
        data() {
          return {
            url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
            zoom: 14,
            center: [48.8566, 2.3522],
            taskers: test.taskersCount,
            tasks: test.tasks,
            selectedTasker: null
          }
        },
        computed: {
          filteredTasks() {
            if (!this.selectedTasker) {
              return this.tasks
            }

            return this.tasks.filter(task => task['assignee_id'] === this.selectedTasker)
          }
        },
        methods: {
          onClickTasker: function(taskerId) {
            this.selectedTasker = taskerId;
          }
        },
        components: {
          LMap,
          LTileLayer,
          LMarker
        }
    }
</script>

<style>
    @import "~leaflet.markercluster/dist/MarkerCluster.css";
    @import "~leaflet.markercluster/dist/MarkerCluster.Default.css";

    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        display: flex;
        flex: 1;
        flex-direction: column;
    }

    .list-item {
        height: 60px;
        display: flex;
        padding-left: 24px;
        align-items: center;
        border-bottom: 1px solid rgb(235, 235, 235);
        cursor: pointer;
        transition: all 200ms;
    }

    .list-item.selected {
        background-color: rgb(235, 235, 235);
    }

    .list-item:hover {
        background-color: rgb(235, 235, 235);
    }

    .tasker-list {
        width: 30%;
        overflow: auto;
    }

    .map-container {
        flex: 1;
        display: flex;
    }

    .header-image {
        margin-right: 24px;
    }

    html, body {
        height: 100%;
        width: 100%;
        display: flex;
    }

    .header {
        height: 80px;
        display: flex;
        align-items: center;
        padding: 0 24px;
        border-bottom: 1px solid rgb(235, 235, 235);
    }
</style>