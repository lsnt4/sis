<?php
include_once 'staff-header.php';
include "DB_Connection.php"; 

	if(isset($_POST["add"])){
		$userid = $_POST["user_id"];
		$vacation = $_POST["vacation"];
		$casual = $_POST["casual"];
		$sick = $_POST["sick"];
		$added_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$added_date = date("Y-m-d h:i:s",time());
		
		$sql="insert into leaves (userid,casual,vacation,sick,added_by,added_date) values ('$userid','$casual','$vacation','$sick','$added_by','$added_date')";
							if($conn->query($sql) == true){
									set_success_msg("<strong>Success!</strong> ".$userid."'s leaves has been successfully inserted!");
									header("Location: Finance_Add_Leaves.php");
							}else{
									set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  	header("Location: Finance_Add_Leaves.php");
			
							}
	}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Leave_Dashboard.php" class="nav-item nav-link"><strong> Leave Overview </strong></a>
                            <?php 
							$sql_tot = "select * from users where userid NOT IN (select userid from leaves)";
							$result_tot=mysqli_query($conn,$sql_tot);
							$row_tot=mysqli_num_rows($result_tot);
			
							$sql_del = "SELECT * FROM leave_request where status='rejected'";
							$result_del=mysqli_query($conn,$sql_del);
							$row_del=mysqli_num_rows($result_del);
			
							$sql_close = "SELECT * FROM leave_request where status='approved'";
							$result_close=mysqli_query($conn,$sql_close);
							$row_close=mysqli_num_rows($result_close);
			
							$sql_pen = "SELECT * FROM leave_request where status='pending'";
							$result_pen=mysqli_query($conn,$sql_pen);
							$row_pen=mysqli_num_rows($result_pen);
	
							$sql_lea = "select * from leaves";
							$result_lea=mysqli_query($conn,$sql_lea);
							$row_lea=mysqli_num_rows($result_lea);
							?>
                        	<a class="nav-item nav-link active"><strong> Add Leaves 
                            <?php if($row_tot>0){
									echo "<span class='badge badge-success badge-pill'> ".$row_tot." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Update_Leaves.php" class="nav-item nav-link"><strong> Update Leaves 
                            <?php if($row_lea>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_lea." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Delete_Leaves.php" class="nav-item nav-link"><strong> Delete Leaves 
                            <?php if($row_lea>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_lea." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Verify_Leave_Request.php" class="nav-item nav-link"><strong> Leave Requests 
                            <?php if($row_pen>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_pen." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Approved_Leave_Request.php" class="nav-item nav-link"><strong> Approved Leaves 
                            <?php if($row_close>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_close." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Rejected_Leave_Request.php" class="nav-item nav-link"><strong> Rejected Leaves 
                            <?php if($row_del>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_del." <span>";
								  } 
							?>
                            </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="Finance_Add_Leaves.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                            	<option value="userid"> Staff ID </option>
                                                <option value="fname"> First Name </option>
                                                <option value="lname"> Last Name </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="Finance_Add_Leaves.php"> Refresh </a>
											</div>
										</div>
									</div>
								</div>
                              </form>
								<div class="row">
									<div class="col-md-10">
                                            <?php
												if(isset($_POST["search"])){
													$search = $_POST["search_opt"];
													$s_text = $_POST["s_text"];
													if(empty($s_text)){
														echo "<script>alert(' Search Text is Empty!... ')</script>";
														$sql_delete = "select * from users where userid NOT IN (select userid from leaves)";
													}else{
														$sql_delete = "select * from users where userid NOT IN (select userid from leaves) and ".$search." like '%".$s_text."%'";
													}
													
												}else{
													$sql_delete = "select * from users where userid NOT IN (select userid from leaves)";
												}
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>Staff ID</center></th>
                                                                <th scope="col" colspan="2"><center>Staff Name</center></th>
                                                                <th scope="col"><center>Vacation Leaves</center></th>
                                                                <th scope="col"><center>Casual Leaves</center></th>
                                                                <th scope="col"><center>Sick Leaves</center></th>
                                                    			<th scope="col"><center>Operation</center></th>   
															</tr>
														</thead>
                                            <?php
													$b = 0;
													while($row = $result->fetch_assoc()){
														$bg_color = ($b++%2==1) ? 'odd' : 'even';
											?>
                                            			<tbody>
															<tr class="<?php echo $bg_color; ?>">
                                                            <form action="Finance_Add_Leaves.php" method="post" onSubmit="return confirm('WARNING!\n\n1. Accidentally insertion of records cannot backup from the system.\n2. There is no way to undo this action.\n\nDo you still really want to insert the leaves?');">
																<th scope="row"><?php echo $row["userid"]; ?></th>
																<td> <?php echo $row["fname"]." ".$row["lname"]; ?> </td>
                                                                <td><button class="btn btn-outline-info" type="button" onclick="openWinStaff(<?php echo $row["userid"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
                                                                <td> 
                                                                <div class="input-group mb-2 mr-sm-2">
   																	<div class="input-group-prepend">
      																	<div class="input-group-text">@</div>
    																</div>
    																<input type="number" min="0" class="form-control" name="vacation" placeholder=" Vacation Leaves " required>
  																</div>
                                                                </td>
                                                                <td> 
                                                                <div class="input-group mb-2 mr-sm-2">
   																	<div class="input-group-prepend">
      																	<div class="input-group-text">@</div>
    																</div>
    																<input type="number" min="0" class="form-control" name="casual" placeholder=" Casual Leaves " required>
  																</div>
                                                                </td>
                                                                <td> 
                                                                <div class="input-group mb-2 mr-sm-2">
   																	<div class="input-group-prepend">
      																	<div class="input-group-text">@</div>
    																</div>
    																<input type="number" min="0" class="form-control" name="sick" placeholder=" Sick Leaves " required>
  																</div>
                                                                </td>
                                                   				<th scope="row">
                                                               		<input type="hidden" value="<?php echo $row["userid"]; ?>" name="user_id">
                                                                	<input type="submit" value=" Add Leaves " name="add" class="btn btn-outline-success">
                                                        		
                                                                </th>
                                                            </form>
															</tr>
														</tbody>
                                            <?php
									
                                                	}
													echo "</table>";
													
											
													$conn->close();
												}else{
												?>
															<tr>
                                               				    <th scope="col" colspan="18"><center>No Results Available</center></th>   
															</tr>
											<?php
													}
												 
											?>
											
									</div>
								</div>
						</div>
					</div>
				</div>
 

 
<?php include_once 'staff-footer.php'; ?>	