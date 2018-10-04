<?php include_once 'staff-header.php'; 
	  include_once 'DB_Connection.php';
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Income_Overview.php" class="nav-item nav-link"> Income Overview </a>
                        	<a href="Finance_Add_Incomes.php" class="nav-item nav-link"> Add Incomes </a>
                            <a class="nav-item nav-link active"> Update Incomes </a>
                            <a href="Finance_Delete_Incomes.php" class="nav-item nav-link"> Delete Incomes </a>
                            <a href="Finance_Verify_Incomes.php" class="nav-item nav-link"> Verify Incomes </a>
                            <a href="Finance_Closed_Incomes.php" class="nav-item nav-link"> Closed Incomes </a>
							<a class="nav-item nav-link disabled"> Income Reports </a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
								<div class="row">
									<div class="col-md-12">
                                           <table class="table table-striped">
														<thead style="background-color:#666; color:#FFF">
															<tr>
																<th scope="col" colspan="4"><center> Success International School </center></th>  
															</tr>
														</thead>
                                                        <thead style=" background-color:#666; color:#FFF">
															<tr>
                                                            	<th scope="col" colspan="4"><center> Balance Sheet - May 2018 </center></th>
                                                                
															</tr>
														</thead>
                                                        <tbody>
                                                        	<tr>
                                                            	<th scope="col" colspan="2"><center> Assets </center></th>
																<th scope="col" colspan="2"><center> Liabilities </center></th>
															</tr>
                                                        </tbody>
                                                        <tbody>
                                                        	<tr>
                                                            	<th scope="col"><center> Current Assets </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" /> </center></th>
                                                                <th scope="col"><center> Current Liabilities </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" /> </center></th>
															</tr>
                                                        </tbody>
                                                        <tbody>
                                                        	<tr>
                                                            	<th scope="col"><center> Investments </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" /> </center></th>
                                                                <th scope="col"><center> Long Term Liabilities </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" /> </center></th>
															</tr>
                                                        </tbody>
                                                        <tbody>
                                                        	<tr>
                                                            	<th scope="col"><center> Inventories </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" /> </center></th>
                                                                <th scope="col"><center> Total Liabilities </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" readonly="readonly" /> </center></th>
															</tr>
                                                        </tbody>
                                                        <tbody>
                                                        	<tr>
                                                            	<th scope="col"><center> Intagible Assets </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" /> </center></th>
                                                                <th scope="col" colspan="2"><center>  </center></th>
															</tr>
                                                        </tbody>
                                                        <tbody>
                                                        	<tr>
                                                            	<th scope="col"><center> Bank Balance </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" /> </center></th>
                                                                <th scope="col" colspan="2"><center> Owner's Equity </center></th>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                        	<tr>
                                                            	<th scope="col"><center> Other Assets </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" /> </center></th>
                                                                <th scope="col"><center> Total Owner's Equity </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" /> </center></th>
															</tr>
                                                        </tbody>
                                                        <thead style=" background-color:#666; color:#FFF">
															<tr>
                                                            	<th scope="col"><center> Total Assets </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control" readonly="readonly"/> </center></th>
                                                                <th scope="col"><center> Total Owner's Equity and Liabilities </center></th>
																<th scope="col"><center> <input style="width:250px" type="number" class="form-control"  readonly="readonly"/> </center></th>
															</tr>
														</thead>
                                            </table>
											
									</div>
								</div>
						</div>
					</div>
				</div>
                
 

 
<?php include_once 'staff-footer.php'; ?>