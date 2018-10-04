<?php
include_once 'staff-header.php';
include "DB_Connection.php"; 

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
							<a class="nav-item nav-link active"><strong> Bank Balance 
                            <?php 
							if($row_tot_com > 0){
								echo "<span class='badge badge-success badge-pill'> ".$row_tot_com." <span>";
							}
							?>
                            </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="Finance_Bank_Balance.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                            	<option value="account_no"> Account Number </option>
                                                <option value="bankname"> Bank Name </option>
                                                <option value="branch"> Branch Name </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="Finance_Bank_Balance.php"> Refresh </a>
											</div>
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
														$sql_delete = "select * from bank_accounts where userid = 0";
													}else{
														$sql_delete = "select * from bank_accounts where ".$search." like '%".$s_text."%' and userid = 0";
													}
													
												}else{
													$sql_delete = "select * from bank_accounts where userid = 0";
												}
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>Account ID</center></th>
                                                                <th scope="col"><center>Account No.</center></th>
                                                                <th scope="col"><center>Bank Name</center></th>
                                                                <th scope="col"><center>Branch Name</center></th>
                                                                <th scope="col"><center>Total Deposit</center></th>
                                                                <th scope="col"><center>Total Withdrawls</center></th>
                                                                <th scope="col"><center>Balance</center></th>   
															</tr>
														</thead>
                                            <?php
													$b = 0;
													while($row = $result->fetch_assoc()){
														
														$bg_color = ($b++%2==1) ? 'odd' : 'even';
											?>
                                            			<tbody>
															<tr class="<?php echo $bg_color; ?>">
																<th scope="row"><?php echo "ACT".$row["id"]; ?></th>
                                                                <td><?php echo $row["account_no"]; ?></td>
                                                                <td><?php echo $row["bankname"]; ?></td>
                                                                <td><?php echo $row["branch"]; ?></td>
                                                                <td> 
																<?php 
																$sql_dep = "select sum(amount) as tot_dep from bank_transactions where acc_id ='".$row["id"]."' and type='deposit'";
																$result_dep = $conn->query($sql_dep);
																$row_dep = $result_dep->fetch_assoc();
																if($row_dep["tot_dep"] > 0)
																echo $row_dep["tot_dep"];
																else
																echo "0";
																?> 
                                                                </td>
                                                                <td>
                                                                <?php 
																$sql_wit = "select sum(amount) as tot_wit from bank_transactions where acc_id ='".$row["id"]."' and type='withdraw'";
																$result_wit = $conn->query($sql_wit);
																$row_wit = $result_wit->fetch_assoc();
																if($row_wit["tot_wit"] > 0)
																echo $row_wit["tot_wit"];
																else
																echo "0";
																?>
                                                                </td>
                                                                <td> <?php echo $row_dep["tot_dep"] - $row_wit["tot_wit"]; ?></td>
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