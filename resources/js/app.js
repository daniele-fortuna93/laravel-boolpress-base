/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var app = new Vue({
    el: '#app',
    data: {
        posts: [],
    },
    mounted: function(){
        var self = this;
        axios.get('/api/posts')
        .then(function (response) {
            self.posts = response.data;
        });
    }
});
