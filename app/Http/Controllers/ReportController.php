<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App;
use Auth;


class ReportController extends Controller
{
    public function report1($pid)
    {
        $payment = Payment::find($pid);
        $pdf = App::make('dompdf.wrapper');
        $print = "<div style='margin:20px; padding:20px;'>";
        $print .= "<h1 align='center'>Payment Recipt</h1>";
        $print .= "<hr>";
        $print .= "<p> Recipt No : <b>" . $pid . "</b></p>";
        $print .= "<p> Date : <b>" . $payment->paid_date . "</b></p>";
        $print .= "<p> Enrollment No : <b>" . $payment->enrollment->enroll_no . "</b></p>";    
        $print .= "<p> Student Name : <b>" . $payment->enrollment->student->name . "</b></p>";

        $print .= "<hr/>";

        //membuat table
        $print .= "<table style='width:100%'>";

        $print .= "<tr>";
        $print .= "<td>Batch</td>";
        $print .= "<td>Amount</td>";
        $print .= "</tr>";

        $print .= "<tr>";
        $print .= "<td> <h3>" . $payment->enrollment->batch->name . "</h3></td>";
        $print .= "<td> <h3>" . $payment->amount . "</h3></td>";
        $print .= "</tr>";
        
        $print .= "</table>";

        $print .= "<hr/>";

        $print .= "<span> Printed Date : " . date('Y-m-d') . "</span>";

        $print .= "</div>";
        $pdf->loadHTML($print);
        return $pdf->stream();
    }
   

}


?>