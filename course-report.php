<?php include_once 'staff-header.php';
include_once 'course-class.php';?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="course-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="course-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="course-schedule.php" class="nav-item nav-link disabled">Schedule</a>
							<a href="course-report.php" class="nav-item nav-link active">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<div class="row">
								<div class="col-md-3">
									<div class="card bg-light mb-3">
										<div class="card-header">Courses List</div>
										<div class="card-body">
											<p class="card-text">View detailed list about a specific Course .</p>
											<form action="course-name-report.php" method="get">
												<div class="form-group">
													<small class="form-text text-muted">Course Name</small>
													<?php
													$courseObj = new CourseManager;
													$allCourses = $courseObj->getAllCourse();

													if ($allCourses->num_rows > 0) {
												?>
														<select name="courseName" class="form-control">
												<?php   // output data of each row
															while($row = $allCourses->fetch_assoc()) {
												?>
															<option value="<?php print $row['name'] ?>"><?php print $row['name']?></option>


												<?php   } ?>
													</select>
													<?php
													} else {
															echo "No Employess Available.";
													}
												?>
												</div>
												<button class="btn btn-dark btn-block" type="submit">View Report</button>
											</form>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="card bg-light mb-3">
										<div class="card-header">Course Details</div>
										<div class="card-body">
											<p class="card-text">View courses Databass data .</p>
											<form action="course-enrollment.php" method="get">
												<button class="btn btn-dark btn-block" type="submit">View Report</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
