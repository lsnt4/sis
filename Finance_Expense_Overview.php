<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Income_Overview.php" class="nav-item nav-link"><strong> Income Overview </strong></a>
                        	<a class="nav-item nav-link active"><strong> Expense Overview </strong></a>
                            <a href="Finance_Payroll_Overview.php" class="nav-item nav-link"><strong> Payroll Overview </strong></a>
                            <a href="Finance_Leave_Overview.php" class="nav-item nav-link"><strong> Leave Overview </strong></a>
                            <a href="Finance_Bank_Accounts_Overview.php" class="nav-item nav-link"><strong> Bank Accounts Overview </strong></a>
                            <a href="Finance_Acounting_Overview.php" class="nav-item nav-link"><strong> Accounting Overview </strong></a>				
						</div>
					</nav>
                    
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
                        	<div class="card bg-light mb-3">
								<div class="card-header">Expense Overview</div>
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
        text: 'Expenses from Each Deparments'
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
		$sql = "select catogory, SUM(amount) as total from expenses group by catogory";
		$result = $conn->query($sql);
		$i = 0;
		$t = " ";
		
		while($row = $result->fetch_assoc()){
		
		#echo $row["catogory"]." ".$row["total"];
		$t .= "{   name: '".$row["catogory"]."', y: ".$row["total"];
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
								<div class="card-header">Expense Overview</div>
								<div class="card-body">

<div id="container1"></div>
<button id="plain" class="btn btn-danger" >Plain View</button>
<button id="inverted" class="btn btn-success">Inverted View</button>
<button id="polar" class="btn btn-info">Polar View</button>



		<script type="text/javascript">

var chart = Highcharts.chart('container1', {

    title: {
        text: 'Monthly Expenses'
    },

    subtitle: {
        text: 'Plain View'
    },

    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    series: [{
        type: 'column',
        colorByPoint: true,
		<?php
		$m = " ";
		$s = 1;
		
		while($s <= 12){
			
			$sql_month = "SELECT 
  				SUM(amount) as tot 
				FROM expenses
				WHERE MONTH(added_date) = '$s'";
			$result_month = $conn->query($sql_month);
			$row_month = $result_month->fetch_assoc();
			if(empty($row_month["tot"])){
				$m .= "0,";
			}else{
			#$row_month = $result_month->fetch_assoc();
			#echo $row_month["tot"];
			$m .= $row_month["tot"].",";
			}
			$s++;
			}
			
		 ?>
        data: [<?php echo $m; ?>],
        showInLegend: false
    }]

});


$('#plain').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: false
        },
        subtitle: {
            text: 'Plain View'
        }
    });
});

$('#inverted').click(function () {
    chart.update({
        chart: {
            inverted: true,
            polar: false
        },
        subtitle: {
            text: 'Inverted View'
        }
    });
});

$('#polar').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: true
        },
        subtitle: {
            text: 'Polar View'
        }
    });
});

		</script>

                                    
                                </div>
                                </div>
                                </div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>