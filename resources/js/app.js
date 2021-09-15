/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

// Delete confirmation message
const deleteConfirm = document.querySelectorAll(".delete-form");
deleteConfirm.forEach(form => {
    form.addEventListener("submit", function(e) {
        const resp = confirm("Sei sicuro di voler cancellare?");
        if (!resp) {
            e.preventDefault();
        }
    });
});

// Payed confirmation message
const payConfirm = document.querySelector("#pay");
// deleteConfirm.forEach(form => {
    if(payConfirm){
        console.log(payConfirm);
        payConfirm.addEventListener("submit", function(e) {
            console.log('ciao');
            const resp = confirm("Sei sicuro di voler spostare l'appuntamento in pagati?");
            if (!resp) {
                e.preventDefault();
            }
        });
    }
// });

// Services required
const btnType = document.getElementById("sub-btn");

if (btnType) {
    btnType.addEventListener("click", function(e) {
        const check = document.querySelectorAll("input[id^=service]");
        console.log(check);
        const checked = [];
        check.forEach(input => {
            if (input.checked) {
                checked.push(input);
            }
        });
        if (checked.length == 0) {
            alert("Seleziona almeno una tipologia");
            e.preventDefault();
        }
    });
}

// CLear date production
const btnSub = document.getElementById("sub");
const btnClear = document.getElementById("clear");
const input = document.getElementById("month");
console.log(btnClear);
if (btnClear) {
    btnClear.addEventListener("click", function(e) {
        input.value = 0;
        btnSub.click();
    });
}

// Calendar
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridWeek',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek,dayGridDay'
      },
      nowIndicator: true,
    //   businessHours: {
    //     // days of week. an array of zero-based day of week integers (0=Sunday)
    //     daysOfWeek: [ 2, 3, 4, 5, 6 ], // 
      
    //     // startTime: '8:00', // a start time (10am in this example)
    //     // endTime: '20:00', // an end time (6pm in this example)
    //   },
      slotMinTime: '8:00:00',
      slotMaxTime: '21:00:00',
      locale: 'it',
      dateClick: function() {
        alert('a day has been clicked!');
      },
      
    });
    calendar.render();
  });