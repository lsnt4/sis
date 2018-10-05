<?php
include_once 'staff-header.php';
include "DB_Connection.php"; 

	if(isset($_POST["add"])){
		$userid = $_POST["user_id"];
		$ano = $_POST["ano"];
		$bank = $_POST["bank"];
		$branch = $_POST["branch"];
		$added_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$added_date = date("Y-m-d h:i:s",time());
		
		$sql_check = "select * from bank_accounts where account_no = '$ano'";
			$result_check = $conn->query($sql_check);
			
			if($result_check->num_rows>0){
									set_error_msg("<strong>Sorry! ".$ano." </strong> already available in database. Try new account number!...!");
								  	header("Location: Finance_Add_Staff_Bank_Accounts.php");
			}else{
						$sql="insert into bank_accounts (userid,account_no,bankname,branch,added_by,added_date) values ('$userid','$ano','$bank','$branch','$added_by','$added_date')";
							if($conn->query($sql) == true){
									set_success_msg("<strong>Success!</strong> ".$userid."'s bank account has been successfully inserted!");
									header("Location: Finance_Add_Staff_Bank_Accounts.php");
							}else{
									set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  	header("Location: Finance_Add_Staff_Bank_Accounts.php");
			
							}
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
							<a class="nav-item nav-link active"><strong> Add Staff Account </strong></a>
							<a href="Finance_Search_Staff_Bank_Accounts.php" class="nav-item nav-link "><strong> Search Staff Account 
                            <?php 
							if($row_tot_emp > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_tot_emp." <span>";
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
							<form method="post" action="Finance_Add_Staff_Bank_Accounts.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                            	<option value="userid"> Staff ID </option>
                                                <option value="fname"> First Name </option>
                                                <option value="lname"> Last Name </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="Finance_Add_Staff_Bank_Accounts.php"> Refresh </a>
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
														$sql_delete = "select * from users where userid NOT IN (select userid from bank_accounts)";
													}else{
														$sql_delete = "select * from users where ".$search." like '%".$s_text."%' and userid NOT IN (select userid from bank_accounts)";
													}
													
												}else{
													$sql_delete = "select * from users where userid NOT IN (select userid from bank_accounts)";
												}
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>Staff ID</center></th>
                                                                <th scope="col" colspan="2"><center>Staff Name</center></th>
                                                                <th scope="col"><center>Account No.</center></th>
                                                                <th scope="col"><center>Bank Name</center></th>
                                                                <th scope="col"><center>Branch Name</center></th>
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
                                                            <form action="Finance_Add_Staff_Bank_Accounts.php" method="post" onSubmit="return confirm('WARNING!\n\n1. Accidentally insertion of records cannot backup from the system.\n2. There is no way to undo this action.\n\nDo you still really want to insert the bank account?');">
																<th scope="row"><?php echo $row["userid"]; ?></th>
																<td> <?php echo $row["fname"]." ".$row["lname"]; ?> </td>
                                                                <td><button class="btn btn-outline-info" type="button" onclick="openWinStaff(<?php echo $row["userid"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
                                                                <td> 
                                                                <div class="input-group mb-2 mr-sm-2">
   																	<div class="input-group-prepend">
      																	<div class="input-group-text">@</div>
    																</div>
    																<input type="text" class="form-control" name="ano" placeholder=" Account No. " required>
  																</div>
                                                                </td>
                                                                <td> 
                                                                <div class="input-group mb-2 mr-sm-2">
   																	<div class="input-group-prepend">
      																	<div class="input-group-text">@</div>
    																</div>
    																<input type="text" class="form-control" name="bank" placeholder=" Bank Name " required>
  																</div>
                                                                </td>
                                                                <td> 
                                                                <div class="input-group mb-2 mr-sm-2">
   																	<div class="input-group-prepend">
      																	<div class="input-group-text">@</div>
    																</div>
    																<input type="text" class="form-control" name="branch" placeholder=" Branch Name " required>
  																</div>
                                                                </td>
                                                   				<th scope="row">
                                                               		<input type="hidden" value="<?php echo $row["userid"]; ?>" name="user_id">
                                                                	<input type="submit" value=" Add Staff Bank Account " name="add" class="btn btn-info">
                                                        		
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