<?php
include_once 'staff-header.php';
include "DB_Connection.php"; 

if(isset($_POST["update"])){
		$acc_id = $_POST["acc_id"];
		$ano = $_POST["ano"];
		$bank_name = $_POST["bank_name"];
		$branch_name = $_POST["branch_name"];
		$last_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$last_date = date("Y-m-d h:i:s",time());
		
		$sql_check = "select * from bank_accounts where account_no='$ano' and bankname='$bank_name' and branch='$branch_name'";
		$result_check = $conn->query($sql_check);
		
		if($result_check->num_rows>0){
			echo "<script> alert(' The record you inserted already available in database!.. Try a new record!..') </script>";
			set_error_msg("<strong>Failed!</strong> Already available in the Database!... Try new record to update!...");
			header("Location: Finance_Search_Staff_Bank_Accounts.php");
			
		}
		else{
			reset_error_msg();
			$sql_insert = "update bank_accounts set account_no='$ano',bankname='$bank_name',branch='$branch_name',last_updated_by='$last_by',last_updated_date='$last_date' where id = '$acc_id'";
						  if($conn->query($sql_insert) == true){
							  		set_success_msg("<strong>Success!</strong> ".$ano." Account has been successfully updated!");
									header("Location: Finance_Search_Staff_Bank_Accounts.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Search_Staff_Bank_Accounts.php");
						  }
		}
}

if(isset($_POST["delete"])){
		$acc_id = $_POST["acc_id"];
		$ano = $_POST["ano"];
		
		
		
			$sql_insert = "delete from bank_accounts where id = '$acc_id'";
						  if($conn->query($sql_insert) == true){
							  		set_success_msg("<strong>Success!</strong> ".$ano." Account has been successfully deleted!");
									header("Location: Finance_Search_Staff_Bank_Accounts.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Search_Staff_Bank_Accounts.php");
						  }
		
}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Bank_Accounts_Dashboard.php" class="nav-item nav-link"><strong> Accounts Dashboard </strong></a>
                            <?php
							$sql_tot_com = "SELECT * FROM bank_accounts WHERE userid = 0";
							$result_tot_com=mysqli_query($conn,$sql_tot_com);
							$row_tot_com=mysqli_num_rows($result_tot_com);
			
							$sql_tot_emp = "SELECT * FROM bank_accounts WHERE userid != 0";
							$result_tot_emp=mysqli_query($conn,$sql_tot_emp);
							$row_tot_emp=mysqli_num_rows($result_tot_emp);
			
							$sql_close = "SELECT * FROM bank_transactions where type='deposit'";
							$result_close=mysqli_query($conn,$sql_close);
							$row_dep=mysqli_num_rows($result_close);
			
							$sql_pen = "SELECT * FROM bank_transactions where type='withdraw'";
							$result_pen=mysqli_query($conn,$sql_pen);
							$row_wit=mysqli_num_rows($result_pen);
							?>
							<a href="Finance_Add_Bank_Accounts.php" class="nav-item nav-link"><strong> Add Bank Account </strong></a>
							<a href="Finance_Search_Bank_Accounts.php" class="nav-item nav-link"><strong> Search Bank Account 
                            <?php 
							if($row_tot_com > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_tot_com." <span>";
							}
							?>
                            </strong></a>
							<a href="Finance_Add_Staff_Bank_Accounts.php" class="nav-item nav-link"><strong> Add Staff Account </strong></a>
							<a class="nav-item nav-link active"><strong> Search Staff Account 
                            <?php 
							if($row_tot_emp > 0){
								echo "<span class='badge badge-success badge-pill'> ".$row_tot_emp." <span>";
							}
							?>
                            </strong></a>
							<a href="Finance_Add_Deposits.php" class="nav-item nav-link"><strong> Deposits 
                            <?php 
							if($row_dep > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_dep." <span>";
							}
							?>
                            </strong></a>
                            <a href="Finance_Add_Withdrawals.php" class="nav-item nav-link"><strong> Withdrawals 
                            <?php 
							if($row_wit > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_wit." <span>";
							}
							?>
                            </strong></a>
							<a href="Finance_Bank_Balance.php" class="nav-item nav-link"><strong> Bank Balance 
                            <?php 
							if($row_tot_com > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_tot_com." <span>";
							}
							?>
                            </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="Finance_Search_Staff_Bank_Accounts.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                            	<option value="userid"> Staff ID </option>
                                            	<option value="account_no"> Account Number </option>
                                                <option value="bankname"> Bank Name </option>
                                                <option value="branch"> Branch Name </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="Finance_Search_Staff_Bank_Accounts.php"> Refresh </a>
											</div>
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
														$sql_delete = "select * from bank_accounts where userid != 0";
													}else{
														$sql_delete = "select * from bank_accounts where ".$search." like '%".$s_text."%' and userid != 0";
													}
													
												}else{
													$sql_delete = "select * from bank_accounts where userid != 0";
												}
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>Account ID</center></th>
                                                                <th scope="col"><center>Staff ID</center></th>
                                                                <th scope="col" colspan="2"><center>Staff Name</center></th>
                                                                <th scope="col"><center>Account No.</center></th>
                                                                <th scope="col"><center>Bank Name</center></th>
                                                                <th scope="col"><center>Branch Name</center></th>
                                                                <th scope="col" colspan="2"><center>Added By</center></th>
                                                                <th scope="col"><center>Added Date</center></th>
                                                                <th scope="col" colspan="2"><center>Last Updated By</center></th>
                                                                <th scope="col"><center>Last Updated Date</center></th>
                                                    			<th scope="col"><center>Operation</center></th>   
															</tr>
														</thead>
                                            <?php
													$b = 0;
													while($row = $result->fetch_assoc()){
														
														$bg_color = ($b++%2==1) ? 'odd' : 'even';
														$sql_get = "select * from users where userid='".$row["userid"]."'";
														$result_get = $conn->query($sql_get);
														$row_get = $result_get->fetch_assoc();
											?>
                                            			<tbody>
															<tr class="<?php echo $bg_color; ?>">
                                                            <form action="Finance_Search_Staff_Bank_Accounts.php" method="post">
																<th scope="row"><?php echo "ACT".$row["id"]; ?></th>
                                                                <th scope="row"><?php echo $row["userid"]; ?></th>
																<td> <?php echo $row_get["fname"].".".$row_get["lname"]; ?> </td>
                                                                <td><button class="btn btn-outline-info" type="button" onclick="openWinStaff(<?php echo $row["userid"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
                                                                <td> 
                                                                <div class="input-group mb-2 mr-sm-2">
   																	<div class="input-group-prepend">
      																	<div class="input-group-text">@</div>
    																</div>
    																<input type="text" placeholder="Account Number" class="form-control" value="<?php echo $row["account_no"]; ?>" name="ano" required>
  																</div>
                                                                </td>
                                                                <td> 
                                                                <div class="input-group mb-2 mr-sm-2">
   																	<div class="input-group-prepend">
      																	<div class="input-group-text">@</div>
    																</div>
    																<input type="text" placeholder=" Bank Name " class="form-control" value="<?php echo $row["bankname"]; ?>" name="bank_name" required>
  																</div>
                                                                </td>
                                                                <td> 
                                                                <div class="input-group mb-2 mr-sm-2">
   																	<div class="input-group-prepend">
      																	<div class="input-group-text">@</div>
    																</div>
    																<input type="text" placeholder=" Branch Name " class="form-control" value="<?php echo $row["branch"]; ?>" name="branch_name" required>
  																</div>
                                                                </td>
                                                                <td> <?php echo $row["added_by"]; ?> </td>
                                                                <td><button class="btn btn-outline-info" type="button" onclick="openWinStaff(<?php echo $row["added_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
                                                   				<td> <?php echo $row["added_date"]; ?> </td>
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
                                                                <th scope="row">
                                                               		<input type="hidden" value="<?php echo $row["id"]; ?>" name="acc_id">
                                                                	<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
  																		<button type="submit" name="update" class="btn btn-dark">Update</button>
                                                                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
																	</div>                                                        		
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