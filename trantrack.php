<?php session_start(); include "php/connection.php"; // include "php/transaction.php"; if(!isset($_SESSION[ 'name'])){ header( 'Location: login.php'); } $user_id=$ _SESSION[ 'user_id']; $team_id=$ _SESSION[ 'team_id']; $tran_sql="SELECT * FROM `test`.`transaction` WHERE `team_id` = $team_id ORDER BY `timestamp`" ; $tran_result=m ysqli_query($conn, $tran_sql); ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jqc-1.12.4/dt-1.10.13/r-2.1.1/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap.min.css">

<body>

    <form id="add_form" onSubmit="php/transaction/addTransaction.php" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" id="type" name="type">
                        <option><i class="fa fa-plus" style="color: green; padding-right: 5px" value="Debit"></i>Debit</option>
                        <option><i class="fa fa-minus" style="color: red; padding-right: 5px" value="Credit" required></i>Credit</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Place/account</label>
                    <input type="text" class="form-control" id="place" name="place" placeholder="i.e. Walmart" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea type="text" class="form-control" rows="2" id="description" name="description"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label>Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="number" min="0.01" step="0.01" class="form-control" placeholder="Amount" id="amount" name="amount" required>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Upload Receipt</label>
                    <input type="file" id="receipt" name="receipt">
                </div>
                <button type="submit" class="btn btn-default">Post Transaction</button>
            </div>
        </div>
    </form>
    <div id='table_container'>

    </div>


    <div id="ModalReceipt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="receipt_title"></h4>
                </div>
                <div class="modal-body text-center">
                    <a id='receipt_link' href="" target="_blank">
                        <img class="" id='receipt_image' src="" style="width:100%" />
                    </a>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/w3data.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src='lib/moment.min.js'></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jqc-1.12.4/dt-1.10.13/r-2.1.1/datatables.min.js"></script>
    <script>
        function load_table() {
            $.ajax({
                type: "GET",
                url: "php/transaction/loadTransactions.php",
                data: {},
                success: function(html) {
                    $("#table_container").html($(html).filter('#transactionTableWrap').html());
                    $('#transactionTable').DataTable();
                    $('#transactionTable').on('draw.dt', function() {
                        $('td a').click(function(e) {
                            $('#ModalReceipt #receipt_image').prop("src", $(this).attr('data-img-url'));
                            $('#ModalReceipt #receipt_link').prop("href", $(this).attr('data-img-url'));
                            $('#ModalReceipt #receipt_title').text($(this).text());
                            $('#ModalReceipt').modal('show');
                        });
                    });

                    $('td a').click(function(e) {
                        $('#ModalReceipt #receipt_image').prop("src", $(this).attr('data-img-url'));
                        $('#ModalReceipt #receipt_link').prop("href", $(this).attr('data-img-url'));
                        $('#ModalReceipt #receipt_title').text($(this).text());
                        $('#ModalReceipt').modal('show');
                    });
                },
                error: function(xhr, status, error) {
                    alert(status);
                    alert(error);
                },
            });
        };
        $(document).ready(function() {
            load_table();
            $("#add_form").on('submit', function(e) {
                e.preventDefault();
                type = $('#add_form #type').val();
                place = $('#add_form #place').val();
                description = $('#add_form #description').val();
                date = $('#add_form #date').val();
                amount = $('#add_form #amount').val();
                $.ajax({
                    type: "POST",
                    url: "php/transaction/addTransaction.php",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    // data:{
                    //     type: type,
                    //     place: place,
                    //     description: description,
                    //     date: date,
                    //     amount: amount,
                    //     receipt:  $('#add_form #receipt').val(),
                    // },
                    success: function(event) {
                        // alert('Added Transaction')
                        // alert(type);
                        // $('#ModalSuccess #type').text(type);
                        // $('#ModalSuccess #place').val(place);
                        // $('#ModalSuccess #description').val(description);
                        // $('#ModalSuccess #date').val(date);
                        // $('#ModalSuccess #amount').val(amount);
                        // if(event){
                        //     $('#ModalSuccess #image_label').val('Image:');
                        //     $('#ModalSuccess #image').prop("src", event);
                        // }
                        // $('#ModalSuccess').modal('show');

                        $('#add_form #place').val(null);
                        $('#add_form #description').val(null);
                        $('#add_form #date').val(null);
                        $('#add_form #amount').val(null)
                        $('#add_form #receipt').val(null)

                        load_table();
                        // $('#ModalSuccess').modal('show');
                    }
                })
            });
        });
    </script>
</body>

</html>