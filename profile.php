<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active">Profile</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form action="profile.php" method="post">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Employee ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="EMP3928" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Deparment</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="Finance" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" class="form-control" value="John" disabled>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" value="Doe" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Birth</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input type="text" class="form-control" value="1997" disabled>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" value="12" disabled>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" value="28" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">NIC</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="123456789V" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Contacts</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="mobile" value="077123456">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="address" value="No 221B, Baker Street, London">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="email" class="form-control" name="email" value="conandoyle@nsa.gov">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<legend class="col-form-label col-sm-2 pt-0">Gender</legend>
									<div class="col-sm-10 col-md-2">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="Male" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Password</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="password" class="form-control" placeholder="Leave blank if no password change required">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-dark">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>