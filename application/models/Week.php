<?php

/**
 * This is a model for a single order, stored in an XML document.
 *
 * @author jim
 */
class Week extends CI_Model {

    protected $xml = null;
    protected $day = '';
    protected $bookings = array();

    // Constructor
    public function __construct($filename = null) {
        parent::__construct();
        if ($filename == null)
            return;

        $this->xml = simplexml_load_file(DATAPATH . $filename . XMLSUFFIX);

        // extract basics
        $this->day = (string)$this->xml['day'];

        foreach ($this->xml->booking as $one) {
            $this->bookings[] = $this->makeBooking($one);
        }
    }

    // build a booking object from the simpleXML
    // use the DTD as a guide ... (patty, cheeses?, topping*, sauce*, instructions?, name?)
    function makeBooking($element) {
        $record = new stdClass();
        
        $record->type =  (string) $element['type'];
        $record->day = (string) $this->day;
        $record->name = (string) $element->name;
        $record->instructor = (string) $element->instructor;
        $record->room = (string) $element->room;
        $record->start = (string) $element->period['start'];
        $record->end = (string) $element->period['end'];
  
        return $record;
    }

    // return the customer name
    function getDay() {
        return $this->day;
    }

    // return the array of burgers in this order
    function getBookings() {
        return $this->bookings;
    }

}
