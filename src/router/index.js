import Vue from 'vue';
import VueRouter from 'vue-router';

import TodoList from "../components/TodoList";


Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { path: "/",component: TodoList},
    ],
    scrollBehavior () {
        return { x: 0, y: 0 }
    }
})