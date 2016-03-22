<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {
        
        function __construct() {
            parent::__construct();
            $this->load->model('course');

        }

        //-------------------------------------------------------------
        //  Homepage: show a list of facets on files
        //-------------------------------------------------------------
	public function index()
	{
            // Build a list of orders
            $this->load->helper('directory');
            $candidates = directory_map(DATAPATH);
            sort($candidates);
            foreach ($candidates as $file) {
                if (substr_compare($file, XMLSUFFIX, strlen($file) - strlen(XMLSUFFIX), strlen(XMLSUFFIX)) === 0)
                    // exclude our menu
                    if ($file != 'master.xml')
                        // trim the suffix
                        $bookings[] = array('filename' => substr($file, 0, -4));
            }
            $this->data['bookings'] = $bookings;

            // Present the list to choose from
            $this->data['pagebody'] = 'homepage';
            $this->render();
	}
        
        function Course($filename) {
            // Build a receipt for the chosen order
            $course = new Course($filename);

            $this->data['filename'] = $filename;
            $this->data['id'] = $course->getId();


            $details = '';
            foreach ($course->getBookings() as $booking)
                $details .= $this->singleBooking($booking);

            // Present this burger
            $this->data['details'] = $details;

            $this->data['pagebody'] = 'justone';
            $this->render();
        }        
        
        
        // present a receipt for a single burger
        function singleBooking($booking) {
            /*
        $record->type = (string) $element->xml['type'];
        $record->day = (string) $element->xml['day'];
        $record->name = (string) $element->name;
        $record->instructor = (string) $element->instructor;
        $record->room = (string) $element->room;
        $record->start = (string) $element->period['start'];
        $record->end = (string) $element->period['end'];
        */
            $parms['name'] = (isset($booking->name)) ? $booking->name : 'qwe';
            $parms['instructor'] = (isset($booking->instructions)) ? '** instructor ** ' . $booking->instructor : '';



            return $this->parser->parse('abooking', $parms, true);
        }        
        
}
