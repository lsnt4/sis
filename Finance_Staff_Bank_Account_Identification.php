<?php
if($_SERVER["REQUEST_METHOD"] == "GET") 
$user = $_GET["user"];

?>

<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Success International School | Dashboard</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/Finance_Style.css">
	</head>
	<body>
				<div class="col-md-5">
					
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
								<div class="row">
									<div class="col-md-4">
                                            <?php
												include "DB_Connection.php";
												$sql_view = "select * from bank_accounts where userid='$user'";
												$result = $conn->query($sql_view);
												$row = $result->fetch_assoc();
												
												$sql_user = "select * from users where userid = '$user'";
												$result_user = $conn->query($sql_user);
												$row_user = $result_user->fetch_assoc();
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col" colspan="2"><center><h1> Staff Bank Account Details </h1></center></th> 
															</tr>
														</thead>
                                                        <tbody>
															<tr class="even">
																<th scope="row"> Account ID </th>
																<td>ACT<?php echo $row["id"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="odd">
																<th scope="row"> Account Holder </th>
																<td> <?php echo $row_user["fname"].".".$row_user["lname"]; ?> </td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="even">
																<th scope="row"> Account Number </th>
																<td><?php echo $row["account_no"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="odd">
																<th scope="row"> Bank Name </th>
																<td><?php echo $row["bankname"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        <tbody>
															<tr class="even">
																<th scope="row"> Branch Name </th>
																<td><?php echo $row["branch"]; ?></td>
                                                        	</tr>
                                                        </tbody>
                                                        
                                            <?php
													echo "</table>";
												}
												else{
											?>
													<table class="table table-bordered">
													<thead class="odd">
															<tr>
																<th scope="col" colspan="2"><center><h1> No Staff Bank Account Details Available </h1></center></th> 
															</tr>
														</thead>
                                                   	</table>
											<?php		}
												 
											?>
											
									</div>
								</div>
						</div>
					</div>
				</div>
 

 
</div>
		</div>
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/cash_flow.js"></script>
	</body>
</html>