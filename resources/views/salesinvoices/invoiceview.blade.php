@extends('layouts.master')
@section ('includes')


<!-- <link rel='stylesheet' type='text/css' href='css/print.css' media="print" /> -->

<style type="text/css" class="init">

* { margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 3px; }

#header { height: 30px; width: 100%; margin: 10px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

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


#items { clear: both; width: 100%; margin: 10px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 20px;}
#items tr.item-row td { border: 0; vertical-align: top; }
#items tr.item-row td { border: 1px solid black;}

#items td.description { width: 75%; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 210px; background: none;}
#items td.balance { background: #eee; }
#items td.blank { border: 0; }


#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 0px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

</style>


@stop
@section('content')


	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
            <table id="meta1">
                <tr>
                    <td class="meta-head1">Invoice #</td>
                    <td>{{$data[0]->invoice_no}}</td>
                </tr>
            </table>


            <table id="meta">
                <tr>
                    <td class="meta-head">Date</td>
                    <td>{{$data[0]->date}}</td>
                </tr>
            </table>

            <table id="meta2">
                <tr>
                    <td class="meta-head2">Patient Name #</td>
                    <!-- <td><textarea>000123</textarea></td> -->
                    <td>{{$data[0]->patient_name}}</td>
                </tr>
            </table>

            <table id="meta2">
                <tr>
                    <td class="meta-head2">Consultant by #</td>
                    <td>{{$data[0]->doctor_name}}</td>
                </tr>
            </table>

            <table id="meta1">
                <tr>
                    <!-- <td class="meta-head1">Phone No #</td> -->
                    <td class="meta-head1">Address #</td>
                    <td>{{$data[0]->address}}</td>
                </tr>
            </table>


            <table id="meta">
                <tr>
                    <td class="meta-head">Age</td>
                    <td>{{$data[0]->age}}</td>
                    <td class="meta-head3">Gender</td>
                    <td>{{$data[0]->gender}}</td>
                </tr>
            </table>

		<div style="clear:both"></div>		


		<table id="items">


		
		  <tr>
		      <th>Description</th>
		      <th style="text-align: right;">Total Amount</th>
		  </tr>
		  <?php $subtotalamt = 0 ;?>
		  @foreach ($data as $key)
			  <tr class="item-row">
			      <td class="description">{{$key->investigation_name}}</td>
			      <td style="text-align: right;">{{$key->price}}</td>
			  </tr>
			  <?php $subtotalamt = $subtotalamt+$key->price; ?>
			  
		  @endforeach  

		  
		  <tr>
		      <td style="text-align: right; font-weight: bold; border: 0px solid black;">Subtotal :</td>
		      <td style="text-align: right; font-weight: bold; border: 1px solid black;"><div id="subtotal">{{$subtotalamt;}}</div></td>
		  </tr>
		  <tr>
		      <td style="text-align: right; font-weight: bold; border: 0px solid black;">Less Amount :</td>
		      <td style="text-align: right; font-weight: bold; border: 1px solid black;"><div id="subtotal">{{$data[0]->discountamount}}</div></td>
		  </tr>
		  <tr>
		      <td style="text-align: right; font-weight: bold; border: 0px solid black;">Grand Total :</td>
		      <td style="text-align: right; font-weight: bold; border: 1px solid black;"><div id="subtotal"></div>{{$subtotalamt-$data[0]->discountamount}}</td>
		  </tr>		  
		  <tr>
		      <td style="text-align: right; font-weight: bold; border: 0px solid black;">Advance Amount :</td>
		      <td style="text-align: right; font-weight: bold; border: 1px solid black;"><div id="subtotal">{{$data[0]->advanceamount}}</div></td>
		  </tr>

		  <tr>
		      <td style="text-align: right; font-weight: bold; border: 0px solid black;">Due Amount :</td>
		      <td style="text-align: right; font-weight: bold; border: 1px solid black;"><div id="subtotal">{{$data[0]->due}}</div></td>
		  </tr>

	
		</table>
		
		<div id="terms">
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>


@stop