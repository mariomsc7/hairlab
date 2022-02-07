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

Vue.component('agenda', require('./components/Agenda.vue').default);

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

// window.axios = require('axios');
// console.log(axios);

// CLear date production/date payments
const btnSub = document.getElementById("sub");
const btnClear = document.getElementById("clear");
const input = document.getElementById("month");
if (btnClear) {
    btnClear.addEventListener("click", function(e) {
        input.value = 0;
        btnSub.click();
    });
}

// Calendar
document.querySelector('style').textContent += "@media screen and (max-width:767px) { .fc-toolbar.fc-header-toolbar {flex-direction:column;} .fc-toolbar-chunk { display: table-row; text-align:center; padding:5px 0; } }";
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        
      initialView: 'listWeek',
      views: {
        listDay: { buttonText: 'Giorno' },
        listWeek: { buttonText: 'Settimana' },
        listMonth: { buttonText: 'Mese' }
      },
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'listDay,listWeek,listMonth'
      },
      nowIndicator: true,
      events: 'http://127.0.0.1:8000/api/appointments',
      eventDidMount: function(info) {
        if (info.event.extendedProps.status === 1) {
    
          // Change background color of row
          info.el.style.backgroundColor = 'lightgreen';
    
          // Change color of dot marker
          var dotEl = info.el.getElementsByClassName('fc-event-dot')[0];
          if (dotEl) {
            dotEl.style.backgroundColor = 'white';
          }
        }
      },   
      slotMinTime: '8:00:00',
      slotMaxTime: '21:00:00',
      locale: 'it',
    });
    calendar.render();
  });