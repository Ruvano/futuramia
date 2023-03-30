<?php
global $globalOptions;


/** 
 * API all programs
 */
function programsJson() {
    $programs = new WP_Query([
        'post_type' => 'program',
        'posts_per_page' => -1,
    ]);
    $programsJson = [];
    foreach ($programs->posts as $key => $item) :
        $fields = get_fields($item->ID);
        $programActivities = !empty($fields['general_activities']) ? $fields['general_activities'] : false;
        $programActivitiesArray = [];
        if ($programActivities) :
            foreach ($programActivities as $key => $activity) :
                (int) $activityTime = isset($activity['time']) ? $activity['time'] : 1;
                $cptActivityFields = get_fields($activity['activitie']->ID);
                (int) $activityCostHour = isset($cptActivityFields['price']) ? $cptActivityFields['price'] : 1;
                (int) $activityCalculatedPrice = ( (int) $activityCostHour / 60 ) * (int) $activityTime;
                array_push($programActivitiesArray, [
                    'id' => $activity['activitie']->ID,
                    'title' => $activity['activitie']->post_title,
                    'minutes' => $activityTime,
                    'costHour' => $activityCostHour,
                    'calculatedPrice' => $activityCalculatedPrice,
                ]);
            endforeach;
        endif;
        $programGeneralIcons = !empty($fields['general_icons']) ? $fields['general_icons'] : false;
        $programTime = isset($programGeneralIcons['time']) ? $programGeneralIcons['time'] : 0;
        array_push($programsJson, [
            'id' => $item->ID,
            'title' => $item->post_title,
            'activities' => $programActivitiesArray,
            'time' => $programTime
        ]);
    endforeach;
    /** Add free program */
    array_unshift($programsJson, [
        'id' => 0,
        'title' => 'Свободная программа',
        'activities' => [],
        'time' => 1
    ]);
    return json_encode($programsJson);
}

if(isset($_GET['programs_json']) && $_GET['programs_json'] == 'all') :
    echo programsJson();
    die();     
endif;


/** 
 * API calculator
 */
function calculatorJson() {
    global $globalOptions;
    /** Prepare data for Vue (JSON) */
    $calculator_person = isset($globalOptions['calculator_person']) ? $globalOptions['calculator_person'] : false;
    $calculator_time = isset($globalOptions['calculator_time']) ? $globalOptions['calculator_time'] : false;
    $calculator_activity = isset($globalOptions['calculator_activity']) ? $globalOptions['calculator_activity'] : false;
    $result = [
        'person'    => $calculator_person,
        'time'      => $calculator_time,
        'activity'  => $calculator_activity,
        'cakePrice' => 2000
    ];
    return json_encode($result);
}

if(isset($_GET['calculator_json']) && $_GET['calculator_json'] == 'all') :
    echo calculatorJson();
    die(); 
endif;


/** 
 * API all activities
 */
function activitiesJson() {
    global $globalOptions;
    $activities = new WP_Query([
        'post_type' => 'activity',
        'posts_per_page' => -1,
    ]);
    $activitiesJson = [];
    foreach ($activities->posts as $key => $item) :
        $fields = get_fields($item->ID);
        $activityTypeLabel = !empty($fields['type']) ? $fields['type']['label'] : '';
        $activityPrice = isset($fields['price']) ? $fields['price'] : 0;
        $activityMinTime = isset($fields['min_time']) ? $fields['min_time'] : 0;
        $activityMaxTime = isset($fields['max_time']) ? $fields['max_time'] : 0;
        array_push($activitiesJson, [
            'id' => $item->ID,
            'title' => $item->post_title,
            'type' => $activityTypeLabel,
            'price' => $activityPrice,
            'min_time' => $activityMinTime,
            'max_time' => $activityMaxTime,
        ]);
    endforeach;
    return json_encode($activitiesJson);
}

if(isset($_GET['activities_json']) && $_GET['activities_json'] == 'all') :
    echo activitiesJson();
    die();   
endif;