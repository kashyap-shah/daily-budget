<?php
session_start();
include_once "query.php";

if (session_id() == '' || !isset($_SESSION['username'])) {?>
    <a class="btn btn-info" href="login.php">Login</a><?php
}else {?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Daily Budget</title>

        <!-- icon -->
        <link rel="icon" href="images/logo.png" type="image/x-icon">

        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

        <!-- jquery -->
        <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        
        <!-- validation js -->
        <script src="js/validation.js" ></script>
    </head>
    <body>
        <div class="container bg-dark text-white border rounded border-2 border-dark my-3">
            <div class="m-2">
                <div class="text-center">
                    <p>Welcome <?php echo $_SESSION['username']; ?></p>
                    <a class="btn btn-sm btn-info" href="logout.php">Logout</a>
                    <hr>
                </div>
                <h2>Budget</h2>
                <p><?php
                        while($row = mysqli_fetch_assoc($bank)) {?>
                <small class="text-muted">Last Updated: <?php 
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $row["dateupdated"]);
                echo $date->format('d/m/Y (l) - h:i A'); ?></small></p>
                <div class="card-group row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="card h-100 bg-white text-dark">
                            <div class="card-header"><h5 class="card-title">CASH</h5></div>
                            <!-- <img src="images/cash.png" class="p-3 card-img-top" alt="..."><hr> -->
                            <div class="card-body">
                                <p class="card-text">&#8377; <?php echo $row["cash"] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 bg-white text-dark">
                        <div class="card-header"><h5 class="card-title">SBI</h5></div>
                        <!-- <img src="images/bank.png" class="card-img-top" alt="..."><hr> -->
                        <div class="card-body">
                            <p class="card-text">&#8377; <?php echo $row["sbi"] ?></p>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 bg-white text-dark">
                        <div class="card-header"><h5 class="card-title">IDBI</h5></div>
                        <!-- <img src="images/bank.png" class="card-img-top" alt="..."><hr> -->
                        <div class="card-body">
                            <p class="card-text">&#8377; <?php echo $row["idbi"] ?></p>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 bg-white text-dark">
                        <div class="card-header"><h5 class="card-title">Paytm</h5></div>
                        <!-- <img src="images/mobile.png" class="card-img-top" alt="..."><hr> -->
                        <div class="card-body">
                            <p class="card-text">&#8377; <?php echo $row["paytm"] ?></p>
                        </div>
                        </div>
                    </div>
                </div><?php 
                } ?>
                <div class="mt-2">
                    <button name="credit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#creditModal">Credit</button>
                    <button name="debit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#debitModal">Debit</button>
                </div>
                <hr>
                <h2>Dashboard</h2>
                <div class="rounded bg-light table-responsive">                    
                    <table class=" table table-light table-striped">
                        <thead>
                            <th>Credit/Debit</th>
                            <th>Transaction From</th>
                            <th>Amount</th>
                            <th>Summary</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($transactions)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['typeoftransaction'] . '</td>';
                                    echo '<td>' . $row['transactionfrom'] . '</td>';
                                    echo '<td>' . $row['amount'] . '</td>';
                                    echo '<td>' . $row['summary'] . '</td>';
                                    echo '<td>' . $row['dateupdated'] . '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Credit Modal -->
                <div class="modal fade border border-5 border-success" id="creditModal" tabindex="-1" aria-labelledby="creditModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-dark">
                            <div class="modal-header">
                                <h5 class="modal-title" id="creditModalLabel">Credit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div id="msg"></div>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="frmCredit" onsubmit="return validate('frmCredit')" method="post">
                                <label for="bankName" class="form-label">Select Type:</label>
                                <select name="bankName" id="bankName" class="form-control" aria-describedby="selectHelp">
                                    <option value="cash">Cash</option>
                                    <option value="sbi">SBI</option>
                                    <option value="idbi">IDBI</option>
                                    <option value="paytm">Paytm</option>
                                </select>
                                <div id="selectHelp" class="form-text">Press the above field to select.</div>
                                <label for="txtAmount" class="form-label">Amount</label>
                                <input type="text" name="txtAmount" id="txtAmount" class="form-control">
                                <label for="txtSummary" class="form-label">Credited From Summary</label>
                                <textarea name="txtSummary" id="txtSummary" cols="20" rows="5" class="form-control"></textarea>
                                <label for="dateCredit" class="form-label">Date</label>
                                <input type="text" name="dateCredit" id="dateCredit" class="form-control">
                                <script>
                                    $(document).ready(function() {
                                        $(function() {
                                            $( "#dateCredit" ).datepicker({
                                                dateFormat: 'dd/mm/yy',
                                                changeMonth: true,
                                                changeYear: true,
                                                yearRange: '2020:+0'
                                            });
                                        });
                                    })
                                </script>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="btnCredit" class="btn btn-primary">Save</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Debit Modal -->
                <div class="modal fade border border-5 border-danger" id="debitModal" tabindex="-1" aria-labelledby="debitModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-dark">
                            <div class="modal-header">
                                <h5 class="modal-title" id="debitModalLabel">Debit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="frmDebit" onsubmit="return validate('frmDebit')" method="post">
                                <label for="bankName" class="form-label">Select Type:</label>
                                <select name="bankName" id="bankName" class="form-control" aria-describedby="selectHelp">
                                    <option value="cash">Cash</option>
                                    <option value="sbi">SBI</option>
                                    <option value="idbi">IDBI</option>
                                    <option value="paytm">Paytm</option>
                                </select>
                                <div id="selectHelp" class="form-text">Press the above field to select.</div>
                                <label for="txtAmount" class="form-label">Amount</label>
                                <input type="text" name="txtAmount" id="txtAmount" class="form-control">
                                <label for="txtSummary" class="form-label">Debited To Summary</label>
                                <textarea name="txtSummary" id="txtSummary" cols="20" rows="5" class="form-control"></textarea>
                                <label for="dateDebit" class="form-label">Date</label>
                                <input type="text" name="dateDebit" id="dateDebit" class="form-control">
                                <script>
                                    $(document).ready(function() {
                                        $(function() {
                                            $( "#dateDebit" ).datepicker({
                                                dateFormat: 'dd/mm/yy',
                                                changeMonth: true,
                                                changeYear: true,
                                                yearRange: '2020:+0'
                                            });
                                        });
                                    })
                                </script>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="btnDebit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html><?php 
}?>