@extends('layouts.master')
@section ('includes')

<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />




<style type="text/css" class="init">

* { margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 3px; }

#header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
#logo:hover, #logo.edit { border: 0.5px solid #000; margin-top: 0px; max-height: 125px; }
#logoctr { display: none; }
#logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
#logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
#logohelp input { margin-bottom: 5px; }
.edit #logohelp { display: block; }
.edit #save-logo, .edit #cancel-logo { display: inline; }
.edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
#customer-title { font-size: 20px; font-weight: bold; float: left; }



#meta2 { margin-top: 2px; width: 800px; float: left; }
#meta2 td { text-align: left;  }
#meta2 td.meta-head2 { width: 18%; text-align: left; background: #eee; }
#meta2 td textarea { width: 100%; height: 15px; text-align: left; }


#meta1 { margin-top: 2px; width: 400px; float: left; }
#meta1 td { text-align: left;  }
#meta1 td.meta-head1 { width: 36%; text-align: left; background: #eee; }
#meta1 td textarea { width: 100%; height: 15px; text-align: left; }


#meta { margin-top: 2px; width: 380px; float: right; }
#meta td { text-align: left;  }
#meta td.meta-head { width: 25%; text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 15px; text-align: left; }

#meta td.meta-head3 { width: 20%; text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 15px; text-align: left; }


#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 20px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items tr.item-row td { border: 1px solid black;}

#items td.description { width: 400px; }
/*#items td.item-name { width: 175px; }*/
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 0px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

</style>


@stop
@section('content')

	<legend id="hiderow">Generate Lab Report</legend>
	
	
	  
	<div id="page-wrap">

           <table id="meta1">
                <tr>
                    <td class="meta-head1">Invoice #</td>
                    <!-- <td><textarea>000123</textarea></td> -->
                    <td>{{$reportdata[0]->invoice_no}}</td>
                </tr>
            </table>


            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice Date</td>
                    <!-- <td><textarea id="date">December 15, 2009</textarea></td> -->
                    <!-- <td>{{$reportdata[0]->date}}</td> -->
                    <td>{{date('d-mY', strtotime(str_replace('/','-', $reportdata[0]->date)))}}</td>

                    
                </tr>
            </table>

            <table id="meta2">
                <tr>
                    <td class="meta-head2">Patient Name #</td>
                    <td>{{$reportdata[0]->patient_name}}</td>
                </tr>
            </table>

            <table id="meta2">
                <tr>
                    <td class="meta-head2">Consultant by #</td>
                    <td>{{$reportdata[0]->doctor_name}}</td>
                </tr>
            </table>

            <table id="meta1">
                <tr>
                    <td class="meta-head1">Phone No #</td>
                    <td>{{$reportdata[0]->phone}}</td>
                </tr>
            </table>


            <table id="meta">
                <tr>
                    <td class="meta-head">Age</td>
                    <td>27</td>
                    <td class="meta-head3">Gender</td>
                    <td>Islam</td>                    
                </tr>
        	</table>    


		<div style="clear:both"></div>		
		

		<table id="items">
		
		  <tr>
		      <!-- <th>Item</th> -->
		      <th>Description</th>
		      <th>Unit Value</th>
		      <th>Normal Value</th>
		      <th>Remarks</th>
		  </tr>
		  
		@foreach ($reportdata as $report)			
		  <tr class="item-row">
		      <td class="description"><textarea>{{$report->description}}</textarea></td>
		      <td><textarea class="cost">{{$report->unit}}</textarea></td>
		      <td><textarea class="qty">{{$report->normal_value}}</textarea></td>
		      <td><textarea class="qty" placeholder="Remarks.."></textarea></td>
		  </tr>
		@endforeach  
<!-- 		  <tr id="hiderow">
		    <td colspan="4"><a id="addrow" href="javascript:;" title="Add a row"></a></td>
		  </tr> -->
		  
		</table>
		
		<!-- <h5></h5>		 -->
       
        <table id="meta1">
            <tr>
                <!-- <td class="meta-head1">Invoice #</td> -->
                <td>000123</td>
            </tr>
        </table>


        <table id="meta">
            <tr>
                <!-- <td class="meta-head">Date</td> -->
                <td>December 15, 2009</td>
            </tr>
        </table>

		<div id="terms">
		  <h5></h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>



@stop