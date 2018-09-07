<?php include_once 'staff-header.php'; ?>
    <div class="col-md-10">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
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
                                <p class="card-text">View Students who have attended to school during a specific period.</p>
                                <form action="....." method="get">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Start Date</small>
                                        <input type="date" name="startdate" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <small class="form-text text-muted">End Date</small>
                                        <input type="date" name="enddate" class="form-control">
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
                                <form action="...." method="get">
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