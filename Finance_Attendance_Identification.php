<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
	$month = $_GET["month"];
	$year = $_GET["year"];
	$user = $_GET["user"];
}
	
function getMonthNo($m){
    if($m=="January"){
        return 1;
    }else if($m=="February"){
        return 2;
    }else if($m=="March"){
        return 3;
    }else if($m=="April"){
        return 4;
    }else if($m=="May"){
        return 5;
    }else if($m=="June"){
        return 6;
    }else if($m=="July"){
        return 7;
    }else if($m=="August"){
        return 8;
    }else if($m=="September"){
        return 9;
    }else if($m=="October"){
        return 10;
    }else if($m=="November"){
        return 11;
    }else if($m=="December"){
        return 12;
    }
} 

?>

<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> Success International School | Dashboard </title>
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
												$sql_view = "select * from attendance where userid='$user' and MONTH(date) = '".getMonthNo($month)."' and YEAR(date) = '$year'";
												$result = $conn->query($sql_view);
												
												$sql_user = "select * from users where userid = '$user'";
												$result_user=$conn->query($sql_user);
												$row_user = $result_user->fetch_assoc();												
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			
                                            			<thead class="odd">
															<tr>
																<th scope="col" colspan="3"><center><?php echo $user." - ".$row_user["fname"].".".$row_user["lname"]; ?></center></th>   
															</tr>
														</thead>
                                                        <thead class="even">
															<tr>
																<th scope="col" colspan="3"><center> <?php echo $month; ?> - <?php echo $year; ?> - Attendence </center></th>   
															</tr>
														</thead>
                                            			<thead class="odd">
															<tr>
																<th scope="col"><center> # </center></th>
                                                                <th scope="col"><center> Date </center></th>
                                                                <th scope="col"><center> Time </center></th>   
															</tr>
														</thead>
                                            <?php
											$i = 1;
											$b = 0;
											while($row = $result->fetch_assoc()){
												$bg_color = ($b++%2==1) ? 'odd' : 'even';
											?>
                                            			<thead class="<?php echo $bg_color; ?>">
															<tr>
																<th scope="col"><center><?php echo $i; ?></center></th>
                                                                <th scope="col"><center><?php echo $row["date"]; ?></center></th>
                                                                <th scope="col"><center><?php echo $row["time"]; ?></center></th>   
															</tr>
														</thead>
                                            
                                            <?php
											$i++;	
											}
													echo "</table>";
												}
												else{
											?>
													<table class="table table-bordered">
													<thead class="odd">
															<tr>
																<th scope="col" colspan="2"><center><h1> No Staff Attendance Details Available </h1></center></th> 
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