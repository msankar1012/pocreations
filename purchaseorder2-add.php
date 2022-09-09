<?php
include("session.php");
include("config/config.php");

$salesrep = ucfirst($_SESSION['userid']);

/*** CUSTOM PURCHASE ORDER CREATION *****/

/* Form submission sql query */

if(isset($_POST['submit'])){
   include("query/purchase2_query.php");
}

/* Includes JS and CSS files */

 include ("includes/header-top.php"); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Main Header -->
<?php include ("includes/header.php"); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <?php include ("includes/profileleft.php");?>

      <!-- Sidebar Menu -->
       <?php include ("includes/sidemenu.php"); ?>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>Purchase Order Custom</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="purchaseorder2-list.php">Purchase Order</a></li>
        <li class="active">New Purchase Order</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">		
		<form class="form-list" method="post" name="po_entry" id="po_entry" autocomplete="off">
		<div class="box">
		<p>&nbsp;</p>		
		<div class="box-body no-padding margin-t-10"> 
		  <div class="col-md-5">		   
			  	<div class="col-md-4">			
				  <label>Supplier Name <span class="icon-asterisk"> *</span></label>
				</div>
				<div class="col-md-8">
					<select class="form-control select-custom" name="supplier_id" id= "supplier_id">
					  <option value="">None</option>
						<?php
						$sqlsupplier = mysqli_query($link, "SELECT * FROM suppliermaster WHERE AUTHORIZEDSTATUS = 1 and AVAILABILITYSTATUS = 1 ORDER BY SUPPLIERNAME ASC");						
						while($fetch_supp = mysqli_fetch_array($sqlsupplier)) { ?>
						<option value="<?php echo $fetch_supp["SUPPLIERNUMBER"]; ?>" ><?php echo $fetch_supp["SUPPLIERNAME"]; ?></option>
					   <?php } ?>
					</select>				
			  </div>
		  </div> 
		  <div class="col-md-1"> 
			  <a href="purchaseorder-list.php" class="btn btn-primary submit_button">BACK</a>
          </div> 
          <div class="col-md-6 pull-right">
			<div class="price-info">
			  <div class="aside">
				<p>QTY </p>
				<div class="price-box subtotalqtycls" id="qty_rm">0.00</div>
				<input type="hidden" name="totalqty" id="totalqty" class="form-control subtotalqtycls">
			  </div>
			  <div class="aside">
				<p>TOTAL $ </p>
				<div class="price-box subtotalpricecls" id="tol_rm">0.00</div>
				<input type="hidden" name="totalprice" id="totalprice" class="form-control subtotalpricecls">
			  </div>
			</div>
		 </div>
	    </div>	
		<p>&nbsp;</p>		
		</div>	
		<div class="box"> 
		<div class="box-body no-padding margin-t-10">
		 <div class="col-md-12">          		  
		 <div id="div-supplier">
            <!-- /.box-header -->
            <div class="col-md-12 no-padding" style="margin-top:5px; margin-bottom:20px; ">		 
			<div class="col-md-6 no-padding"> 
            <div class="form-group"> 
			    <span style="float:left; width:120px; line-height:40px;">
				  <label>Order Date <span class="icon-asterisk"> *</span></label>
				</span>
				<span style="float:left; width:350px;height:40px;"> 
				  <input type="text" class="form-control" name="orderdate" id="datepicker" value="<?php echo date('d-m-Y'); ?>" >
				</span> 
            </div>
			</div> 
			<div class="col-md-6 no-padding"> 
            <div class="form-group"> 
			    <span style="float:left; width:120px;line-height:40px;">
				  <label>Remarks </label>
				</span>
				<span style="float:left; width:350px;height:40px;"> 
				<input type="text" class="form-control" name="remarks1" id="remarks1" onkeydown="upperCaseF(this)">
				</span> 
            </div>
			</div>
			<div class="col-md-6 no-padding"> 
            <div class="form-group"> 
			    <span style="float:left; width:120px;line-height:40px;">
				   <label>Ship To <span class="icon-asterisk"> *</span></label>
				</span>
				<span style="float:left; width:350px;height:40px;"> 
					<select class="form-control select-custom" name="shipto" id= "shipto">
					  <option value="">None</option>
						<?php
						$sqlshipto = mysqli_query($link, "SELECT * FROM shiptodetails WHERE AUTHORIZEDSTATUS = 1 and AVAILABILITYSTATUS = 1 ");				
						while($fetch_shipto = mysqli_fetch_array($sqlshipto)){ ?>
					  <option value="<?php echo $fetch_shipto["SHIPTONO"]; ?>" ><?php echo $fetch_shipto["SHIPTO"]; ?></option>
					   <?php } ?>
					</select>
				</span> 
            </div>
			</div> 
			<div class="col-md-6 no-padding"> 
            <div class="form-group"> 
			   <span style="float:left; width:120px;line-height:40px;">
				  <label> Remarks 2</label>
				</span>
				<span style="float:left; width:350px;height:40px;"> 
				<input type="text" class="form-control" name="remarks2" id="remarks2" onkeydown="upperCaseF(this)">
				</span> 
            </div>
			</div>
			<div class="col-md-6 no-padding"> 
            <div class="form-group"> 
			   <span style="float:left; width:120px;line-height:40px;">
				  <label>Ship When <span class="icon-asterisk"> *</span></label>
				</span>
				<span style="float:left; width:350px;height:40px;"> 
				<input type="text" class="form-control" name="shipwhen" id="shipwhen" >
				</span> 
            </div>
			</div>  
			<div class="col-md-6 no-padding"> 
            <div class="form-group"> 
			    <span style="float:left; width:120px;line-height:40px;">
				  <label>Expected Date <span class="icon-asterisk"> *</span></label>
				</span>
				<span style="float:left; width:350px;height:40px;"> 
				  <input type="text" class="form-control" name="expecteddate" id="datepicker2" required >
				</span> 
            </div>
			</div>
			</div>			
		</div>        
	    </div>
		</div>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body"> 
			<div class="col-md-12" id="div-missproforma">
			<div class="table-responsive">
			    <table id="autocomplete_table" class="table table-hover autocomplete_table table-large table-bordered">
					<thead class="thead-light">
						<tr>
							<th scope="col">#</th>
							<th style='width:35%;'>Description</th>							
							<th scope="col">Unit/Size</th>
							<th style='width:8%;'>Qty</th>
							<th scope="col">Price</th>
							<th scope="col">Product #</th>							
							<th style='width:10%;'>Subtotal</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr id="row_1">
							<th id="delete_1" scope="row" class="delete_row"><button class="btn btn-danger">-</button></th>
							<td>
							  <input type="text" data-type="description" name="description[]" id="description_1" class="form-control autocomplete_txt" autocomplete="off" required>
							</td>							
							<td>
								<input type="text" data-type="unitsize" name="unitsize[]" id="unitsize_1" class="form-control autocomplete_txt" autocomplete="off" readonly>
							</td>
							<td><input type="text" data-type="qty" name="qty[]" id="qty_1" class="form-control priceqty" onkeyup="basicqty(this);" required="required" onKeyPress="return isNumber(event)"> </td>
							<td>
								<input type="text" data-type="unitprice" name="unitprice[]" id="unitprice_1" class="form-control" autocomplete="off" required onkeyup="basicqty(this);" onKeyPress="return isNumber(event)">
							</td>
							<td>
								<input type="text" data-type="productno" name="productno[]" id="productno_1" class="form-control autocomplete_txt" autocomplete="off"  readonly> 
							</td> 
							<td><input data-type="subtotalprice" name="subtotalprice[]" id="subtotalprice_1" type="text" size="10%" class="form-control price_select autocomplete_txt" onBlur="basicpricetotal();" readonly="readonly" /></td>
							<td><button class="btn btn-success" id="addNew_1">+</button></td>
						</tr>
					</tbody>
				</table>
			</div> 
			</div>
            <div class="col-md-12">
               <div class="col-md-6">
				<a href="purchaseorder2-list.php" class="btn btn-primary submit_button pull-right" >BACK</a>
				</div>
				<div class="col-md-6">
                <input type="submit" class="btn btn-primary submit_button pull-left" value="SAVE" name="submit" id="submit">
               </div>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
		 </form>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <?php include('includes/footer.php'); ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/js/app.min.js"></script>

<script src="plugins/js/demo.js"></script>
<script src="assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script src="assets/js/application.js"></script>


<!-- Product selection funcitons SCRIPTS -->

<script type="text/javascript"> 
var multiple=[
<?php
$Select_prod = mysqli_query($link, "SELECT PRODUCTNUMBER,PRODUCTNAME,UNITANDSIZE, RUNNINGCOST FROM productmaster WHERE AVAILABILITYSTATUS =1 AND AUTHORIZEDSTATUS = 1");

while( $Fetch_prod  = mysqli_fetch_array($Select_prod))	{
	echo "'".trim(addcslashes($Fetch_prod['PRODUCTNAME'], "'")).'|'.$Fetch_prod['UNITANDSIZE'].'|'.(number_format(($Fetch_prod['RUNNINGCOST']),2)).'|'.$Fetch_prod['PRODUCTNUMBER'].'|'."'".',' ;
 } ?>],SmartMultiFiled=function(){var A,N,I,E;function R(){var A,N,I;if(A=$(this).data("type"),N=function(A){var N;switch(A){case"description":N=0;break;case"unitsize":N=1;break;case"unitprice":N=2;break;case"productno":N=3;break;}return N}(A),I=$(this),void 0===N)return!1;$(this).autocomplete({source:function(A,I){var E=$.map(multiple,function(A){var I=A.split("|");return{label:I[N],value:I[N],data:A}});A.term,I($.ui.autocomplete.filter(E,A.term))},autoFocus:!0,minLength:1,select:function(A,N){var E,R;R=S(I),E=N.item.data.split("|"),$("#description_"+R).val(E[0]),$("#unitsize_"+R).val(E[1]),$("#unitprice_"+R).val(E[2]),$("#productno_"+R).val(E[3])}})}function S(A){var N;return(N=A.attr("id").split("_"))[N.length-1]}function L(){E.append((N='<tr id="row_'+A+'">',N+='<th id="delete_'+A+'" scope="row" class="delete_row"><button class="btn btn-danger">-</button></th>',N+="<td>",N+='<input type="text" data-type="description" name="description[]" id="description_'+A+'" class="form-control autocomplete_txt" autocomplete="off" required>',N+="</td>",N+="</td>",N+="<td>",N+='<input type="text" data-type="unitsize" name="unitsize[]" id="unitsize_'+A+'" class="form-control autocomplete_txt" autocomplete="off" required readonly>',N+="<td>",N+='<input type="text" data-type="qty" name="qty[]" id="qty_'+A+'" class="form-control autocomplete_txt priceqty" onkeyup="basicqty(this);" autocomplete="off" required onKeyPress="return isNumber(event)">',N+="</td>",N+="<td>",N+='<input type="text" data-type="unitprice" name="unitprice[]" id="unitprice_'+A+'" class="form-control" onkeyup="basicqty(this);" autocomplete="off" required onKeyPress="return isNumber(event)">',N+="</td>",N+="<td>",N+='<input type="text" data-type="productno" name="productno[]" id="productno_'+A+'" class="form-control autocomplete_txt" autocomplete="off" readonly >',N+="</td>",N+="<td>",N+='<input type="text" data-type="subtotalprice" name="subtotalprice[]" id="subtotalprice_'+A+'" class="form-control price_select autocomplete_txt" autocomplete="off" required onBlur="basicpricetotal();" readonly="readonly">',N+="</td>",N+="<td>",N+='&nbsp;',N+="</td>",A++,N+="</tr>"))}
 function O(){var A;A=S($(this)),$("#row_"+A).remove()}return I=$('#addNew_1'),A=$("#autocomplete_table tbody tr").length+1,E=$("#autocomplete_table tbody"),{init:function(){I.on("click",L),$(document).on("click",".delete_row",O),$(document).on("focus",".autocomplete_txt",R)}}}();$(document).ready(function(){SmartMultiFiled.init()});	

function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}

$(document).keypress(function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});
 
function basictotal(){
	
	var total = 0;
	$('.price_select').each(function() {
		total += parseFloat($(this).val(), 10) || 0;
	});
	
	var qty = 0;
	$('.priceqty').each(function() {
		qty += parseFloat($(this).val(), 10) || 0;
	});	 

	$('.subtotalqty').val(parseFloat(qty).toFixed(2));
	$('.subtotalpricecls').val(parseFloat(total).toFixed(2));
	$('.subtotalqtycls').val(parseFloat(qty).toFixed(2));
	
}

 // PO item price calculation;

function basicqty(){
	
	$('.priceqty').each(function() {			
	
		var subid = $(this).attr('id');
		//alert(subid);
		var newid = subid.replace(/qty_/i, '');
		var orderqty = $('#qty_'+newid+'').val();
		var unitp = $('#unitprice_'+newid+'').val();
		
		if(orderqty==0){
			$('#subtotalprice_'+newid+'').val('0');
			var total = 0;
			$('.price_select').each(function() {
				total += parseFloat($(this).val(), 10) || 0;
			});
			
			var qty = 0;
			$('.priceqty').each(function() {
				qty += parseFloat($(this).val(), 10) || 0;
			}); 
			 $('.subtotalqty').val(parseFloat(qty).toFixed(2));
			 $('.subtotalpricecls').val(parseFloat(total).toFixed(2));
			 $('.subtotalpricecls').html(parseFloat(total).toFixed(2));
			 $('.subtotalqtycls').val(parseFloat(qty).toFixed(2));
			 $('.subtotalqtycls').html(parseFloat(total).toFixed(2));
		}else{
			//alert(orderqty);			
			var total = parseFloat(orderqty)*parseFloat(unitp);
			//alert(total);
			$('#subtotalprice_'+newid+'').val(parseFloat(total).toFixed(2));
			var total = 0;
			$('.price_select').each(function() {
				total += parseFloat($(this).val(), 10) || 0;
			});
			
			var qty = 0;
			$('.priceqty').each(function() {
				qty += parseFloat($(this).val(), 10) || 0;
			});
			
			//alert(total); subtotalqty
			
			 $('.subtotalqty').val(parseFloat(qty).toFixed(2));
			 $('.subtotalpricecls').val(parseFloat(total).toFixed(2));
			 $('.subtotalpricecls').html(parseFloat(total).toFixed(2));
			 $('.subtotalqtycls').html(parseFloat(qty).toFixed(2));
			 $('.subtotalqtycls').val(parseFloat(qty).toFixed(2));
		}
	});	
}

function basictotal(){
	
	var total = 0;
	$('.price_select').each(function() {
		total += parseFloat($(this).val(), 10) || 0;
	});
	
	var qty = 0;
	$('.priceqty').each(function() {
		qty += parseFloat($(this).val(), 10) || 0;
	});
	
	//alert(total); subtotalqty 
	 $('.subtotalqty').val(parseFloat(qty).toFixed(2));
	 $('.subtotalpricecls').val(parseFloat(total).toFixed(2));
	 $('.subtotalpricecls').html(parseFloat(total).toFixed(2));
	 $('.subtotalqtycls').val(parseFloat(qty).toFixed(2));
	 $('.subtotalqtycls').html(parseFloat(qty).toFixed(2));
}
  
//validation and submit handling
 
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 45 || charCode > 57)) {
        return false;
    }
    return true;
}

jQuery(function(){ 

var currentDate = new Date();

jQuery('#datepicker').datepicker({
	  dateFormat: 'd-m-yy', 
	  autoclose:true,
      endDate: "currentDate",
      maxDate: currentDate
      }).on('changeDate', function (ev) {
         $(this).datepicker('hide');
});


jQuery('#datepicker2').datepicker({
	  dateFormat: 'd-m-yy', 
	  autoclose:true,      
      minDate: 0
      }).on('changeDate', function (ev) {
         $(this).datepicker('hide');
});

});


/* Validation PO form */

jQuery(function(){  
jQuery('#submit').click(function(){  
	  
	var supplier_id   = $('#supplier_id').val();
	var shipto 	      = $('#shipto').val();
	var expecteddate  = $('#expecteddate').val();
	var shipwhen      = $('#shipwhen').val();
	var description_1 = $('#description_1').val();
	var qty_1         = $('#qty_1').val();
	var unitprice_1   = $('#unitprice_1').val();

	if(supplier_id ==""){
		$('#supplier_id').css({"border-color": "#ff0000", "border-width":"2px", "border-style":"solid"});
	}else{
	 $('#supplier_id').css({"border-color": "#d2d6de", "border-width":"1px", "border-style":"solid"});
	} 

	if(shipto ==""){
		$('#shipto').css({"border-color": "#ff0000", "border-width":"2px", "border-style":"solid"});			 
	}else{
		$('#shipto').css({"border-color": "#d2d6de", "border-width":"1px", "border-style":"solid"});
	} 	

	if(expecteddate ==""){
		$('#expecteddate').css({"border-color": "#ff0000", "border-width":"2px", "border-style":"solid"});			 
	}else{
		$('#expecteddate').css({"border-color": "#d2d6de", "border-width":"1px", "border-style":"solid"});
	} 	

	if(shipwhen ==""){
		$('#shipwhen').css({"border-color": "#ff0000", "border-width":"2px", "border-style":"solid"});
		 
	}else{
		$('#shipwhen').css({"border-color": "#d2d6de", "border-width":"1px", "border-style":"solid"});
	} 

	if(description_1 ==""){
		$('#description_1').css({"border-color": "#ff0000", "border-width":"2px", "border-style":"solid"});
		 
	}else{
		$('#description_1').css({"border-color": "#d2d6de", "border-width":"1px", "border-style":"solid"});
	} 

	if(qty_1 ==""){
		$('#qty_1').css({"border-color": "#ff0000", "border-width":"2px", "border-style":"solid"});
		 
	}else{
		$('#qty_1').css({"border-color": "#d2d6de", "border-width":"1px", "border-style":"solid"});
	} 

	if(unitprice_1 ==""){
		$('#unitprice_1').css({"border-color": "#ff0000", "border-width":"2px", "border-style":"solid"});
		 
	}else{
		$('#unitprice_1').css({"border-color": "#d2d6de", "border-width":"1px", "border-style":"solid"});
	} 

	if(supplier_id!='' && shipto!='' && expecteddate!='' && shipwhen!='' && description_1!='' && qty_1!='' && unitprice_1!='' ){
		return true;
	}

	return false;
}); 
});
</script> 
</body>
</html>