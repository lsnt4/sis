<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	
	$tot = 0;
	$income_tot = "select amount from incomes";
	$result_tot = $conn->query($income_tot);
	while($row_tot = $result_tot->fetch_assoc()){
		$tot = $tot + $row_tot["amount"];
	}	
	
	$tot_exp = 0;
	$exp_tot = "select amount from expenses";
	$result_tot_exp = $conn->query($exp_tot);
	while($row_tot_exp = $result_tot_exp->fetch_assoc()){
		$tot_exp = $tot_exp + $row_tot_exp["amount"];
	}
?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Income_Overview.php" class="nav-item nav-link"><strong> Income Overview </strong></a>
                        	<a href="Finance_Expense_Overview.php" class="nav-item nav-link"><strong> Expense Overview </strong></a>
                            <a href="Finance_Payroll_Overview.php" class="nav-item nav-link"><strong> Payroll Overview </strong></a>
                            <a href="Finance_Leave_Overview.php" class="nav-item nav-link"><strong> Leave Overview </strong></a>
                            <a href="Finance_Bank_Accounts_Overview.php" class="nav-item nav-link"><strong> Bank Accounts Overview </strong></a>
                            <a class="nav-item nav-link active"><strong> Accounting Overview </strong></a>				
						</div>
					</nav>
                    
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
								
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/Finance_Charts/code/highcharts.js"></script>
<script src="assets/Finance_Charts/code/modules/exporting.js"></script>
<script src="assets/Finance_Charts/code/modules/export-data.js"></script>
<script src="assets/Finance_Charts/code/highcharts-more.js"></script>
<script src="assets/Finance_Charts/code/modules/data.js"></script>
<script src="assets/Finance_Charts/code/modules/drilldown.js"></script>


                              
         <div class="card bg-light mb-3">
								<div class="card-header">Accounting Overview</div>
								<div class="card-body">
								

<div id="container" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>

		<script type="text/javascript">

// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Profit or Loss Calculation'
    },
    subtitle: {
        text: 'Total Accounting'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.2f} LKR'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} LKR</b> of total<br/>'
    },

    "series": [
        {
            "name": "Accounting",
            "colorByPoint": true,
            "data": [
                {
                    "name": "Incomes",
                    "y": <?php echo $tot; ?>,
                    "drilldown": "Incomes"
                },
                {
                    "name": "Expenses",
                    "y": <?php echo $tot_exp; ?>,
                    "drilldown": "Expenses"
                }
            ]
        }
    ],
    "drilldown": {
        "series": [
            {
                "name": "Incomes",
                "id": "Incomes",
				<?php 
		$sql = "select catogory, SUM(amount) as total from incomes group by catogory";
		$result = $conn->query($sql);
		$i = 0;
		$t = " ";
		
		while($row = $result->fetch_assoc()){
		$t .= "[ '".$row["catogory"]."',".$row["total"]."],";
		}?>
                "data": [
        <?php
		echo $t; 
		?>
                ]
            },
            {
                "name": "Expenses",
                "id": "Expenses",
				<?php 
		$sql = "select catogory, SUM(amount) as total from expenses group by catogory";
		$result = $conn->query($sql);
		$i = 0;
		$t = " ";
		
		while($row = $result->fetch_assoc()){
		$t .= "[ '".$row["catogory"]."',".$row["total"]."],";
		}?>
                "data": [
        <?php
		echo $t; 
		?>
                    
                ]
            }
        ]
    }
});
		</script>
	</body>

                                    
                                </div>
                                </div>
                                </div>
           
                                <div class="card bg-light mb-4">
								<div class="card-header">Accounting Overview</div>
								<div class="card-body">

<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



		<script type="text/javascript">

Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Bank Transactions'
    },
    subtitle: {
        text: ' '
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Amount (LKR)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} LKR</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
	<?php
	 	
	$tot_deposit = " ";
	$tot_withdraw = " ";
		$s = 1;
		$f = 1;
		
		while($s <= 12){
			$sql_deposit = "SELECT 
  				SUM(amount) as tot_deposit
				FROM incomes
				WHERE MONTH(added_date) = '$s'";
			$result_deposit = $conn->query($sql_deposit);
			$row_deposit = $result_deposit->fetch_assoc();
			if(empty($row_deposit["tot_deposit"])){
				$tot_deposit .= "0,";
			}else{
			$tot_deposit .= $row_deposit["tot_deposit"].",";
			}
			$s++;
			}
			
			while($f <= 12){
			$sql_withdraw = "SELECT 
  				SUM(amount) as tot_withdraw
				FROM expenses
				WHERE MONTH(added_date) = '$f'";
			$result_withdraw = $conn->query($sql_withdraw);
			$row_withdraw = $result_withdraw->fetch_assoc();
			if(empty($row_withdraw["tot_withdraw"])){
				$tot_withdraw .= "0,";
			}else{
			$tot_withdraw .= $row_withdraw["tot_withdraw"].",";
			}
			$f++;
			}
	?>
    series: [{
        name: 'Deposit',
        data: [<?php echo $tot_deposit; ?>]

    }, {
        name: 'Withdrawals',
        data: [<?php echo $tot_withdraw; ?>]

    }]
});
		</script>
                                    
                                </div>
                                </div>
                                </div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>