<template>
    <vue-cal 
         :selected-date="new Date()"
         :time-from="8 * 60"
         :time-step="30"
         :disable-views="['years', 'year']"
         active-view="day"
         editable-events
         locale='it'
         :events="events"
         :split-days="splitDays"
         :sticky-split-labels="stickySplitLabels"
         :min-cell-width="minCellWidth"
         :min-split-width="minSplitWidth">
         
    </vue-cal> 
    
        

</template>

<script>
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'
import 'vue-cal/dist/drag-and-drop.js'
import 'vue-cal/dist/i18n/it.js'

export default {
    components: { VueCal },
    name: 'Agenda',
    data: () => ({
        
     stickySplitLabels: true,
     minCellWidth: 250,
     minSplitWidth: 0,
        events: [],
        splitDays: [ 
                        { id: 1, class: 'matteo', label: 'Matteo' },
                        { id: 2, class: 'davide', label: 'Davide' },
                        { id: 3, class: 'martina', label: 'Martina' },
                        { id: 4, class: 'luciana', label: 'Luciana' }
                    ]
        }),
    created() {
        this.getEvents();
    },
    methods: {
        getEvents() {
            axios.get('http://127.0.0.1:8000/api/appointments')
                .then(res => {
                    this.events = res.data;
                    console.log(this.events)
                })
                .catch(err => {
                    console.log('Error');
                })
        },
    }
}
</script>

<style>
    /* You can easily set a different style for each split of your days. */
.vuecal__cell-split.matteo {background-color: rgba(17, 204, 236, 0.5);}
.vuecal__cell-split.davide {background-color: rgba(37, 174, 228, 0.5);}
.vuecal__cell-split.martina {background-color: rgba(216, 139, 247, 0.5);}
.vuecal__cell-split.luciana {background-color: rgba(197, 0, 82, 0.5);}
.vuecal__cell-split .split-label {color: rgba(0, 0, 0, 0.1);font-size: 26px;}

/* Different color for different event types. */
.vuecal__event.leisure {background-color: rgba(253, 156, 66, 0.9);border: 1px solid rgb(233, 136, 46);color: #fff;}
.vuecal__event.health {background-color: rgba(255, 255, 255, 0.9);border: 1px solid rgb(144, 210, 190);}
.vuecal__event.sport {background-color: rgba(255, 102, 102, 0.9);border: 1px solid rgb(235, 82, 82);color: #fff;}
</style>