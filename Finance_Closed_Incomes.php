<?php include_once 'staff-header.php';
	  include "DB_Connection.php"; 
if(isset($_POST["movepending"])){
		$id = $_POST["income_id"];
		$status="pending";
		$verified_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$verified_date = date("Y-m-d h:i:s",time());
		
	reset_error_msg();
	reset_success_msg();
	
	$sql_del = "update incomes set status='$status',last_updated_by='$verified_by',last_updated_date='$verified_date' where id='$id'";
						if($conn->query($sql_del) == true){
							  		set_success_msg("<strong>Success!</strong> INC".$id." successfully moved to pending!");
									header("Location: Finance_Closed_Incomes.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Closed_Incomes.php");
						  }
}



?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Income_Dashboard.php" class="nav-item nav-link"><strong> Income Dashboard </strong></a>
							<a href="Finance_Add_Incomes.php" class="nav-item nav-link"><strong> Add Incomes </strong></a>
                            <?php
                            $sql_up = "SELECT * FROM incomes where catogory not in ('Student','Exam Management','Library Management','Course Management')";
							$result_up=mysqli_query($conn,$sql_up);
							$row_up=mysqli_num_rows($result_up);
							
							$sql_close = "SELECT * FROM incomes where status='closed'";
							$result_close=mysqli_query($conn,$sql_close);
							$row_close=mysqli_num_rows($result_close);
			
							$sql_pen = "SELECT * FROM incomes where status='pending'";
							$result_pen=mysqli_query($conn,$sql_pen);
							$row_pen=mysqli_num_rows($result_pen);
            				?>
                            <a href="Finance_Update_Incomes.php" class="nav-item nav-link"><strong> Update Incomes 
                            <?php if($row_up>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_up." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Delete_Incomes.php" class="nav-item nav-link"><strong> Delete Incomes 
                            <?php if($row_up>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_up." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Verify_Incomes.php" class="nav-item nav-link"><strong> Verify Incomes 
                            <?php if($row_pen>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_pen." <span>";
								  } 
							?>
                            </strong></a>
                            <a class="nav-item nav-link active"><strong> Closed Incomes 
                            <?php if($row_close>0){
									echo "<span class='badge badge-success badge-pill'> ".$row_close." <span>";
								  } 
							?>
                            </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="Finance_Closed_Incomes.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                            	<option value="catogory"> Catogory </option>
                                                <option value="description"> Description </option>
                                                <option value="payment_method"> Payment Method </option>
                                                <option value="status"> Status </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="Finance_Closed_Incomes.php"> Refresh </a>
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
														$sql_delete = "select * from incomes where status='closed'";
													}else{
														$sql_delete = "select * from incomes where ".$search." = '".$s_text."' and status='closed'";
													}
													
												}else{
													$sql_delete = "select * from incomes where status='closed'";
												}
												
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>Income ID</center></th>
																<th scope="col"><center>Category</center></th>
																<th scope="col"><center>Descripton</center></th>
																<th scope="col"><center>Payment Method</center></th>
																<th scope="col"><center>Amount</center></th>
                                               				    <th scope="col" colspan="2"><center>Paid By</center></th>
																<th scope="col" colspan="2"><center>Added By</center></th>
                                                    			<th scope="col"><center>Added Date</center></th>
                                                    			<th scope="col" colspan="2"><center>Last Updated By</center></th>
                                                    			<th scope="col"><center>Last Updated Date</center></th>
                                                    			<th scope="col" colspan="2"><center>Verified By</center></th>
                                                    			<th scope="col"><center>Verified Date</center></th>
                                                    			<th scope="col"><center>Status</center></th>
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
                                                            <?php $inc_id = $row["id"]; ?>
																<th scope="row">INC<?php echo $inc_id; ?></th>
																<td><?php echo $row["catogory"]; ?></td>
																<td><?php echo $row["description"]; ?></td>
																<td><?php echo $row["payment_method"]; ?></td>
                                                    			<td><?php echo $row["amount"]; ?></td>
                                                    			 <?php if(is_numeric($row["paid_by"]) && $row["paid_by"] != 0 && $row["paid_by"] != 0){
																		$result_paid_by = $row["paid_by"];
																		$result_paid_by_btn = "";
																	}else if(is_string($row["paid_by"])){
																		$result_paid_by = $row["paid_by"];
																		$result_paid_by_btn = "message-hide";
																	}
																	else{
																		$result_paid_by = " _ ";
																		$result_paid_by_btn = "message-hide";
																	} 
																?>
                                                    			<td><center><?php echo $result_paid_by; ?></center></td>
                                                                <td><center><button class="btn btn-outline-info <?php echo $result_paid_by_btn;  ?>" type="button" onclick="openWinStaff(<?php echo $row["paid_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></center></td>
																<?php if($row["added_by"]==0 || $row["added_by"]==""){
																		$result_added_by = " _ ";
																		$result_added_by_btn = "message-hide";
																	}else{
																		$result_added_by = $row["added_by"];
																		$result_added_by_btn = "";
																	} 
																?>
                                                                <td><center><?php echo $result_added_by; ?></center></td>
                                                                <td><center><button class="btn btn-outline-info <?php echo $result_added_by_btn;  ?>" type="button" onclick="openWinStaff(<?php echo $row["added_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></center></td>
                                                                <?php if($row["added_date"]=="0000-00-00 00:00:00"){
																		$result_added_date = " _ ";
																	}else{
																		$result_added_date = $row["added_date"];
																	} 
																?>
																<td><center><?php echo $result_added_date; ?></center></td>
                                                                <?php if(empty($row["last_updated_by"])){
																		$result_last_updated_by = " _ ";
																		$result_last_updated_by_btn = "message-hide";
																	}else{
																		$result_last_updated_by = $row["last_updated_by"];
																		$result_last_updated_by_btn = "";
																	} 
																?>
																<td><center><?php echo $result_last_updated_by; ?></center></td>
                                                                <td><button class="btn btn-outline-info <?php echo $result_last_updated_by_btn; ?>" type="button" onclick="openWinStaff(<?php echo $row["last_updated_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
                                                                <?php if($row["last_updated_date"]=="0000-00-00 00:00:00"){
																		$result_last_date = " _ ";
																	}else{
																		$result_last_date = $row["last_updated_date"];
																	} 
																?>
                                                    			<td><?php echo $result_last_date; ?></td>
                                                    			
                                                                <?php if(empty($row["verified_by"])){
																		$result_verified_by = " _ ";
																		$result_verified_by_btn = "message-hide";
																	}else{
																		$result_verified_by = $row["verified_by"];
																		$result_verified_by_btn = "";
																	} 
																?>
                                                                <td><?php echo $result_verified_by; ?></td>
                                                                <td><button class="btn btn-outline-info <?php echo $result_verified_by_btn; ?>" type="button" onclick="openWinStaff(<?php echo $row["verified_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
                                                                <?php if($row["verified_date"]=="0000-00-00 00:00:00"){
																		$result_ver_date = " _ ";
																	}else{
																		$result_ver_date = $row["verified_date"];
																	} 
																?>
                                                    			<td><?php echo $result_ver_date; ?></td>
                                                    			<th scope="row" class="<?php echo $row["status"]; ?>"><?php echo $row["status"]; ?></th>
                                                   				<th scope="row">
                                             					<form action="" method="post" onSubmit="return confirm('WARNING!\n\n1. Accidentally moving pending of records cannot backup from the system.\n2. There is no way to undo this action.\n\nDo you still really want to move to pending INC<?php echo $row["id"]; ?>?');">
                                                               		<input type="hidden" value="<?php echo $row["id"]; ?>" name="income_id">
                                                                	<input type="submit" value=" Move to Pending " name="movepending" class="btn btn-outline-info">
                                                        		</form>
 
                                                                </th>
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