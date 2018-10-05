			</div>
		</div>
		<div class="sll"><span class="sllm"></span><span class="sllo"></span><span class="sllg"></span></div>
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
		<script src="assets/js/cash_flow.js"></script>
        <script>
$(document).ready(function(e) {
    //variables
	var html = "<div>";
	html += '<div class="form-group row">';
	html += '<label class="col-sm-2 col-form-label">Account No.</label>';
	html +=	'<div class="col-sm-10">';
	html += '<div class="form-row">';
	html += '<div class="col-md-6">';
	html += '<input type="text" placeholder=" Account No. " class="form-control" name="ano[]" required>';
	html += '</div>';
	html += '</div>';
	html += '</div>';
	html += '</div>';
	html += '<div class="form-group row">';
	html += '<label class="col-sm-2 col-form-label">Bank Name</label>';
	html += '<div class="col-sm-10">';
	html += '<div class="form-row">';
	html += '<div class="col-md-6">';
	html += '<input type="text" placeholder=" Bank Name " class="form-control" name="bank_name[]" required>';
	html += '</div>';
	html += '</div>';
	html += '</div>';
	html += '</div>';
	html += '<div class="form-group row">';
	html += '<label class="col-sm-2 col-form-label">Branch Name</label>';
	html += '<div class="col-sm-10">';
	html += '<div class="form-row">';
	html += '<div class="col-md-3">';
	html += '<input type="text" placeholder=" Branch Name " class="form-control" name="branch_name[]" required>';
	html += '</div>';
    html += '<div class="col-md-3">';
	html += '<button id="remove" type="button" class="btn btn-danger">Remove the Account</button>';
	html += '</div>';
	html += '</div>';
	html += '</div>';
	
	html += '</div>';
	html += '<hr>';
	
	var max = 4;
	var x=1;
	
	//add more rows
	$("#add").click(function(e) {
		if(x<=max){
        $("#account_form").append(html);
		x++
		}else{
			alert(" You can't add more than five accounts at a time!... ");	
		}
    });
	//remove more rows
	$("#account_form").on('click','#remove',function(e){
			$(this).parent().parent().parent().parent().parent().remove();
			x--;
		});
});
</script>
	</body>
</html>
