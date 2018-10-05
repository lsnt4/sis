<?php
include_once 'staff-header.php'; 
include "DB_Connection.php";

$user = $session->get_session('userid');

?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <?php 			
							$sql_close = "SELECT * FROM leave_request where userid = '$user'";
							$result_close=mysqli_query($conn,$sql_close);
							$row_close=mysqli_num_rows($result_close);
							?>
                            <a class="nav-item nav-link active"><strong> Leave Balance </strong></a>
                            <a href="leave-apply.php" class="nav-item nav-link"><strong> Apply Leave </strong></a>	
                            <a href="leave-request.php" class="nav-item nav-link"><strong> Leave Requests 
                            <?php if($row_close>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_close." <span>";
								  } 
							?>
                            </strong></a>		
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="salaryslip.php">
								<div class="row">
									<div class="col-md-12">
										<!--div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                                <option value="month"> Month </option>
                                                <option value="year"> Year </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php #echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="salaryslip.php"> Refresh </a>
											</div>
										</div-->
									</div>
								</div>
                              </form>
								<div class="row">
									<div class="col-md-4">
                                            <?php
												if(isset($_POST["search"])){
													$search = $_POST["search_opt"];
													$s_text = $_POST["s_text"];
													if(empty($s_text)){
														echo "<script>alert(' Search Text is Empty!... ')</script>";
														$sql_delete = "select * from payroll where status='closed' and staff_id = '$user'";
													}else{
														$sql_delete = "select * from payroll where ".$search." like '%".$s_text."%' and status='closed' and staff_id = '$user'";
													}
													
												}else{
													$sql_delete = "SELECT * FROM leaves where userid = '$user'";
												}
												$result = $conn->query($sql_delete);
												
												
												if($result->num_rows>0){
												$row = $result->fetch_assoc();
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>#</center></th>
																<th scope="col"><center>Leave Type</center></th>
                                                                <th scope="col"><center>No. of Days</center></th>  
															</tr>
														</thead>
                                            <?php
													$b = 0;
													$i = 1;
													
														$bg_color = ($b++%2==1) ? 'odd' : 'even';
											?>
                                            			<tbody>
															<tr class="even">
																<th scope="row"><center> 1 </center></th>
																<td><center> Vacation Leaves </center>  </td>
																<td><center> <?php echo $row["vacation"]; ?> </center></td>
															</tr>
														</tbody>
                                                        <tbody>
															<tr class="odd">
																<th scope="row"><center> 2 </center></th>
																<td><center> Casual Leaves </center>  </td>
																<td><center> <?php echo $row["casual"]; ?> </center></td>
															</tr>
														</tbody>
                                                        <tbody>
															<tr class="even">
																<th scope="row"><center> 3 </center></th>
																<td><center> Sick Leaves </center>  </td>
																<td><center> <?php echo $row["sick"]; ?> </center></td>
															</tr>
														</tbody>
                                            <?php
									
                                                	
													echo "</table>";
													
											
													$conn->close();
												}else{
											?>
															<tr>
                                               				    <th scope="col" colspan="3"><center>No Results Available</center></th>   
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