<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use DB;

class ChartController extends Controller
{
     function getAllYears(){
     	 $year_array= array();
           $enquiries_dates = Enquiry::orderBy( 'created_at', 'ASC' )->pluck( 'created_at' );
        $enquiries_dates= json_decode($enquiries_dates);
        if ( ! empty( $enquiries_dates ) ) {
            foreach ( $enquiries_dates as $unformatted_date ) {
                $date = new \DateTime( $unformatted_date->date );
                $year_no= $date->format('Y');
                $year_name= $date->format('Y');
                $year_array[$year_no]= $year_name;
            }
        }
        return response()->json($year_array);
     }

    function getAllmonthsYearly(){
    	$month_array=array();
        $monthly_enquiry_count_array = array();
        $enquiries_dates = Enquiry::whereYear('created_at', '<=', date('Y'))->get()->groupBy(function($row){
            return $row->created_at->format('Y,M');
        })->toArray();
        if (!empty($enquiries_dates)) {
        	 foreach ( $enquiries_dates as $key=> $unformatted_date ) {
                array_push($month_array, $key);
                array_push($monthly_enquiry_count_array, count($unformatted_date));
            }
            dd($enquiries_dates);
        }
      
        return $month_array;
        
        }
    
     
          function getMonthlyEnquiryData() {
        $monthly_enquiry_count_array = array();
         $month_array = $this->getAllmonthsYearly();
            $month_name_array = array();
        if ( ! empty( $month_array )) {
            foreach ( $month_array as $month_no => $month_name ){
                $monthly_enquiry_count = $this->getAllmonthsYearly( $month_name );
                array_push( $monthly_enquiry_count_array, $monthly_enquiry_count );
                    array_push( $month_name_array, $month_name );
            }
            } 
                  $max_no= max($monthly_enquiry_count_array);
            $max = round(( $max_no + 10/2 ) / 10 ) * 10;
             $monthly_enquiry_count_array= array(
             'months' => $month_name_array, 
         'enquiry_count_data'=>$monthly_enquiry_count_array);

	}
  function yearstodate($years) {

        $now = date("Y");
        $now = explode('-', $now);
        $year = $now[0];
        $converted_year = $year - $years;
        dd($converted_year);
        echo $now = $converted_year;

    

$number_to_subtract = "1";
echo yearstodate($number_to_subtract);
    }   
}

