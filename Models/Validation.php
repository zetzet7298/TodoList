<?php

namespace TodoList\Models;

class Validation
{
    function checkNull($field){
        // Clean content
        $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
        if(!empty($field)){
            return $field;
        } else{
            return FALSE;
        }
    }

    function checkMaxLength($field, $length){
        // Clean content
        $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
        if(!empty($field) && strlen($field) <= $length){
            return $field;
        } else{
            return FALSE;
        }
    }

    public function checkDateFromAndDateTo($dateFrom, $dateTo){
        if(!empty($dateFrom) && !empty($dateTo) && ($dateTo > $dateFrom)){
            return $dateTo;
        } else{
            return FALSE;
        }
    }
}