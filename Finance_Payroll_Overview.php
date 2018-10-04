<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Income_Overview.php" class="nav-item nav-link"><strong> Income Overview </strong></a>
                        	<a href="Finance_Expense_Overview.php" class="nav-item nav-link"><strong> Expense Overview </strong></a>
                            <a class="nav-item nav-link active"><strong> Payroll Overview </strong></a>
                            <a href="Finance_Leave_Overview.php" class="nav-item nav-link"><strong> Leave Overview </strong></a>
                            <a href="Finance_Bank_Accounts_Overview.php" class="nav-item nav-link"><strong> Bank Accounts Overview </strong></a>
                            <a href="Finance_Acounting_Overview.php" class="nav-item nav-link"><strong> Accounting Overview </strong></a>				
						</div>
					</nav>
                    
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
                        	<div class="card bg-light mb-3">
								<div class="card-header">Payroll Overview</div>
								<div class="card-body">
								
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/Finance_Charts/code/highcharts.js"></script>
<script src="assets/Finance_Charts/code/modules/exporting.js"></script>
<script src="assets/Finance_Charts/code/modules/export-data.js"></script>
<script src="assets/Finance_Charts/code/highcharts-more.js"></script>

<div id="container" style="min-width: 10px; height: 400px; max-width: 600px; margin: 0 auto"></div>

		<script type="text/javascript">

// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Total Payroll from Each Month'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Expense(Rs.)',
        colorByPoint: true,
        data: [
		<?php 
		$sql = "select month, SUM(net_sal) as total from payroll group by month";
		$result = $conn->query($sql);
		$i = 0;
		$t = " ";
		
		while($row = $result->fetch_assoc()){
		
		#echo $row["catogory"]." ".$row["total"];
		$t .= "{   name: '".$row["month"]."', y: ".$row["total"];
		if($i == 0){
		$t .= ", sliced: true, selected: true";
		}
		$t .= "},";
		$i++;		
		}
		
		
		echo $t; 
		?>
		]
    }]
});
		</script>

                                    
                                </div>
                                </div>
                                </div>
                                
                                <div class="card bg-light mb-4">
								<div class="card-header">Payroll Overview</div>
								<div class="card-body">

<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



		<script type="text/javascript">

Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Payroll'
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
	function getMonthString($m){
    if($m==1){
        return "January";
    }else if($m==2){
        return "February";
    }else if($m==3){
        return "March";
    }else if($m==4){
        return "April";
    }else if($m==5){
        return "May";
    }else if($m==6){
        return "June";
    }else if($m==7){
        return "July";
    }else if($m==8){
        return "August";
    }else if($m==9){
        return "September";
    }else if($m==10){
        return "October";
    }else if($m==11){
        return "November";
    }else if($m==12){
        return "December";
    }
} 	
	$tot_net_sal = " ";
	$tot_all = " ";
	$tot_emp_epf = " ";
	$tot_emp_tax = " ";
	$tot_com_epf = " ";
	$tot_com_etf = " ";
		$s = 1;
		
		while($s <= 12){
			$dateObj   = DateTime::createFromFormat('!m', $s);
			$monthName = $dateObj->format('F');
			$sql_month = "SELECT month,
  				SUM(net_sal) as tot_net_sal,
				SUM(allowance) as tot_all,
				SUM(employee_epf) as tot_emp_epf,
				SUM(employee_tax) as tot_emp_tax,
				SUM(employer_epf) as tot_com_epf,
				SUM(employer_etf) as tot_com_etf
				FROM payroll
				WHERE month = '".getMonthString($s)."'";
				#echo $monthName;
			$result_month = $conn->query($sql_month);
			$row_month = $result_month->fetch_assoc();
			if(empty($row_month["month"])){
				$tot_net_sal .= "0,";
				$tot_all .= "0,";
				$tot_emp_epf .= "0,";
				$tot_emp_tax .= "0,";
				$tot_com_epf .= "0,";
				$tot_com_etf .= "0,";
			}else{
			#$row_month = $result_month->fetch_assoc();
			#echo $row_month["tot"];
			$tot_net_sal .= $row_month["tot_net_sal"].",";
			$tot_all .= $row_month["tot_all"].",";
			$tot_emp_epf .= $row_month["tot_emp_epf"].",";
			$tot_emp_tax .= $row_month["tot_emp_tax"].",";
			$tot_com_epf .= $row_month["tot_com_epf"].",";
			$tot_com_etf .= $row_month["tot_com_etf"].",";
			}
			$s++;
			}
	?>
    series: [{
        name: 'Net Salary',
        data: [<?php echo $tot_net_sal; ?>]

    }, {
        name: 'Allowance',
        data: [<?php echo $tot_all; ?>]

    }, {
        name: 'Employee EPF',
        data: [<?php echo $tot_emp_epf; ?>]

    },{
        name: 'Employee Tax',
        data: [<?php echo $tot_emp_tax; ?>]

    },{
        name: 'Company EPF',
        data: [<?php echo $tot_com_epf; ?>]

    }, {
        name: 'Company ETF',
        data: [<?php echo $tot_com_etf; ?>]

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