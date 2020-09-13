<?php

namespace App\Helpers;

class CommonHelpers{
    
    public static function getArabicMonthsArray(){
        return [
            "كانون الثاني",
            "شباط",
            "آذار",
            "نيسان",
            "أيار",
            "حزيران",
            "تموز",
            "آب",
            "أيلول",
            "تشرين الأول",
            "تشرين الثاني",
            "كانون الأول",
        ];
    }


    public static function getGenders(){
        return [
            'male', 
            'female',
            'other'
        ];
    }

}