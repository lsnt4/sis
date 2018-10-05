<?php 
include_once 'ResourceManager.php';
include_once 'staff-header.php'; 
reset_success_msg();

if($_GET){
	$resID = $_GET['resID'];
}elseif($_POST){
	$resID = $_POST['resID'];
}


$resourceLoad = new Resource();
$resourceLoad->loadResource($resID);

$resDate = $resourceLoad->getProperty('dateofp');
$resQty = $resourceLoad->getProperty('resQty');
$lostQty = $resourceLoad->getProperty('lostQty');

list($resYear, $resMonth, $resDate) =explode("-",$resDate);

$availQty = $resourceLoad->getAvailCount($resQty,$lostQty);


if (isset($_POST['submitted'])){

	// var_dump($_POST);
	if(($_POST['rQty']) > ($_POST['lostQty'])){
		$resStatus = 1;
	}else{
		$resStatus = 0;
	}

	$purchaseDate = Resource::getDate($_POST['rDopy'], $_POST['rDopm'],$_POST['rDopd']);
	$resArray = array(

		'resCategory' => $_POST['rCategory'],
		'resSupplier' => $_POST['rSupplier'],
		'resName' => $_POST['rName'],
		'resVersion' => $_POST['rVersion'],
		'resQty' => $_POST['rQty'],
		'resDesc' => $_POST['rAdditional_info'],
		'staffID' => $_POST['staffid'],
		'resPrice' => $_POST['rPrice'],
		'dateofp' => $purchaseDate,
		'resStatus' => $resStatus,
		'lostQty' => $_POST['lostQty'],
);

	$resMang = new Resource;

	$resMang->setResource($resArray);

	$resMang->resourceUpdate($resID);

	if(mysqli_affected_rows(Database::$DB_CONN) >= 0){ 
		set_success_msg('Resource Successfully Updated!');
	}else{
		set_error_msg('Error! unable to update resource.');
	}

	header('Location: resources-edit.php?resID='.$_POST['resID']);
}
//var_dump($_POST);
?>
<!-- <pre>
<?php //var_dump($_POST); ?>	
</pre>
 -->
 <script> 	
	function checkYearLength(elem){

		currentDate = new Date;
		currentYear = currentDate.getFullYear();

	    if (elem.value >= currentYear) {
	        elem.value = currentYear; 
	    }
	}

	function checkMonthLength(elem){

	    if (elem.value >= 12) {
	        elem.value = 12; 
	    }
	}

	function checkDateLength(elem){

	    if (elem.value >= 31) {
	        elem.value = 31; 
	    }
	}

		function calculateTotal(){
		qty = document.getElementById('resQty').value;
		price = document.getElementById('resPrice').value;

		if (qty == 0 || price == 0){
			document.getElementById('totalPrice').innerHTML = "Not Calculated"
		}else{

			total = qty * price;

			document.getElementById('totalPrice').innerHTML = "LKR " + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		}
	}

	function resetTotal(){

		document.getElementById('totalPrice').innerHTML = "Not Calculated"
	}

	function checkLostCount(){

		resQty = parseInt(document.getElementById('resQty').value);
		lostQty = parseInt(document.getElementById('lostQty').value);
		


		if(lostQty < 0){
			document.getElementById('lostQty').value = 0;
			document.getElementById('lostQty').className = "form-control is-invalid";
		}else if(resQty < lostQty){
			console.log(resQty);
			document.getElementById('lostQty').value = resQty;
			document.getElementById('lostQty').className = "form-control is-invalid";
		}else{
			document.getElementById('lostQty').className = "form-control";
		}
	}

	function getAvailableCount(){

		resQty = parseInt(document.getElementById('resQty').value);
		lostQty = parseInt(document.getElementById('lostQty').value);

		remainingQty = resQty - lostQty;

		document.getElementById('availQty').value = remainingQty;
	}



 </script>

				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="resources-add.php" class="nav-item nav-link">Add Resources</a>
							<a href="resources-search.php" class="nav-item nav-link">Search Resources</a>
							<a href="resources-reports.php" class="nav-item nav-link">Reports</a>
							<a class="nav-item nav-link active">Edit Resources</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="resources-edit.php?resID=<?php print $resID?>" enctype="multipart/form-data">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<label class="col-sm-2 col-form-label"><?php 
													if($_GET){
														$resID = $_GET['resID']; print $resID;
													}elseif($_POST){
														$resID = $_POST['resID'];
														print $resID;
													}?>
														
												</label>
												<input type="hidden" name="resID" value="<?php 
													if($_GET){
														$resID = $_GET['resID']; print $resID;
													}elseif($_POST){
														$resID = $_POST['resID'];
														print $resID;
													}?>"
												>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource Category</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<select id="resCategory" name="rCategory" class="form-control">
													<option <?php if ($resourceLoad->getProperty('resCategory') == 'Furniture' ) echo 'selected' ; ?> value="Furniture">Furnitures</option>
													<option <?php if ($resourceLoad->getProperty('resCategory') == 'Electronic' ) echo 'selected' ; ?> value="Electronic">Electronic</option>
													<option <?php if ($resourceLoad->getProperty('resCategory') == 'Vehicles' ) echo 'selected' ; ?> value="Vehicles">Vehicles</option>
													<option <?php if ($resourceLoad->getProperty('resCategory') == 'Property' ) echo 'selected' ; ?> value="Property">Property</option>
													<option <?php if ($resourceLoad->getProperty('resCategory') == 'Other' ) echo 'selected' ; ?> value="Other">Other</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Supplier Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input id="resSupplier" type="text" class="form-control" name="rSupplier" placeholder="eg: GYG Electronics (PVT) LTD" value="<?php echo $resourceLoad->getProperty('resSupplier');?>" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" class="form-control" name="rName" placeholder="eg: Damro Wooden Chair" title="Numbers and Special characters are not allowed for the Name Field." onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123 || event.charcode == 32)" required value="<?php echo $resourceLoad->getProperty('resName');?>">
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="rVersion" placeholder="Type/Version ID eg: Wood CH6732" required value="<?php echo $resourceLoad->getProperty('resVersion');?>">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Quantity</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input id="resQty" type="number" class="form-control" name="rQty" placeholder="# Items" required value="<?php echo $resourceLoad->getProperty('resQty');?>" onblur="calculateTotal()">
											</div>
										</div>
									</div>
								</div>	
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Additional Information</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<textarea class="form-control" name="rAdditional_info" placeholder="" rows="5"><?php echo $resourceLoad->getProperty('resDesc');?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Assign to</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
													<?php 
														$allStaffResult = Resource::getAllStaff();

														if ($allStaffResult->num_rows > 0) { 
													?>
														  <select name="staffid" class="form-control">
													<?php   // output data of each row
														    while($row = $allStaffResult->fetch_assoc()) {
													?>
																<option <?php if ($resourceLoad->getProperty('staffID') == $row['userid'] ) echo 'selected' ; ?> value="<?php print $row['userid'] ?>"><?php print $row['fname'].$row['lname'] ?></option>
																
														        
													<?php   } ?>
														</select>
														<?php
														} else {
														    echo "No Employess Available.";
														}
													?>

												
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Unit Price</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input id="resPrice" type="number" class="form-control" name="rPrice" placeholder="eg: 250.00" required value="<?php echo $resourceLoad->getProperty('resPrice');?>" onblur ="this.value = Number(this.value).toFixed(2); calculateTotal();">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Total Price</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<label id="totalPrice" class="col-form-label">Not Calculated</label>
												<button name="demo" type="button" class="btn btn-link float-right" onclick="calculateTotal();getAvailableCount();">Calculate Total</button>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Purchase</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input type="number" class="form-control" name="rDopy" placeholder="Year" required oninput="checkYearLength(this);" value="<?php echo $resYear;?>">
											</div>
											<div class="col-md-2">
												<input type="number" class="form-control" name="rDopm" placeholder="Month" required oninput="checkMonthLength(this);" value="<?php echo $resMonth;?>">
											</div>
											<div class="col-md-2">
												<input type="number" class="form-control" name="rDopd" placeholder="Date" required oninput="checkDateLength(this);" value="<?php echo $resDate;?>">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Status</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-1">
												<label class="col-sm-2 col-form-label">Available</label>
											</div>
											<div class="col-md-1">	
												<input id="availQty" type="number" class="form-control" name="availableQty" value="<?php echo $availQty;?>" disabled>
											</div>
											<div class="col-md-2 form-check">
												<label id="lostQtyLabel" class="col-lg-12 col-form-label" for="exampleCheck1">Resources Lost/Damaged</label>
											</div>
											<div class="col-md-1">
												<input id="lostQty" type="number" class="form-control" name="lostQty" value="<?php echo $resourceLoad->getProperty('lostQty');?>" oninput="checkLostCount();getAvailableCount();">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-dark">Update Resource</button>
									</div>
								</div>
								<input type ="hidden" name="submitted" value="1">
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>