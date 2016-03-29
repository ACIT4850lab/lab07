<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {
        
    
        public $timetable = null;
    
        function __construct() {
            parent::__construct();
            $this->load->model('course');
            $this->load->model('period');
            $this->load->model('week'); 
            $this->load->model('timetable'); 
            
            $this->timetable = new Timetable();
        }

        //-------------------------------------------------------------
        //  Homepage: show a list of facets on files
        //-------------------------------------------------------------
	public function index()
	{
            // Only putting html tags here because it's a hypotethical use
            $validation = "Schema Validation<br />";
            
            // Build a list of orders
            $this->load->helper('directory');
            $candidates = directory_map(DATAPATH);
            sort($candidates);
            foreach ($candidates as $file) {
                if (substr_compare($file, XMLSUFFIX, strlen($file) - strlen(XMLSUFFIX), strlen(XMLSUFFIX)) === 0)
                    // exclude our menu
                    if ($file != 'timetable.xsd' )
                    {
                        // trim the suffix
                        $bookings[] = array('filename' => substr($file, 0, -4));
                        $validation.=$this->validate(DATAPATH . $file);
                    }
            }
            $this->data['bookings'] = $bookings;
            $this->data['ddDayOptions'] = $this->timetable->getDaysOptions();
            $this->data['ddTimeOptions'] = $this->timetable->getTimeOptions();
            $this->data['xmlValidation'] = $validation;
            
            // Present the list to choose from
            $this->data['pagebody'] = 'homepage';
            $this->render();
	}
        
        public function validate($fileName)
        {
            $result ='';
            $doc = new DOMDocument();
            $doc->load($fileName);
            $result .= $fileName;
            libxml_use_internal_errors(true);
            if ($doc->schemaValidate(DATAPATH.'timetable.xsd'))
             return '<br />'.$fileName.' : Validated against schema successfully';
            else {
             $result .= "<b>Oh nooooo...</b><br/>";
             foreach (libxml_get_errors() as $error) {
             $result .= $error->message . '<br/>';
             }
            }
            
            return $result;
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
        
        function Search() {
            
            // Build a receipt for the chosen order
            $details_course = '';
            $course = new Course("Course");
            foreach ($course->getBookings() as $booking){
                
                if ($booking->start == $_POST['ddTime'] && $booking->day == $_POST['ddDay'])
                {
                    $details_course .= $this->singleBooking($booking);
                }
            }
            
            $details_period='';
            $period = new Period("Period");
            foreach ($period->getBookings() as $booking){
                
                if ($booking->start == $_POST['ddTime'] && $booking->day == $_POST['ddDay'])
                {
                    $details_period .= $this->singleBooking($booking);
                }
            } 
            
            $details_week = '';
            $week = new Week("Week");
            foreach ($week->getBookings() as $booking){
                
                if ($booking->start == $_POST['ddTime'] && $booking->day == $_POST['ddDay'])
                {
                    $details_week .= $this->singleBooking($booking);
                }
            }                

            // Present this burger
            $this->data['details_course'] = $details_course;
            $this->data['details_period'] = $details_period;
            $this->data['details_week'] = $details_week;
            
            $this->data['ddDay'] = $_POST['ddDay'];
            $this->data['ddTime'] = $_POST['ddTime'];
            
            $this->data['pagebody'] = 'search';
            $this->render();
        }        
        
        
        // present a receipt for a single burger
        function singleBooking($booking) {
            return $this->parser->parse('abooking', $booking, true);
        } 
}
