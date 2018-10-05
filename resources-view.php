<?php 
require 'ResourceManager.php';
include_once 'staff-header.php';

if($_GET){
	$resID = $_GET['resID'];
}elseif($_POST){
	$resID = $_POST['resID'];
}

$resourceLoad = new Resource();
$resourceLoad->loadResource($resID);
$resDate = $resourceLoad->getProperty('dateofp');

$totalQty=$resourceLoad->getProperty('resQty');
$lostQty=$resourceLoad->getProperty('lostQty');
$availableQty = $totalQty - $lostQty;

$resStatus = $resourceLoad->getProperty('resStatus');

$staffID = $resourceLoad->getProperty('staffID');
$staffNameResult = Resource::getStaff($staffID);
if ($staffNameResult->num_rows > 0) {
	while($row = $staffNameResult->fetch_assoc()) {
		$staffName = $row['fname']." ".$row['lname'];
	}
}else{
	echo "Not assigned to any individual.";
}
//var_dump($_POST);
?>
<!-- <pre>
<?php //var_dump($_POST); ?>	
</pre>
 -->
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="resources-add.php" class="nav-item nav-link">Add Resources</a>
							<a href="resources-search.php" class="nav-item nav-link">Search Resources</a>
							<a href="resources-reports.php" class="nav-item nav-link">Reports</a>
							<a href="resources-search.php" class="nav-item nav-link active">View Resource</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
								<div class="jumbotron">
									<h1 class="display-4" name="rName"><?php echo $resourceLoad->getProperty('resName')." ".$resourceLoad->getProperty('resVersion');?></h1>
									<p class="lead">
										<?php if ($resStatus == 1){

										?>
								    		<span class="badge-success btn-lg">Available<span class="badge badge-light ml-3"><?php echo $availableQty;?></span></span>
								    	<?php ;}else{
								    	?>
								    		<span class="badge-danger btn-lg">Unavailable</span>
								    	<?php ;}?>
								  	</p>
								  	<p class="lead">
								  		<strong>Lost/Damaged Quantity : </strong><?php echo $lostQty;?></br>
								  		<strong>Category : </strong><?php echo $resourceLoad->getProperty('resCategory');?></br>
								  		<strong>Assigned to : </strong><?php echo $staffName;?></p>
								  	<hr class="my-4">
								 	 <p><strong>Additional Description</strong></br>
								 	 	<?php echo $resourceLoad->getProperty('resDesc');?></p>
								 	 	<strong>Supplier</strong></br>
								 	 	<?php echo $resourceLoad->getProperty('resSupplier');?></p>
								 	 	<strong>Date of Purchase</strong></br>
								 	 	<?php echo $resDate;?></br></br>
								 	 	<strong>Unit Price</strong></br>
								 	 	LKR  <?php echo $resourceLoad->getProperty('resPrice');?></p></br>
								  	<p class="lead">
								    	<a class="btn btn-outline-dark btn-lg" href="resources-edit.php?resID=<?php print $_GET["resID"]?>" role="button">Edit Resource</a>
								  	</p>
								</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>