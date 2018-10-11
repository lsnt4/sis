<?php include_once 'staff-header.php'; ?>
<script>
    function checkGrade(elem){

        if (elem.value >= 13) {
            elem.value = 13;
        }
    }
</script>

    <div class="col-md-10">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a href="student-add.php" class="nav-item nav-link disabled"> Add Student </a>
                <a href="student-search.php" class="nav-item nav-link disabled"> Search Student </a>
                <a class="nav-item nav-link active">Reports</a>
            </div>
        </nav>
        <div class="tab-content">
            <div class="tab-pane mt-4 show active">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-light mb-3">
                            <div class="card-header">Student History</div>
                            <div class="card-body">
                                <p class="card-text">View Students according to their Grade</p>
                                <form action="student-reports-grade.php" method="get">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Grade</small>
                                        <input type="number" name="studentGrade" class="form-control" oninput="checkGrade(this)">
                                    </div>
                                    <button class="btn btn-dark btn-block" type="submit">View Report</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light mb-3">
                            <div class="card-header">Student report</div>
                            <div class="card-body">
                                <p class="card-text">View student detials in a specific grade.</p>
                                <form action="student-reports-all.php">
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