<?php

/**
 * This is a model for a single order, stored in an XML document.
 *
 * @author jim
 */
class Period extends CI_Model {

    protected $xml = null;
    protected $start = '';
    protected $end = '';
    protected $bookings = array();

    // Constructor
    public function __construct($filename = null) {
        parent::__construct();
        if ($filename == null)
            return;

        $this->xml = simplexml_load_file(DATAPATH . $filename . XMLSUFFIX);

        // extract basics
        $this->start = (string) $this->xml['start'];
        $this->end = (string) $this->xml['end'];

        foreach ($this->xml->booking as $one) {
            $this->bookings[] = $this->makeBooking($one);
        }
    }

    // build a booking object from the simpleXML
    // use the DTD as a guide ... (patty, cheeses?, topping*, sauce*, instructions?, name?)
    function makeBooking($element) {
        $record = new stdClass();
        
        $record->type =  (string) $element['type'];
        $record->day = (string) $element['day'];
        $record->name = (string) $element->name;
        $record->instructor = (string) $element->instructor;
        $record->room = (string) $element->room;
        $record->start = $this->start;
        $record->end = $this->end;
  
        return $record;
    }

    // return the customer name
    function getStart() {
        return $this->start;
    }

    // return the customer name
    function getEnd() {
        return $this->start;
    }    

    // return the array of burgers in this order
    function getBookings() {
        return $this->bookings;
    }

}
