<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {
        
        function __construct() {
            parent::__construct();
            $this->load->model('course');
            $this->load->model('period');
            $this->load->model('week'); 

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
            $this->data['item_title'] = $course->getId();

            $details = '';
            foreach ($course->getBookings() as $booking)
                $details .= $this->singleBooking($booking);

            // Present this burger
            $this->data['details'] = $details;

            $this->data['pagebody'] = 'justone';
            $this->render();
        }        
        
        function Period($filename) {
            // Build a receipt for the chosen order
            $period = new Period($filename);

            $this->data['filename'] = $filename;
            $this->data['item_title'] = $period->getStart();

            $details = '';
            foreach ($period->getBookings() as $booking)
                $details .= $this->singleBooking($booking);

            // Present this burger
            $this->data['details'] = $details;

            $this->data['pagebody'] = 'justone';
            $this->render();
        }        
        
        function Week($filename) {
            // Build a receipt for the chosen order
            $week = new Week($filename);

            $this->data['filename'] = $filename;
            $this->data['item_title'] = $week->getDay();

            $details = '';
            foreach ($week->getBookings() as $booking)
                $details .= $this->singleBooking($booking);

            // Present this burger
            $this->data['details'] = $details;

            $this->data['pagebody'] = 'justone';
            $this->render();
        }   
        
        // present a receipt for a single burger
        function singleBooking($booking) {
            return $this->parser->parse('abooking', $booking, true);
        }        
        
}
