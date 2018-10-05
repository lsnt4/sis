<?php 
include_once 'ResourceManager.php';
include_once 'staff-header.php';

if (isset($_POST['submitted'])){

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
			'lostQty' => 0,
			'resStatus' => '1'
		);

		$resMang = new Resource;

		$resMang->setResource($resArray);

		$resMang->resourceAdd();

		if(mysqli_affected_rows(Database::$DB_CONN) >= 0){ 
		set_success_msg('Resource Successfully Added!');
		}else{
			set_error_msg('Error! unable to add resource.');
		}

		header('Location: resources-add.php');
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

	function autofill(){

		document.getElementById('resCategory').value = "Electronic";
		document.getElementById('resSupplier').value = "Samsung Global Electronics (PVT) LTD";
		document.getElementById('resName').value = "Samsung CCTV";
		document.getElementById('resVersion').value = "D12MP Cam";
		document.getElementById('resQty').value = "25";
		document.getElementById('resDesc').value = "Colour = White \nAuto Rotatable Camera with Movement Sensor";
		document.getElementById('resPrice').value = "8500.00";
		document.getElementById('resYear').value = "2018";
		document.getElementById('resMonth').value = "03";
		document.getElementById('resDate').value = "11";
		calculateTotal();


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

 </script>

				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active">Add Resources</a>
							<a href="resources-search.php" class="nav-item nav-link">Search Resources</a>
							<a href="resources-reports.php" class="nav-item nav-link">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="resources-add.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<label class="col-sm-2 col-form-label">
													<?php
														Resource::selectLastRow();
													?>
												</label>
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
													<option value="Furniture">Furnitures</option>
													<option value="Electronic">Electronic</option>
													<option value="Vehicles">Vehicles</option>
													<option value="Property">Property</option>
													<option value="Other">Other</option>
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
												<input id="resSupplier" type="text" class="form-control" name="rSupplier" placeholder="eg: GYG Electronics (PVT) LTD" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input id="resName" type="text" class="form-control" name="rName" placeholder="eg: Damro Wooden Chair" title="Numbers and Special characters are not allowed for the Name Field." onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
											</div>
											<div class="col-md-3">
												<input id="resVersion" type="text" class="form-control" name="rVersion" placeholder="Type/Version ID eg: Wood CH6732" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Quantity</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input id="resQty" type="number" class="form-control" name="rQty" placeholder="# Items" onblur="calculateTotal();" required>
											</div>
										</div>
									</div>
								</div>	
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Additional Information</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<textarea id="resDesc" class="form-control" name="rAdditional_info" rows="5" placeholder=""></textarea>
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
																<option value="<?php print $row['userid'] ?>"><?php print $row['fname']." ".$row['lname'] ?></option>
																
														        
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
												<input id="resPrice" type="number" class="form-control" name="rPrice" placeholder="eg: 250.00" required onblur ="this.value = Number(this.value).toFixed(2); calculateTotal();">
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
												<button name="demo" type="button" class="btn btn-link float-right" onclick="calculateTotal()">Calculate Total</button>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Purchase</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input id="resYear" type="number" class="form-control" name="rDopy" placeholder="Year" required oninput="checkYearLength(this);">
											</div>
											<div class="col-md-2">
												<input id="resMonth" type="number" class="form-control" name="rDopm" placeholder="Month" required oninput="checkMonthLength(this);">
											</div>
											<div class="col-md-2">
												<input id="resDate" type="number" class="form-control" name="rDopd" placeholder="Date" required oninput="checkDateLength(this);">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Status</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-4">
												<label class="col-form-label">Available</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-7">
										<button type="submit" class="btn btn-dark">Add Resource</button>
										<button type="reset" class="btn btn-danger ml-2" onclick="resetTotal();">Reset</button>
										<button name="demo" type="button" class="btn btn-primary float-right" onclick="autofill()">Demo</button>
									</div>
								</div>
								<input type ="hidden" name="submitted" value="1">
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>