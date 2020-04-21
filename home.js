import Vue from 'Vue'

import HomeComponent from './Home.Vue'

Vue.component('home-component',HomeComponent);

new Vue ({
    el: '#home-component',
    render: h => h(HomeComponent),
});