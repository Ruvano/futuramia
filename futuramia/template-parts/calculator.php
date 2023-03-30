<?php
global $globalOptions;
/** Fields from Home Page */
$general_home_id = isset($globalOptions['general_home_id']) ? $globalOptions['general_home_id'] : '';
$homeFields = get_fields($general_home_id);
?>
<?php
/** Calculator */
$calculator_title = isset($homeFields['calculator_title']) ? $homeFields['calculator_title'] : '';
?>
<?php if (isset($calculator_title)) : ?>
<section id="calculator" class="calculator">
    <div id="bg-canvas-stars-calculator"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title fs-42"><?php echo $calculator_title; ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="calculator-box">
                    <div class="row">
                        <div class="col-lg-7">

                            <div id="calculator-app" class="calculator-app" v-cloak>
                                <div class="app-field-program fs-16">
                                    <span class="app-label-text">Выберите программу: </span>
                                    <span class="app-control-wrap">
                                        <select name="program" class="fs-18 program-selectize">
                                            <option v-for="program in serverData.allPrograms" :value="program.id">{{ program.title }}</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="app-field fs-16">
                                    <span class="app-label-text">
                                        Количество участников: <span class="result">{{ selectedData.countMembers }} чел.</span>
                                        <span class="separator">|</span>
                                        Стоимость: <span class="result">{{ costMember }}</span>
                                    </span>
                                    <span class="app-control-wrap">
                                        <vue-slider 
                                            v-model="selectedData.countMembers"
                                            v-bind="sliderMembersOptions"
                                            :marks="true"
                                        ></vue-slider>
                                    </span>
                                </div>
                                <div class="app-field fs-16">
                                    <span class="app-label-text">
                                        Часы аренды: <span class="result">{{ selectedData.countRentalTime }} час.</span>
                                        <span class="separator">|</span>
                                        Стоимость: <span class="result">{{ costRentalTime }}</span>
                                    </span>
                                    <span class="app-control-wrap">
                                        <vue-slider 
                                            v-model="selectedData.countRentalTime"
                                            v-bind="sliderRentalTimeOptions"
                                            :marks="true"
                                        ></vue-slider>
                                    </span>
                                </div>
                                <div class="app-field fs-16">
                                    <span class="app-label-text">Игровые активности:</span>
                                    <span class="app-control-wrap">
                                        <div class="activities" v-for="(activity, index) in selectedData.activities" :key="index">
                                            <div class="activity-item">
                                                <div class="left activity-row">
                                                    <span class="type">
                                                        {{getActivityType(activity)}}
                                                    </span>
                                                    <span class="title">
                                                        {{activity.title}}
                                                    </span>
                                                </div>
                                                <div class="right activity-row">
                                                    <span class="time">
                                                        <span class="plus" @click="changeActivityTime(activity, 'plus')">+</span>
                                                            <b>{{activity.minutes}}</b>
                                                        <span class="minus" @click="changeActivityTime(activity, 'minus')">-</span>
                                                        <span class="desc fs-12">
                                                            мин
                                                        </span>
                                                    </span>
                                                    <span class="price">
                                                        <b>{{activity.calculatedPrice}}</b>
                                                        <span class="desc fs-12">
                                                            руб
                                                        </span>
                                                    </span>
                                                    <span class="remove-btn" @click="removeActivity(index)">
                                                        +
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-activity">
                                            <span class="button-toggle" :class="{active:!selectedData.addActivityFlag}" @click="selectedData.addActivityFlag =! selectedData.addActivityFlag">
                                                Добавить активность
                                                <span v-if="!selectedData.addActivityFlag"> ↑</span>
                                                <span v-else>↓</span>
                                            </span>
                                            <div class="add-activity-row" :class="{show:!selectedData.addActivityFlag}">
                                                <div class="left">
                                                    <span class="app-control-wrap">
                                                        <select name="activity" class="fs-16 add-activity-selectize">
                                                            <option v-for="activity in serverData.allActivities" :value="activity.id">{{ activity.title }}</option>
                                                        </select>
                                                    </span>
                                                </div>
                                                <div class="right">
                                                    <span class="time">
                                                        <span class="plus" @click="changeSelectActivityTime('plus')">+</span>
                                                            <b>{{ selectedData.addActivityMinutes }}</b>
                                                        <span class="minus" @click="changeSelectActivityTime('minus')">-</span>
                                                        <span class="desc fs-12">
                                                            мин
                                                        </span>
                                                    </span>
                                                    <span class="price">
                                                        <span class="add-activity-button" @click="addActivity()">
                                                            Добавить
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                <div class="app-field app-field--checkbox fs-16">
                                    <span class="app-control-wrap">
                                        <label for="checkbox">
                                            <input type="checkbox" id="checkbox" v-model="selectedData.cake">
                                            <span>Добавить инопланетный кенди-бар, или торт - <b>{{ serverData.calculator.cakePrice }}</b> руб.</span>
                                        </label>
                                    </span>
                                </div>
                                <div class="app-result fs-16">
                                    <span class="block-title">
                                        Итого:
                                    </span>
                                    <span class="string-results">
                                        <span class="item"><b>Аренда парка:</b> {{ selectedData.countRentalTime }} час.</span>
                                        <span class="separator"> | </span>
                                        <span class="item"><b>Свободного времени:</b> {{ freeTime }} мин.</span>
                                        <span class="separator"> | </span>
                                        <span class="item"><b>Стоимость:</b> {{ resultPrice }} руб.</span>
                                    </span>
                                </div>
                            </div><!-- #calculator-app -->

                            <script type="text/javascript">
                                const calculatorJson = <?php echo calculatorJson(); ?>;
                                const programsJson = <?php echo programsJson(); ?>;
                                const activitiesJson = <?php echo activitiesJson(); ?>;
                            </script>
                        </div>
                        <div class="col-lg-5">
                            <?php //echo do_shortcode('[contact-form-7 id="18" title="Contact from calculator" html_class="calculator-form"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?> 