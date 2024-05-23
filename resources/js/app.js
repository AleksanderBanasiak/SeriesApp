

import './bootstrap';
import { createApp } from 'vue';



const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);



app.mount('#app');

document.addEventListener('DOMContentLoaded', function () {
    const starsContainers = document.querySelectorAll('.rating');

    starsContainers.forEach(function (starsContainer) {
        const stars = starsContainer.querySelectorAll('i.fa-star');

        stars.forEach(function (star) {
            star.addEventListener('mouseenter', function () {
                const rating = parseInt(this.getAttribute('data-rating'));
                stars.forEach(function (innerStar) {
                    const innerRating = parseInt(innerStar.getAttribute('data-rating'));
                    if (innerRating <= rating) {
                        innerStar.style.color = '#ffc107'; 
                    }
                });
            });

            star.addEventListener('mouseleave', function () {
                stars.forEach(function (innerStar) {
                    innerStar.style.color = ''; 
                });
            });
        });
    });
});


