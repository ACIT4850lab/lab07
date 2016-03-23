<?php

/**
 * This is a model for a single order, stored in an XML document.
 *
 * @author jim
 */
class Timetable extends CI_Model {

    protected $xml = null;
    protected $id = '';
    
    // Constructor
    public function __construct($filename = null) {
        parent::__construct();
    }

    function getDaysOptions() {
            
        $ddDayOptions = array();

        $record = new stdClass();
        $record->value =  "Monday";
        $ddDayOptions[] = $record;

        $record = new stdClass();
        $record->value =  "Tuesday";
        $ddDayOptions[] = $record;

        $record = new stdClass();
        $record->value =  "Wednesday";
        $ddDayOptions[] = $record;

        $record = new stdClass();
        $record->value =  "Thursday";
        $ddDayOptions[] = $record;

        $record = new stdClass();
        $record->value =  "Friday";
        $ddDayOptions[] = $record;

        return $ddDayOptions;
    }
    
    function getTimeOptions() {

        $ddDayOptions = array();

        $record = new stdClass();
        $record->value =  "830";
        $record->option =  "08:30";
        $ddDayOptions[] = $record;

        $record = new stdClass();
        $record->value =  "930";
        $record->option =  "09:30";
        $ddDayOptions[] = $record;

        $record = new stdClass();
        $record->value =  "1030";
        $record->option =  "10:30";
        $ddDayOptions[] = $record;
        
        $record = new stdClass();
        $record->value =  "1130";
        $record->option =  "11:30";
        $ddDayOptions[] = $record;
        
        $record = new stdClass();
        $record->value =  "1230";
        $record->option =  "12:30";
        $ddDayOptions[] = $record;
        
        $record = new stdClass();
        $record->value =  "1330";
        $record->option =  "13:30";
        $ddDayOptions[] = $record;
        
        $record = new stdClass();
        $record->value =  "1430";
        $record->option =  "14:30";
        $ddDayOptions[] = $record;
        
        $record = new stdClass();
        $record->value =  "1530";
        $record->option =  "15:30";
        $ddDayOptions[] = $record;
        
        $record = new stdClass();
        $record->value =  "1630";
        $record->option =  "16:30";
        $ddDayOptions[] = $record;
        

        return $ddDayOptions;
    }    
    
}
