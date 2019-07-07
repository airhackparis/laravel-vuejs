import Vue from 'vue'
import Router from 'vue-router'
import Home from './components/Home.vue'
import AirHackApiHealth from './components/AirHackApiHealth.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/airhack-api-health',
      name: 'AirHackApiHealth',
      component: AirHackApiHealth
    },
  ]
})
