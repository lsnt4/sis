<?php include_once 'staff-header.php';
	require_once 'database_credentials.php';

	$dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($dbconn->connect_error) {
		die("Database connection error: " . $dbconn->connect_error);
	}

?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="course-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="course-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="course-schedule.php" class="nav-item nav-link active">Schedule</a>
							<a href="course-report.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="course-schedule.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
										<input type="text" class="form-control" name = "search_c"  placeholder="course name ex:-ENGLISH  OR Day ex:- monday ">
											<div class="input-group-append">
												<button class="btn btn-dark" type="button">Search</button>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col">Course ID</th>
													<th scope="col">Course Name</th>
													<th scope="col">Day</th>
													<th scope="col">Hall NO</th>
													<th scope="col">Time</th>
													<th scope="col"></th>
												</tr>
											</thead>
										<?php
                        if (isset($_POST['search_c'])) {
                            $keyword = $_POST['search_c'];
                            $sql = "select * from courses
                                    	WHERE
                                          name LIKE '%$keyword%' OR
                                          day LIKE '%$keyword%'  ORDER BY hall_no ASC";
                                            }
																						 else {
                                                $sql = "SELECT * FROM courses ORDER BY hall_no ASC";
                                            }
                                            $result=$dbconn->query($sql);
																						  if($result->num_rows>0) {
																								while ($row = $result->fetch_assoc()) {
                                 ?>
											<tbody>
												<tr>
													<th scope="row"><?php echo $row['cid']; ?></th>
													<td><?php echo $row['name']; ?></td>
													<td><?php echo $row['day']; ?></td>
													<td><?php echo $row['hall_no']; ?></td>
													<td>
														<?php $time = date('H'); ?>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 8) && substr($row['time_end'], 0, 2) >= 8) ? 'hr-act': ''; ?> <?php echo ($time == 8) ? 'hr-curr' : '' ; ?>">8</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 9) && substr($row['time_end'], 0, 2) >= 9) ? 'hr-act': ''; ?> <?php echo ($time == 9) ? 'hr-curr' : '' ; ?>">9</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 10) && substr($row['time_end'], 0, 2) >= 10) ? 'hr-act': ''; ?> <?php echo ($time == 10) ? 'hr-curr' : '' ; ?>">10</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 11) && substr($row['time_end'], 0, 2) >= 11) ? 'hr-act': ''; ?> <?php echo ($time == 11) ? 'hr-curr' : '' ; ?>">11</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 12) && substr($row['time_end'], 0, 2) >= 12) ? 'hr-act': ''; ?> <?php echo ($time == 12) ? 'hr-curr' : '' ; ?>">12</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 13) && substr($row['time_end'], 0, 2) >= 13) ? 'hr-act': ''; ?> <?php echo ($time == 13) ? 'hr-curr' : '' ; ?>">13</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 14) && substr($row['time_end'], 0, 2) >= 14) ? 'hr-act': ''; ?> <?php echo ($time == 14) ? 'hr-curr' : '' ; ?>">14</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 15) && substr($row['time_end'], 0, 2) >= 15) ? 'hr-act': ''; ?> <?php echo ($time == 15) ? 'hr-curr' : '' ; ?>">15</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 16) && substr($row['time_end'], 0, 2) >= 16) ? 'hr-act': ''; ?> <?php echo ($time == 16) ? 'hr-curr' : '' ; ?>">16</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 17) && substr($row['time_end'], 0, 2) >= 17) ? 'hr-act': ''; ?> <?php echo ($time == 17) ? 'hr-curr' : '' ; ?>">17</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 18) && substr($row['time_end'], 0, 2) >= 18) ? 'hr-act': ''; ?> <?php echo ($time == 18) ? 'hr-curr' : '' ; ?>">18</span>
													</td>
													<td>
														<form action="course-updateing.php" method= "post">
																<input type="hidden" value="<?php echo $row['cid']; ?>" name="courseid">
																<input type="submit" value=" Reschedule " class="btn btn-dark" name="update">
														</form>
													</div>
													</td>
												</tr>
											</tbody>
											<?php
										}
                                            }
                                            ?>
										</table>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
