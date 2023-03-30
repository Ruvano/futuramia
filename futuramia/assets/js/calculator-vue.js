jQuery(document).ready(function(){
    $(function() {
        /**
         * Select for programs
         */
        $('.program-selectize').selectize({
            allowClear: true,
            minimumResultsForSearch: -1,
            onInitialize: function() {
                this.trigger('change', calculatorVue.selectedData.program.id, true);
            },
            onChange: function(value, isOnInitialize) {
                calculatorVue.changeProgram(value);
            }
        });
    });
    /**
     * Select for add activity
     */
    $(function() {
        $('.add-activity-selectize').selectize({
            placeholder: 'Выберите активность',
            allowClear: true,
            minimumResultsForSearch: -1,
            onInitialize: function() {
                this.trigger('change', calculatorVue.selectedData.addActivitySelect.id, true);
            },
            onChange: function(value, isOnInitialize) {
                calculatorVue.changeSelectActivity(value);
            }
        });
    });
});

/** Notification options */
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-left",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
/** Calculator */
var calculatorVue = new Vue({
    el: '#calculator-app',
    data: {
        serverData: {
            allPrograms: programsJson,
            allActivities: activitiesJson,
            calculator: calculatorJson,
        },
        selectedData: {
            program: false,
            countMembers: 10,
            countRentalTime: 1,
            cake: false,
            activities: [],
            addActivityFlag: false,
            addActivitySelect: {
                max_time: 0,
                min_time: 0,
                minutes: 0,
                calculatedPrice: 0
            },
            addActivityMinutes: 0
        },
        sliderMembersOptions: {
            min: 1,
            max: 20,
            interval: 1,
        },
        sliderRentalTimeOptions: {
            min: 1,
            max: 5,
            interval: 1,
        }
    },
    mounted() {
        /** Selected program */
        this.changeProgram(this.serverData.allPrograms[0].id);

        /** Rental time & persons slider options */
        this.sliderMembersOptions.max = Number(this.serverData.calculator.person.max);
        this.sliderRentalTimeOptions.max = Number(this.serverData.calculator.time.max);

        /** Add select activity */
        this.changeSelectActivity(this.serverData.allActivities[0].id);
    },
    components: {
        'vue-slider': window[ 'vue-slider-component' ],
    },
    computed: {
        freeTime: function(){
            return ((Number(this.selectedData.countRentalTime) * 60) - Number(this.selectedActivitiesTime()));
        },
        costMember: function() {
            if (this.selectedData.countMembers > this.serverData.calculator.person.free) {
                return (this.selectedData.countMembers - this.serverData.calculator.person.free) * this.serverData.calculator.person.price + ' руб.';
            } else {
                return 'Включено в программу';
            }
        },
        costRentalTime: function() {
            return (this.selectedData.countRentalTime * this.serverData.calculator.time.price) + ' руб.';
        },
        resultPrice: function() {
            result = 0;
            /** Calculate cost members */
            if(this.selectedData.countMembers > this.serverData.calculator.person.free) {
                result += (this.selectedData.countMembers - this.serverData.calculator.person.free) * this.serverData.calculator.person.price
            }
            /** Calculate cost Rental time */
            if(this.selectedData.countRentalTime) {
                result += Number(this.selectedData.countRentalTime * this.serverData.calculator.time.price)
            }
            /** Calculate cost activities */
            if(this.selectedData.activities) {
                this.selectedData.activities.forEach(activity => {
                    result += Number(activity.calculatedPrice);
                });
            }

            /** Calculate cost cake */
            if(this.selectedData.cake) {
                result += Number(this.serverData.calculator.cakePrice);
            }
            return result;
        },
    },
    methods: {
        filteredPrograms: function () {
            var data = this.serverData.allPrograms.filter(program => {
                return program;
            });
            return data;
        },
        changeProgram: function (id) {
            var url = "//futuramia.loc/?programs_json=all";
            axios.get(url).then((response) => {
                if(response.data) {
                    this.serverData.allPrograms = response.data;
                }
            });

            var program = this.serverData.allPrograms.filter(program => {
               return program.id == id;
            });
            this.selectedData.program = program[0];
            
            /** Add activities */
            this.selectedData.activities = this.selectedData.program.activities;
            /** Add Rental Time */
            this.selectedData.countRentalTime = Number(this.selectedData.program.time);
        },
        changeSelectActivity: function(id) {
            var activitySelect = this.serverData.allActivities.filter(activity => {
                return activity.id == id;
            });
            this.selectedData.addActivitySelect = activitySelect[0];
            this.selectedData.addActivitySelect.minutes = Number(this.selectedData.addActivitySelect.min_time);
            this.selectedData.addActivityMinutes = Number(this.selectedData.addActivitySelect.minutes);
            this.selectedData.addActivitySelect.calculatedPrice = Math.round(Number(this.selectedData.addActivitySelect.price)/60);
        },
        getActivityType: function (item) {
            var serverActivity = this.serverData.allActivities.filter(activity => {
                return activity.id == item.id;
            });
            return serverActivity[0].type;
        },
        changeActivityTime: function(activity, flag = false) {
            if (flag == false) {
                return false;
            }
            var stepMinutes = 15;
            /** Get min/max minutes for activity */
            var activityOptions = this.serverData.allActivities.filter(item => {
                return activity.id === item.id;
            });

            /** Change time and cost */
            this.selectedData.activities.filter(item => {
                if(activity.id === item.id) {
                    if ('plus' === flag) {
                        if( (Number(this.selectedData.countRentalTime) * 60) < (Number(this.selectedActivitiesTime()) + stepMinutes) ) {
                            console.log("Для увеличения времени активности, добавьте время аренды парка.");
                            toastr.warning("Для увеличения времени активности, добавьте время аренды парка.");
                            return false;
                        }

                        if (Number(item.minutes) + stepMinutes <= activityOptions[0].max_time) {
                            item.minutes = Number(item.minutes) + stepMinutes;
                            item.calculatedPrice = Math.round(item.minutes * (item.costHour/60));
                        } else {
                            console.log("Эта активность не может длиться дольше " + activityOptions[0].max_time + " минут.");
                            toastr.warning("Эта активность не может длиться дольше " + activityOptions[0].max_time + " минут.")
                        }
                    }
                    if ('minus' == flag) {
                        if (Number(item.minutes) - stepMinutes >= activityOptions[0].min_time) {
                            item.minutes = Number(item.minutes) - stepMinutes;
                            item.calculatedPrice = Math.round(item.minutes * (item.costHour/60));
                        } else {
                            console.log("Эта активность не может длиться менее " + activityOptions[0].min_time + " минут.");
                            toastr.warning("Эта активность не может длиться менее " + activityOptions[0].min_time + " минут.")
                        }
                    }
                }
            });
        },
        changeSelectActivityTime: function(flag = false) {
            if (flag == false) {
                return false;
            }
            const stepMinutes = 15;
            
            /** Change time and cost */
            if ('plus' == flag) {
                if ((Number(this.selectedData.addActivitySelect.minutes) + stepMinutes) <= this.selectedData.addActivitySelect.max_time) {
                    this.selectedData.addActivitySelect.minutes = Number(this.selectedData.addActivitySelect.minutes) + stepMinutes; // Plus minutes
                    this.selectedData.addActivityMinutes = this.selectedData.addActivitySelect.minutes;
                    this.selectedData.addActivitySelect.calculatedPrice = Math.round(this.selectedData.addActivitySelect.minutes * (this.selectedData.addActivitySelect.price/60)); // Plus price
                } else {
                    console.log("Эта активность не может длиться дольше " + this.selectedData.addActivitySelect.max_time + " минут.");
                    toastr.warning("Эта активность не может длиться дольше " + this.selectedData.addActivitySelect.max_time + " минут.")
                }
            }
            if ('minus' == flag) {
                if ((Number(this.selectedData.addActivitySelect.minutes) - stepMinutes) >= this.selectedData.addActivitySelect.min_time) {
                    this.selectedData.addActivitySelect.minutes = Number(this.selectedData.addActivitySelect.minutes) - stepMinutes; // Minus minutes
                    this.selectedData.addActivityMinutes = this.selectedData.addActivitySelect.minutes;
                    this.selectedData.addActivitySelect.calculatedPrice = Math.round(this.selectedData.addActivitySelect.minutes * (this.selectedData.addActivitySelect.price/60)); // Minus price
                } else {
                    console.log("Эта активность не может длиться менее " + this.selectedData.addActivitySelect.min_time + " минут.");
                    toastr.warning("Эта активность не может длиться менее " + this.selectedData.addActivitySelect.min_time + " минут.");
                }
            }
        },
        removeActivity: function (key) {
            calculatorVue.selectedData.activities.splice(key, 1);
        },
        addActivity: function () {
            var newActivity = {
                calculatedPrice: Math.round(this.selectedData.addActivitySelect.minutes * (this.selectedData.addActivitySelect.price/60)),
                costHour: this.selectedData.addActivitySelect.price,
                id: this.selectedData.addActivitySelect.id,
                minutes: this.selectedData.addActivitySelect.minutes,
                title: this.selectedData.addActivitySelect.title,
            }
            
            if( (Number(this.selectedData.countRentalTime) * 60) >= (Number(this.selectedActivitiesTime()) + Number(newActivity.minutes)) ) {
                this.selectedData.activities.push(newActivity);
            } else {
                console.log("Для добавления активности увеличте время аренды парка.");
                toastr.warning("Для добавления активности увеличте время аренды парка.");
            }
        },
        selectedActivitiesTime: function () {
            var sumMinutes = 0;
            this.selectedData.activities.forEach(element => {
                sumMinutes += Number(element.minutes);
            });
            return sumMinutes;
        },
        getPriceProgramById: function(id) {
            result = 0;
            var currentProgram = this.serverData.allPrograms.filter(program => {
                return program.id == id;
            });
            currentProgram = currentProgram[0];

            /** Calculate cost Rental time */
            if(currentProgram.time) {
                result += Number(currentProgram.time) * Number(this.serverData.calculator.time.price)
            }
            /** Calculate cost activities */
            if(currentProgram.activities) {
                currentProgram.activities.forEach(activity => {
                    result += Number(activity.calculatedPrice);
                });
            }

            return Math.round(result);
        }
    },
});