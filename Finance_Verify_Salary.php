<?php
include_once 'staff-header.php'; 
include "DB_Connection.php"; 
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Payroll_Dashboard.php" class="nav-item nav-link"><strong> Payroll Dashboard </strong></a>
							<a href="Finance_Add_Salary.php" class="nav-item nav-link"><strong> Add Payroll </strong></a>
                            <?php 
							$sql_tot = "SELECT * FROM payroll";
							$result_tot=mysqli_query($conn,$sql_tot);
							$row_tot=mysqli_num_rows($result_tot);
			
							$sql_close = "SELECT * FROM payroll where status='closed'";
							$result_close=mysqli_query($conn,$sql_close);
							$row_close=mysqli_num_rows($result_close);
			
							$sql_pen = "SELECT * FROM payroll where status='pending'";
							$result_pen=mysqli_query($conn,$sql_pen);
							$row_pen=mysqli_num_rows($result_pen);
							?>
                            <a href="Finance_Update_Salary.php" class="nav-item nav-link"><strong> Update Payroll 
                            <?php if($row_tot>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_tot." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Delete_Salary.php" class="nav-item nav-link"><strong> Delete Payroll 
                            <?php if($row_tot>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_tot." <span>";
								  } 
							?>
                            </strong></a>
                            <a class="nav-item nav-link active"><strong> Verify Payroll 
                            <?php if($row_pen>0){
									echo "<span class='badge badge-success badge-pill'> ".$row_pen." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Closed_Salary.php" class="nav-item nav-link"><strong> Closed Payroll 
                            <?php if($row_close>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_close." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Download_Salary.php" class="nav-item nav-link"><strong> Download Payroll 
                            <?php if($row_tot>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_tot." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Edit_Standards.php" class="nav-item nav-link"><strong> Edit Standards </strong></a>	
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="Finance_Verify_Salary.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                            	<option value="staff_id"> Employee ID </option>
                                                <option value="month"> Month </option>
                                                <option value="year"> Year </option>
                                                <option value="payment_method"> Payment Method </option>
                                                <option value="status"> Status </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="Finance_Verify_Salary.php"> Refresh </a>
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
														$sql_delete = "select * from payroll where status='pending'";
													}else{
														$sql_delete = "select * from payroll where ".$search." like '%".$s_text."%' and status='pending'";
													}
													
												}else{
													$sql_delete = "select * from payroll where status='pending'";
												}
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>Payroll ID</center></th>
                                                                <th scope="col" colspan="2"><center>Employee ID</center></th>
																<th scope="col"><center>Payment Method</center></th>
                                                                <th scope="col"><center>Payment Month</center></th>
                                                                <th scope="col"><center>Net Salary</center></th>
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
																<th scope="row">PAY<?php echo $row["id"]; ?></th>
																<td><?php echo $row["staff_id"]; ?></td>
                                                                <td><button class="btn btn-outline-info" type="button" onclick="openWinStaff(<?php echo $row["staff_id"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
																<td><?php echo $row["payment_method"]; ?></td>
                                                    			<td><?php echo $row["month"]." ".$row["year"];; ?></td>
                                                    			<td><?php echo $row["net_sal"]; ?></td>
																<td><?php echo $row["added_by"]; ?></td>
                                                                <td><button class="btn btn-outline-info" type="button" onclick="openWinStaff(<?php echo $row["added_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
																<td><?php echo $row["added_date"]; ?></td>
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
                                             
                                                                <form action="Finance_Verify_Salary_View.php" method="post">
                                                                	<div class="btn-group" role="group" aria-label="Basic example">
                                                               		<input type="hidden" value="<?php echo $row["id"]; ?>" name="pay_id">
                                                                	<input type="submit" value=" Verify " name="verify" class="btn btn-primary">
																	</div>
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