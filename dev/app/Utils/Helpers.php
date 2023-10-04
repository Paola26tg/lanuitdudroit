<?php

use Hashids\Hashids;

if(!function_exists('getAppName')) {
    function getAppName($uppercase = false, $suffix = null){
        return $uppercase ? mb_strtoupper(config('app.name').$suffix) : config('app.name').$suffix;
    }
}

if(!function_exists('setTabName')) {
    function setTabName($prefix, $separator = "|", $uppercase = false, $suffix = null){
        return ($uppercase?mb_strtoupper($prefix):$prefix).' '.$separator.' '.getAppName($uppercase, ' '.$suffix);
    }
}

if(!function_exists('isActiveLink')) {
    function isActiveLink($routes){
        $isActive = '';
        for ($i = 0; $i < sizeof($routes); $i++) {
            if (\Route::current()->getName() == $routes[$i]) {
                $isActive = 'active';
            }
        }
        return $isActive;
    }
}


const LONG_FORMAT_WITH_DAY = 0; // Vendredi 15 Novembre 2019
const LONG_FORMAT_WITHOUT_DAY = 1; // 12 Novembre 2019
const DAY_FORMAT_ONLY = 2; // Vendredi
const MONTH_FORMAT_ONLY = 3; // Novembre

if(!function_exists('frenchifyDate')) {
    function frenchifyDate($format, $date = null){
        $date = is_null($date) ? date('Y-m-d') : $date;

        $months = explode('_', 'Janvier_Février_Mars_Avril_Mai_Juin_Juillet_Août_Septembre_Octobre_Novembre_Décembre');
        $weekdays = explode('_', 'Lundi_Mardi_Mercredi_Jeudi_Vendredi_Samedi_Dimanche');

        $frenchified_format = null;
        $month_position = date('n', strtotime($date)) - 1;
        $day_position = date('N', strtotime($date)) - 1;
        $input_year = date('Y', strtotime($date));
        $input_day = date('d', strtotime($date));

        switch ($format) {
            case 0:
                $frenchified_format = $weekdays[$day_position] . ', ' . $input_day . ' ' . $months[$month_position] . ' ' . $input_year;
                break;
            case 1:
                $frenchified_format = $input_day . ' ' . $months[$month_position] . ' ' . $input_year;
                break;
            case 2:
                $frenchified_format = $weekdays[$day_position];
                break;
            case 3:
                $frenchified_format = $months[$month_position];
                break;
        }

        return $frenchified_format;
    }
}

const UPPER_TOKEN = 'upper';
const LOWER_TOKEN = 'lower';
const CAMEL_TOKEN = 'camel';
const DIGIT_TOKEN = 'digits';

if(!function_exists('generateToken')) {
    function generateToken($length = 10, $case = 'camel'){
        $chars = ['upper' => 'AZERTYUIOPQSDFGHJKLMWXCVBN0123456789', 'lower' => 'azertyuiopqsdfghjklmwxcvbn0123456789', 'camel' => 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789', 'digits' => '0123456789'];
        return substr(str_shuffle(str_repeat($chars[$case], $length)), 0, $length);
    }
}

if(!function_exists('removeAccents')) {
    function removeAccents($string){
        return trim(preg_replace('~[^0-9a-z]+~i', ' ', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'))), ' ');
    }
}

if(!function_exists('compareString')) {
    function compareString($string_1, $string_2, $remove_accents = false, $lowercase = false){
        $string_1 = $lowercase ? strtolower($string_1) : $string_1;
        $string_1 = $remove_accents ? removeAccents($string_1) : $string_1;

        $string_2 = $lowercase ? strtolower($string_2) : $string_2;
        $string_2 = $remove_accents ? removeAccents($string_2) : $string_2;

        return $string_1 === $string_2;
    }
}

if(!function_exists('encodeId')){
    function encodeId($integerId){
        $hashids = new Hashids('', 10);
        return $hashids->encode($integerId);
    }
}

if(!function_exists('decodeId')){
    function decodeId($hashedId){
        if(is_null($hashedId)) return null;
        $hashids = new Hashids('', 10);
        return $hashids->decode($hashedId)[0];
    }
}

if(!function_exists('isWeekend')){
    function isWeekend($date = null, $stepDay = null, $getAlsoWeekendDay = false){
        //if date is null, we take current date for checking
        if(is_null($date)) $date = date('Y-m-d');
        //if setpDay is null, we set it to 0
        if(is_null($stepDay)) $stepDay = 0;
        //Add step days to check weekend falls in future or now
        $date = date('Y-m-d', strtotime($date.' + '.$stepDay.' days'));
        //$yeahIsWeekend take true/false switch weekend falling or not
        $yeahIsWeekend = date('D', strtotime($date)) ==='Sat' || date('D', strtotime($date)) === 'Sun';
        $whichWeekendDay = null;
        //if date is Saturday $whichWeekendDay take S letter
        if(date('D', strtotime($date)) ==='Sat') $whichWeekendDay = 'S';
        //if date is Sunday $whichWeekendDay take D letter
        elseif(date('D', strtotime($date)) ==='Sun') $whichWeekendDay = 'D';
        //return true/false switch weekend falling or not | tab or boolean swicth getter format
        return $getAlsoWeekendDay ? [$yeahIsWeekend, $whichWeekendDay] : $yeahIsWeekend;
    }
}

if(!function_exists('isHolidays')) {
    function isHolidays($date = null, $holidays = null)
    {
        if (is_null($date)) $date = date('Y-m-d');
        $year = date('Y');
        $self_holidays = [
            $year . '-01-01', //Jour de l'an
            $year . '-04-13', //Lundi de pâques
            $year . '-04-27', //Fête de l'indépendance
            $year . '-05-01', //Fête du travail
            $year . '-05-21', //Ascension
            $year . '-05-24', //Fête de la Ramadan
            $year . '-06-01', //Lundi de pentecôte
            $year . '-06-21', //Fête des martyrs
            $year . '-07-31', //Fête de la Tabaski
            $year . '-08-15', //Assomption
            $year . '-11-01', //Toussaint
            $year . '-12-25' //Noël
        ];

        if (is_null($holidays)) $holidays = $self_holidays;

        $isHoliday = false;
        for ($i = 0; $i < sizeof($holidays); $i++) {
            if ($holidays[$i] === $date) {
                $isHoliday = true;
                break;
            }

        }

        return $isHoliday;
    }

    if(!function_exists('getCurrentWeek')){
        function getCurrentWeek($postion = null, $wihchDay = 6){

            date_default_timezone_set('UTC');
            $mon = strtotime("last monday");
            $mon = date('w', $mon) == date('w') ? $mon + 7 * 86400: $mon;
            $sun = strtotime(date("Y-m-d", $mon) . "+$wihchDay days");
            $week_start = date("Y-m-d", $mon);
            $week_end = date("Y-m-d", $sun);

            switch($postion){
                case 'start':return $week_start;break;
                case 'end':return $week_end;break;
                default:return ['start' => $week_start, 'end' => $week_end];break;
            }
        }
    }
}




