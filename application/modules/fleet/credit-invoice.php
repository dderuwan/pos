<?php
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish database connection
    // Include your database connection file

    // Get BL No and Shipper's name from POST data
    $invoiceNum = $_POST['invoiceNum'];
    $companyName = $_POST['companyName'];


    // Define the location
    $location = "http://localhost/Flotilla-logistic/assets/$invoiceNum.html";

    // Prepare and execute SQL query to insert data
    $query = "INSERT INTO creadit_invoice(invoiceNum,companyName,location) VALUES (?,?,?)";
    $stmt = $link->prepare($query);
    $stmt->bind_param("sss", $invoiceNum, $companyName, $location);

    if ($stmt->execute()) {
        echo '<script>alert("Invoice Saved Successfully")</script>';
        echo "Data saved successfully.";
        header("Location: credit-invoice-list.php");

    } else {
        echo '<script>alert("Invoice Save Error")</script>';
        echo "Error saving data.";
    }

    // Close the database connection
    $stmt->close();
    $link->close();
}
?>

<head>

    <title>
        <?php echo $language["Dashboard"]; ?> | New Shaheen LLC - Admin & Dashboard
    </title>

    <?php include 'layouts/head.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
        type="text/css" />
    <?php include 'layouts/head-style.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>




    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="assets/styles.css" />
</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?php
                $maintitle = "Invoice";
                $title = "Credit Invoice";
                ?>
                <?php include 'layouts/breadcrumb.php'; ?>
                <!-- end page title -->

                <script>
                    // Parse the JSON data
                    var totalAmountData = <?php echo $totalAmountJson; ?>;

                    // Access the total amount
                    var totalAmount = totalAmountData.totalAmount;

                    // Initialize your charts here using the configuration from chart-configuration.js
                    new ApexCharts(document.querySelector("#spark1"), spark1).render();
                    // Initialize other charts if needed
                </script>

                <div class="col-lg-12">

                    <style>
                        table {
                            font-family: Arial, sans-serif;
                            border: 2px solid blue;
                            border-collapse: collapse;
                            width: 60%;
                            color: black;
                        }


                        tr {
                            border-left: none;
                            border-right: none;
                            vertical-align: top;

                        }

                        td,
                        th {
                            border: 1px solid blue;
                            text-align: left;
                            padding: 8px;
                            font-size: 12px;
                            border-left: none;
                            border-right: none;
                        }

                        .invoiceDiv {
                            display: flex;
                            align-items: center;
                            justify-content: center;

                        }

                        /* Style for the input fields */
                        .form-control-inline {
                            border: none;
                            padding: 0;
                            width: 100%;
                        }

                        .td-div {
                            display: flex;
                            align-items: center;
                            /* flex-direction: column; */
                            width: 260px;
                            justify-content: space-between;

                        }

                        .td-div input {
                            width: 150px
                        }

                        @media print {}
                    </style>

                    <div class="invoiceDiv">
                        <form method="post" id="invoiceForm" class="print-container m-3"
                            onsubmit="return validateForm()">
                            <div class="print-container m-3" id="invoiceModalContent">
                                <table>

                                    <tr>
                                        <td colspan="2">
                                            <div class="td-div">
                                                <span> Invoice Number:</span><input id="invoiceNum" name="invoiceNum"
                                                    type="text">
                                            </div>
                                            <div class="td-div">
                                                <span> Date:</span><input id="dateInvoice" name="dateInvoice"
                                                    type="date">

                                            </div>

                                        </td>
                                        <td colspan="1"></td>
                                        <td colspan="2">
                                            <div class="logo1">
                                                <div><img src="logo.png" alt="" width="200px">
                                                </div>

                                                <label for="" style="font-size:10px;line-height: 12px;color:blue">167,
                                                    Address1, <br>Tel: (+94) 112 111 111<br> Mobile: (+94) 777 000
                                                    111<br> Email:
                                                    info@newshaheen.com Web:
                                                    www.newshaheen.com</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <b>Bill from:</b>

                                            </br>
                                            <div class="td-div">
                                                <span>Company Name</span> <input type="text" id="companyName"
                                                    name="companyName">
                                            </div>
                                            <div class="td-div">
                                                <span>Street Address</span> <input type="textArea" id="strAddress"
                                                    name="strAddress">
                                            </div>
                                            <div class="td-div">
                                                <span>Zip Code </span> <input type="text" id="zip" name="zip">
                                            </div>
                                            <div class="td-div">
                                                <span>Phone Number</span> <input type="text" id="phoneNum"
                                                    name="phoneNum">
                                            </div>

                                        </td>
                                        <td colspan="1"></td>
                                        <td colspan="2"><b>Bill to:</b>
                                            </br>
                                            <div class="td-div">
                                                <span>Customer Name</span> <input type="text" id="cusName"
                                                    name="cusName">
                                            </div>
                                            <div class="td-div">
                                                <span>Street Address</span> <input type="textArea" id="cusAddress"
                                                    name="cusAddress">
                                            </div>
                                            <div class="td-div">
                                                <span>Zip Code </span> <input type="text" id="cusZip" name="cusZip">
                                            </div>
                                            <div class="td-div">
                                                <span>Phone Number</span> <input type="text" id="cusPhone"
                                                    name="cusPhone">
                                            </div>
                                    </tr>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Tax</th>
                                        <th>Amount</th>
                                    </tr>


                                    <tr>
                                        <td colspan="1"><textarea rows="20" cols="20" id="test1"
                                                name="test1"></textarea></td>
                                        <td colspan="1"><textarea rows="20" cols="20" id="test2"
                                                name="test2"></textarea></td>
                                        <td colspan="1"><textarea rows="20" cols="20" id="test3"
                                                name="test3"></textarea></td>
                                        <td colspan="1"><textarea rows="20" cols="20" id="test4"
                                                name="test4"></textarea></td>
                                        <td colspan="1"><textarea rows="20" cols="20" id="test5"
                                                name="test5"></textarea></td>
                                    </tr>


                                    <tr>
                                        <td colspan="3" rowspan="5">Terms & Conditions:</td>
                                        <td colspan="2">
                                            <div class="td-div">
                                                <span>Subtotal:</span><input type="text" id="subTotal" name="subTotal">
                                            </div>
                                            <div class="td-div">
                                                <span>Discount:</span><input type="text" id="discount" name="discount">
                                            </div>
                                            <div class="td-div">
                                                <span>Tax:</span><input type="text" id="tax" name="tax">
                                            </div>
                                            <div class="td-div">
                                                <span>Paid:</span><input type="text" id="paid" name="paid">
                                            </div>

                                        </td>
                                    </tr>


                                    <tr>

                                        <td colspan="2">
                                            <div class="td-div">
                                                <span>
                                                    Total</span><input type="text" id="total" name="total">
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- <button id="generateRowButton">Generate Row</button> -->

                                </table>

                            </div>
                            <div class="text-end" style="margin-right:10px">

                                <button type="submit" id="submitButton" style="width:100px;margin-top:10px"
                                    class="btn btn-primary" onclick="printInvoice()">Print</button>
                            </div>
                        </form>
                    </div>

                    <!-- Add Print button -->


                    </form>
                    <script>
                        function validateForm() {
                            // var blNo = document.getElementById('blNo').value;
                            // var submitButton = document.getElementById('submitButton');
                            // if (blNo === "") {
                            //     document.getElementById('blNoError').innerHTML = "BL No is required.";
                            //     alert("BL No is required.");
                            //     submitButton.disabled = true;
                            //     return false;
                            // } else {
                            //     document.getElementById('blNoError').innerHTML = "";
                            //     submitButton.disabled = false;
                            //     return true;
                            // }
                        }

                        function printInvoice() {
                            var invoiceContent = document.getElementById('invoiceModalContent').innerHTML;

                            // Create a new window for printing
                            var printWindow = window.open('', '_blank');

                            // Write the HTML content with inline styles for printing
                            printWindow.document.write('<html><head><title>Print Invoice</title>');
                            printWindow.document.write(
                                '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">'
                            );
                            printWindow.document.write('<style>' +
                                'body { font-family: Arial, sans-serif;}' +

                                'table { font-family: Arial, sans-serif; border: 1px solid black; border-collapse: collapse;heigt:1000px; }' +
                                'tr{border-left: none; border-right: none;vertical-align;}' +
                                'table input,textarea{border:none;font-weight:600;color:black}' +
                                'td, th { border: 1px solid black; text-align: left; padding: 8px; font-size: 14px; }' +
                                '.form-control-inline { border: none; padding: 0; width: 100%; }' +
                                '.company-details {padding-top:80px}' +
                                '.td-div{display: flex;align-items: center;width: 260px;justify-content: space-between;}' +
                                '.td-div input{width: 150px;}' +
                                '.form-control-inline{border: none;padding: 0;width: 100%;}' +
                                '.BL-number {display: flex; align-items: center; gap: 5px; padding: 0px 10px 0px 10px; }' +
                                '.BL-number label { margin-top: 10px; }' +
                                '.BL-number input { width: 100px; }' +
                                '.logo1 { display: flex; flex-direction: column; justify-content: center; text-align: center; }' +
                                '.shipper { display: flex; flex-direction: column; }' +
                                '/* Add more CSS styles here */' +
                                '</style></head><body>');


                            // Create printable content with input values
                            var invoiceNum = document.getElementById('invoiceNum').value;
                            var dateInvoice = document.getElementById('dateInvoice').value;
                            var companyName = document.getElementById('companyName').value;
                            var strAddress = document.getElementById('strAddress').value;
                            var zip = document.getElementById('zip').value;
                            var phoneNum = document.getElementById('phoneNum').value;
                            var cusName = document.getElementById('cusName').value;
                            var cusAddress = document.getElementById('cusAddress').value;
                            var cusZip = document.getElementById('cusZip').value;
                            var cusPhone = document.getElementById('cusPhone').value;
                            var test1 = document.getElementById('test1').value;
                            var test2 = document.getElementById('test2').value;
                            var test3 = document.getElementById('test3').value;
                            var test4 = document.getElementById('test4').value;
                            var test5 = document.getElementById('test5').value;
                            var subTotal = document.getElementById('subTotal').value;
                            var discount = document.getElementById('discount').value;
                            var tax = document.getElementById('tax').value;
                            var paid = document.getElementById('paid').value;
                            var total = document.getElementById('total').value;



                            var printableContent = `

<html>
 <head>
  <title>Print Invoice</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                /* Your CSS styles here */
            </style>
        </head>
         <body>
        <div class="main-div">
            <div class="print-container" style="">
         <table>

                                <tr>
                                    <td style="vertical-align:top" colspan="3">
                                        <div class="td-div">
                                            <span> Invoice Number:</span><input id="invoiceNum" name="invoiceNum" placeholder="${invoiceNum}"
                                                type="text">
                                        </div>
                                        <div class="td-div">
                                            <span> Date:</span><input id="dateInvoice" name="dateInvoice" type="date" value="${dateInvoice}">

                                        </div>

                                    </td>
                                   
                                        <td  colspan="2">
                                              <div class="logo1">
                                                    <div><img src="logo.png" alt="" width="200px">
                                                    </div>

                                                    <label for=""
                                                        style="font-size:10px;line-height: 12px;color:blue">167,
                                                        Maharagama Road,
                                                        Dehiwala, <br>Tel: (+94) 112
                                                        724
                                                        485<br> Mobile: (+94) 777 876 582<br> Email:
                                                        info@NewShaheenLLC .com Web:
                                                        www.flatillalogistics.com</label>
                                                </div>
                                        </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <b>Bill from:</b>

                                        </br>
                                        <div class="td-div">
                                            <span>Company Name</span> <input type="text" id="companyName"
                                                name="companyName" placeholder="${companyName}">
                                        </div>
                                        <div class="td-div">
                                            <span>Street Address</span> <input type="textArea" id="strAddress"
                                                name="strAddress" placeholder="${strAddress}">
                                        </div>
                                        <div class="td-div">
                                            <span>Zip Code </span> <input type="text" id="zip" name="zip"placeholder="${zip}">
                                        </div>
                                        <div class="td-div">
                                            <span>Phone Number</span> <input type="text" id="phoneNum" name="phoneNum" placeholder="${phoneNum}">
                                        </div>

                                    </td>
                                    <td colspan="2"><b>Bill to:</b>
                                        </br>
                                        <div class="td-div">
                                            <span>Customer Name</span> <input type="text" id="cusName" name="cusName" placeholder="${cusName}">
                                        </div>
                                        <div class="td-div">
                                            <span>Street Address</span> <input type="textArea" id="cusAddress"
                                                name="cusAddress" placeholder="${cusAddress}">
                                        </div>
                                        <div class="td-div">
                                            <span>Zip Code </span> <input type="text" id="cusZip" name="cusZip" placeholder="${cusZip}">
                                        </div>
                                        <div class="td-div">
                                            <span>Phone Number</span> <input type="text" id="cusPhone" name="cusPhone" placeholder="${cusPhone}">
                                        </div>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Tax</th>
                                    <th>Amount</th>
                                </tr>
                               
                              <tr>
                                        <td colspan="1"><textarea rows="20" cols="20"id="test1"name="test1" placeholder="${test1}"></textarea></td>
                                        <td colspan="1"><textarea rows="20" cols="20"id="test2"name="test2" placeholder="${test2}"></textarea></td>
                                        <td colspan="1"><textarea rows="20" cols="20"id="test3"name="test3" placeholder="${test3}"></textarea></td>
                                        <td colspan="1"><textarea rows="20" cols="20"id="test4"name="test4" placeholder="${test4}"></textarea></td>
                                        <td colspan="1"><textarea rows="20" cols="20"id="test5"name="test5" placeholder="${test5}"></textarea></td>
                                    </tr>


                                <tr>
                                    <td colspan="4" rowspan="5">Terms & Conditions:</td>
                                    <td colspan="1">
                                        <div class="td-div">
                                            <span>Subtotal:</span><input type="text" id="subTotal" placeholder="${subTotal}">
                                        </div>
                                        <div class="td-div">
                                            <span>Discount:</span><input type="text" id="discount" placeholder="${discount}">
                                        </div>
                                        <div class="td-div">
                                            <span>Tax:</span><input type="text"id="tax" placeholder="${tax}">
                                        </div>
                                        <div class="td-div">
                                            <span>Paid:</span><input type="text"id="paid" placeholder="${paid}">
                                        </div>

                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="5">
                                        <div class="td-div">
                                            <span>
                                                Total</span><input type="text"id="total" placeholder="${total}">
                                        </div>
                                    </td>
                                </tr>

                                <!-- <button id="generateRowButton">Generate Row</button> -->

                            </table>
                             </div>
            </div>
        </body>
        </html>
    `;

                            printWindow.document.write(printableContent);


                            printWindow.document.write('</div>');
                            printWindow.document.write('<div class="shipper">');

                            // printWindow.document.write(invoiceContent);
                            printWindow.document.write('</body></html>');
                            printWindow.document.close();

                            // Print the content in the new window
                            printWindow.print();
                            window.location.href = "credit-invoice-list.php";

                            // Now, send the data to the server using AJAX
                            $.ajax({
                                type: 'POST',
                                url: 'save_printed_content_credit_invoice.php', // Update with the correct PHP script path
                                data: {
                                    content: printWindow.document.documentElement.innerHTML,
                                    filename: invoiceNum
                                },
                                success: function (response) {
                                    console.log('File saved successfully.');
                                },
                                error: function () {
                                    console.log('Error saving file.');
                                }
                            });

                        }
                    </script>


                    <!-- end Print button -->











                </div>



                <script>
                    // Function to generate the table row
                    function generateTableRow() {
                        var table = document.querySelector('table'); // Get the table element
                        var newRow = document.createElement('tr'); // Create a new table row

                        // Create and append the table data cells
                        var cell1 = document.createElement('td');
                        cell1.textContent = 'x';
                        newRow.appendChild(cell1);

                        var cell2 = document.createElement('td');
                        cell2.textContent = 'y';
                        newRow.appendChild(cell2);

                        var cell3 = document.createElement('td');
                        cell3.textContent = 'z';
                        newRow.appendChild(cell3);

                        var cell4 = document.createElement('td');
                        cell4.textContent = 'a';
                        newRow.appendChild(cell4);

                        var cell5 = document.createElement('td');
                        cell5.textContent = 'b';
                        newRow.appendChild(cell5);

                        // Append the new row to the table
                        table.appendChild(newRow);
                    }

                    // Add a click event listener to the button
                    var generateButton = document.getElementById('generateRowButton');
                    generateButton.addEventListener('click', generateTableRow);
                </script>



            </div>
            <!-- end col -->

            <!-- end card -->
        </div>
        <!-- end col -->
    </div><!-- end row -->

</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<?php include 'layouts/footer.php'; ?>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->
<?php include 'layouts/right-sidebar.php'; ?>

<?php include 'layouts/vendor-scripts.php'; ?>


<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>



</body>

</html>