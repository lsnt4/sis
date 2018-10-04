<?php
include_once 'staff-header.php';
include "DB_Connection.php"; 

$user = $session->get_session('userid');

	if(isset($_POST["move_pending"])){
		$leaveid = $_POST["leave_id"];
		$verified_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$verified_date = date("Y-m-d h:i:s",time());
		$status = "pending";
		
		$sql_approve = "update leave_request set status='$status', verified_by='$verified_by', verified_date='$verified_date' where id='$leaveid'";
							if($conn->query($sql_approve) == true){
									set_success_msg("<strong>Success!</strong> Leave has been successfully Moved to Pending!");
									header("Location: Finance_Rejected_Leave_Request.php");
							}else{
									set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  	header("Location: Finance_Rejected_Leave_Request.php");
			
							}
	}

?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<?php 			
							$sql_close = "SELECT * FROM leave_request where userid = '$user'";
							$result_close=mysqli_query($conn,$sql_close);
							$row_close=mysqli_num_rows($result_close);
							?>
                            <a href="leave-balance.php" class="nav-item nav-link"><strong> Leave Balance </strong></a>
                            <a href="leave-apply.php" class="nav-item nav-link"><strong> Apply Leave </strong></a>	
                            <a class="nav-item nav-link active"><strong> Leave Requests 
                            <?php if($row_close>0){
									echo "<span class='badge badge-success badge-pill'> ".$row_close." <span>";
								  } 
							?>
                            </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="leave-request.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                                <option value="l_type"> Leave Type </option>
                                                <option value="days"> No. of Days </option>
                                                <option value="reason"> Reason </option>
                                                <option value="status"> Status </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="leave-request.php"> Refresh </a>
											</div>
										</div>
									</div>
								</div>
                              </form>
								<div class="row">
									<div class="col-md-12">
                                            <?php
												if(isset($_POST["search"])){
													$search = $_POST["search_opt"];
													$s_text = $_POST["s_text"];
													if(empty($s_text)){
														echo "<script>alert(' Search Text is Empty!... ')</script>";
														$sql_delete = "select * from leave_request where userid='$user'";
													}else{
														$sql_delete = "select * from leave_request where userid='$user' and ".$search." like '%".$s_text."%'";
													}
													
												}else{
													$sql_delete = "select * from leave_request where userid='$user'";
												}
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											?>			
                                            <?php
													$b = 0;
													$i = 1;
													while($row = $result->fetch_assoc()){
											?><div class="alert alert-info alert-dismissible fade show" role="alert">
  														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    														<span aria-hidden="true"><strong>&times;</strong></span>
 														</button>

                                            			<table class='table table-bordered'>
                                                        <thead class="odd">
															<tr>
                                                            	<th scope="col"><center>#</center></th>
                                                                <th scope="col"><center>Leave Type</center></th>
                                                                <th scope="col"><center>Days</center></th>
                                                                <th scope="col"><center>Reason</center></th>
                                                                <th scope="col"><center>Applied Date</center></th>
                                                                <th scope="col"><center>Status</center></th>  
															</tr>
														</thead>
                                            			<tbody>
															<tr>
                                                            <form action="" method="post">
                                                            	<th scope="row"><center><?php echo $i++; ?></center></th>
                                                                <td><center><?php echo $row["l_type"]; ?></center></td>
                                                                <td><center><?php echo $row["days"]; ?> Days</center></td>
                                                                <td><center><?php echo $row["reason"]; ?></center></td>
                                                                <td><center><?php echo $row["added_date"]; ?></center></td>
                                                   				<th class="<?php echo $row["status"]; ?>"><center><?php echo $row["status"]; ?></center></th>
                                                            </form>
															</tr>
														</tbody>
                                                        </table>
                                             </div>
                                            <?php
									
                                                	}
													echo "";
													
											
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