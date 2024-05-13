<?php
require_once "layouts/config.php"; // Include your database connection file

$blNoError = ""; // Initialize BL Number error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get BL No and Shipper's name from POST data (Add input validation)
    $blNo = $_POST['blNo'];
    $shipperName = $_POST['shipperName'];
    $consigneeName = $_POST['consigneeName'];
    $address = $_POST['address'];

    // Validate BL Number (not empty and meets certain criteria)
    if (empty($blNo)) {
        $blNoError = "Please enter BL Number.";
    } else {
        // Define the location
        $location = "https://system.Flotillalogistics.com/assets/BILL OF LADING/$blNo.html";

        // Establish a database connection (you should include your database connection code here)

        // Check if the database connection was successful
        if ($link) {
            // Prepare and execute SQL query to insert data
            $query = "INSERT INTO invoice_commercial(bl_no, shippername, consignee_name, address, location) VALUES (?, ?, ?, ?, ?)";
            $stmt = $link->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sssss", $blNo, $shipperName, $consigneeName, $address, $location);

                if ($stmt->execute()) {
                    echo '<script>alert("Invoice Saved Successfully")</script>';
                    echo "Data saved successfully.";
                    header("Location: export-list-forms.php");
                } else {
                    echo '<script>alert("Invoice Save Error")</script>';
                    echo "Error saving data: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $link->error;
            }

            // Close the database connection
            $link->close();
        } else {
            echo "Database connection error: " . mysqli_connect_error();
        }
    }
}
?>
<div class="modal-dialog" style="max-width: 800px;">
    <div class="modal-content">

        <style>
            table {
                font-family: Arial, sans-serif;
                border: 4px solid blue;
                border-collapse: collapse;
                width: 100%;
            }

            td,
            th {
                border: 1px solid blue;
                text-align: left;
                padding: 8px;
                font-size: 12px
            }

            /* Style for the input fields */
            .form-control-inline {
                border: none;
                padding: 0;
                width: 100%;
            }

            .company-details {
                gap: 20px;
            }

            .BL-number {
                display: flex;
                align-items: center;
                gap: 5px;
                border: 1px solid rgb(178, 190, 181);
                padding: 0px 10px 0px 10px;

            }

            .BL-number label {
                margin-top: 10px
            }

            .BL-number input {
                width: 100px;
            }

            .logo1 {
                display: flex;
                flex-direction: column;
                justify-content: center;
                text-align: center;
                margin-top: 50px;
            }

            .shipper {
                display: flex;
                flex-direction: column;
            }

            @media print {


                body * {
                    visibility: hidden;

                }

                .print-container {
                    transform: scale(0.9);
                    /* Adjust the scale as needed */
                    transform-origin: top left;
                }

                .print-container,
                .print-container * {
                    visibility: visible;

                }

            }
        </style>
        <form method="post" id="invoiceForm" class="print-container m-3" onsubmit="return validateForm()">
            <h4 style="margin-left:20px;">BILL OF LADING</h4>
            <div class="print-container m-3" id="invoiceModalContent">

                <table class="table table-bordered">
                    <tr>
                        <td colspan="4">
                            <div class="shipper">
                                <label for="">SHIPPER</label>
                                <input id="shipperName" type="text" name="shipperName" class="form-control-inline"
                                    placeholder="Name">
                                <input id="shipperAddress" type="text" class="form-control-inline"
                                    placeholder="Address">
                                <input id="shipperZipCode" type="text" class="form-control-inline"
                                    placeholder="Zip-code">
                            </div>
                        </td>
                        <td colspan="4" rowspan="2" style="position: relative;">
                            <div class="company-details">
                                <div class="BL-number" style="position: absolute; top:0; right: 0;">
                                    <div> <label for="">BL NO</label></div>
                                    <div> <input id="blNo" type="text" name="blNo" class="form-control-inline"
                                            placeholder="Enter" oninput="toggleSubmitButton()"> <span
                                            style="color: red;">
                                            <?php echo $blNoError; ?>
                                        </span><br>
                                        <small id="blNoError" class="text-danger"></small>
                                    </div>

                                </div>
                                <div class="logo1">
                                    <div><img src="logo.png" alt="" width="200px">
                                    </div>

                                    <label for="" style="font-size:10px;line-height: 12px;color:blue">167,
                                        Maharagama Road,
                                        Dehiwala, <br>Tel: (+94) 112
                                        724
                                        485<br> Mobile: (+94) 777 876 582<br> Email:
                                        info@Newshaheenlogistics.com Web:
                                        www.Newshaheenllc.com</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="shipper">
                                <label for="">CONSIGNEE</label>
                                <input id="consigneeName" name="consigneeName" type="text" class="form-control-inline"
                                    placeholder="Name">
                                <input id="consigneeAddress" name="address" type="text" class="form-control-inline"
                                    placeholder="Address">
                                <input id="consigneeZipCode" type="text" class="form-control-inline"
                                    placeholder="Zip-code">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="shipper">
                                <label for="">NOTIFY PARTY</label>
                                <input id="notifyPartyName" type="text" class="form-control-inline"
                                    placeholder="Company Name">
                                <input id="notifyPartyAddress" type="text" class="form-control-inline"
                                    placeholder="Address">
                                <input id="notifyTelephoneNo" type="text" class="form-control-inline"
                                    placeholder="Telephone No">
                            </div>
                        </td>
                        <td colspan="4" rowspan="2"> For delivery of goods please apply to:
                            <input id="forDelivery" type="text" class="form-control-inline"
                                placeholder="For delivery of goods please apply to" max-line=3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Place of Receipt</td>
                        <td colspan="2"><input id="placeReceipt" type="text" class="form-control-inline"
                                placeholder="Place of Receipt">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input id="portLoading" type="text" class="form-control-inline"
                                placeholder="Port of Loading">
                        </td>
                        <td colspan="2">Port of Loading</td>
                        <td colspan="4" rowspan="2">xyz
                            to:<input id="xyz" type="text" class="form-control-inline"
                                placeholder="For delivery of goods please apply to" max-line=3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Port of Discharge<input id="portDischarge" type="text"
                                class="form-control-inline" placeholder="enter">
                        </td>
                        <td colspan="2">Final Destination<input id="finalDestination" type="text"
                                class="form-control-inline" placeholder="enter">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"> Container & Seal No</td>
                        <td colspan="1"> Quality and Kind of Packages</td>
                        <td colspan="3">Particulars Furnished By Merchant Description of
                            Goods
                        </td>
                        <td colspan="2">Measurement(CBM) Gross Weight(KGS)</td>
                    </tr>
                    <tr style="height:500px">
                        <td colspan="2" style="position: relative;"><input id="containerSeal" type="text"
                                class="form-control-inline" placeholder="enter">;
                            <span style="position: absolute; bottom: 0;left:0;">Total Number
                                of containers<br>of packages (in words)</span>
            </div>
            </td>
            <td colspan=" 1"><input id="qualityPackages" type="text" class="form-control-inline" placeholder="enter">
            </td>
            <td colspan="3"><input id="description" type="text" class="form-control-inline" placeholder="enter">
            </td>
            <td colspan="2"><input id="measurement" type="text" class="form-control-inline" placeholder="enter">
            </td>
            </tr>
            <tr>
                <td colspan="2">FREIGHT &
                    CHARGES<input id="freightCharges" type="text" class="form-control-inline" placeholder="enter">
                </td>
                <td colspan="1">Revenue Tons<input id="revenueTon" type="text" class="form-control-inline"
                        placeholder="enter"></td>
                <td colspan="1"></td>
                <td colspan="1">Rate<input id="rate" type="text" class="form-control-inline" placeholder="enter">
                </td>
                <td colspan="1">Prepaid<input id="prepaid" type="text" class="form-control-inline" placeholder="enter">
                </td>
                <td colspan="2">Collect<input id="collect" type="text" class="form-control-inline" placeholder="enter">
                </td>
            </tr>
            <tr>
                <td colspan="2">Service Type<input id="serviceType" type="text" class="form-control-inline"
                        placeholder="enter"></td>
                <td colspan="1">Exchange Rate<input id="exchangeRate" type="text" class="form-control-inline"
                        placeholder="enter"></td>
                <td colspan="2"> </td>
                <td colspan="1">Prepaid at<input id="prepaidAt" type="text" class="form-control-inline"
                        placeholder="enter"></td>
                <td colspan="2"><input id="payable" type="text" class="form-control-inline" placeholder="enter">Payable
                    at
                </td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="4" rowspan="2"></td>
            </tr>




            </table>
            <!-- Add Print button -->

    </div>
    <div class="text-end m-3">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="submitButton" class="btn btn-primary" onclick="printInvoice()">Print</button>
    </div>
    </form>
    <script>
        function toggleSubmitButton() {
            // Get the BL Number input
            var blNoInput = document.getElementById('blNo');
            // Get the value of the BL Number input
            var blNoValue = blNoInput.value.trim();
            // Get the submit button
            var submitButton = document.getElementById('submitButton');

            // Enable the submit button if BL Number is not empty, otherwise disable it
            if (blNoValue !== '') {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        function validateForm() {
            var blNo = document.getElementById('blNo').value;
            var submitButton = document.getElementById('submitButton');
            if (blNo === "") {
                document.getElementById('blNoError').innerHTML = "BL No is required.";
                alert("BL No is required.");
                submitButton.disabled = true;
                return false;
            } else {
                document.getElementById('blNoError').innerHTML = "";
                submitButton.disabled = false;
                return true;
            }
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
                'body { font-family: Arial, sans-serif; }' +

                'table { font-family: Arial, sans-serif; border: 1px solid black; border-collapse: collapse;heigt:1000px; }' +
                'table input,textarea{border:none;font-weight:600;color:black}' +
                'td, th { border: 1px solid black; text-align: left; padding: 8px; font-size: 14px; }' +
                '.form-control-inline { border: none; padding: 0; width: 100%; }' +
                '.company-details {padding-top:80px}' +
                '.BL-number {display: flex; align-items: center; gap: 5px; padding: 0px 10px 0px 10px; }' +
                '.BL-number label { margin-top: 10px; }' +
                '.BL-number input { width: 100px; }' +
                '.logo1 { display: flex; flex-direction: column; justify-content: center; text-align: center; }' +
                '.shipper { display: flex; flex-direction: column; }' +
                '/* Add more CSS styles here */' +
                '</style></head><body>');


            // Create printable content with input values
            var shipperName = document.getElementById('shipperName').value;
            var shipperAddress = document.getElementById('shipperAddress').value;
            var shipperZipCode = document.getElementById('shipperZipCode').value;
            var blNo = document.getElementById('blNo').value;
            var consigneeName = document.getElementById('consigneeName').value;
            var consigneeAddress = document.getElementById('consigneeAddress').value;
            var consigneeZipCode = document.getElementById('consigneeZipCode').value;
            var notifyPartyName = document.getElementById('notifyPartyName').value;
            var notifyPartyAddress = document.getElementById('notifyPartyAddress').value;
            var notifyTelephoneNo = document.getElementById('notifyTelephoneNo').value;
            var forDelivery = document.getElementById('forDelivery').value;
            var placeReceipt = document.getElementById('placeReceipt').value;
            var portLoading = document.getElementById('portLoading').value;
            var xyz = document.getElementById('xyz').value;
            var portDischarge = document.getElementById('portDischarge').value;
            var finalDestination = document.getElementById('finalDestination').value;
            var containerSeal = document.getElementById('containerSeal').value;
            var qualityPackages = document.getElementById('qualityPackages').value;
            var description = document.getElementById('description').value;
            var measurement = document.getElementById('measurement').value;
            var freightCharges = document.getElementById('freightCharges').value;
            var revenueTon = document.getElementById('revenueTon').value;
            var rate = document.getElementById('rate').value;
            var prepaid = document.getElementById('prepaid').value;
            var collect = document.getElementById('collect').value;
            var serviceType = document.getElementById('serviceType').value;
            var exchangeRate = document.getElementById('exchangeRate').value;
            var prepaidAt = document.getElementById('prepaidAt').value;
            var payable = document.getElementById('payable').value;

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
            <table class="table table-bordered">
             <h4 >BILL OF LADING</h4>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="shipper">
                                                        <label for="">SHIPPER</label>
                                                        <input id="shipperName" type="text" name="shipperName"  class="form-control-inline"
                                                            placeholder="${shipperName}">
                                                        <input type="text" class="form-control-inline"
                                                            placeholder="${shipperAddress}">
                                                        <input type="text" class="form-control-inline"
                                                            placeholder="${shipperZipCode}">
                                                    </div>
                                                </td>
                                                <td colspan="4" rowspan="2">
                                                    <div style="position: relative;">
                                                     <div class="BL-number" style="position: absolute; top: 0;right:0;">

                                                            <div> <label for="">BL NO</label></div>
                                                            <div > <input type="text" name="blNo" class="form-control-inline" placeholder="${blNo}"></div>

                                                     </div>
                                                
                                                     <div class="company-details">
                                                       
                                                        <div class="logo1">
                                                            <div><img src="logo.png" alt="" width="200px">
                                                        </div>

                                                            <label for=""
                                                                style="font-size:10px;line-height: 12px;color:blue">167,
                                                                Maharagama Road,
                                                                Dehiwala, <br>Tel: (+94) 112
                                                                724
                                                                485<br> Mobile: (+94) 777 876 582<br> Email:
                                                                info@Newshaheenllc.com Web:
                                                                www.Newshaheenllc.com</label>
                                                        </div>
                                                    </div>
                                                  
                                                </td>
                                                
                                                 
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="shipper">
                                                        <label for="">CONSIGNEE</label>
                                                        <input type="text" class="form-control-inline"
                                                            placeholder="${consigneeName}">
                                                        <input type="text" class="form-control-inline"
                                                            placeholder="${consigneeAddress}">
                                                        <input type="text" class="form-control-inline"
                                                            placeholder="${consigneeZipCode}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="shipper">
                                                        <label for="">NOTIFY PARTY</label>
                                                        <input type="text" class="form-control-inline"
                                                            placeholder="${notifyPartyName}">
                                                        <input type="text" class="form-control-inline"
                                                            placeholder="${notifyPartyAddress}">
                                                        <input type="text" class="form-control-inline"
                                                            placeholder="${notifyTelephoneNo}">
                                                    </div>
                                                </td>
                                                <td colspan="4" rowspan="2"> For delivery of goods please apply to:
                                                    <input type="text" class="form-control-inline"
                                                        placeholder="${forDelivery}" max-line=3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Place of Receipt</td>
                                                <td colspan="2"><input type="text" class="form-control-inline"
                                                        placeholder="${placeReceipt}"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="text" class="form-control-inline"
                                                        placeholder="${portLoading}"></td>
                                                <td colspan="2">Port of Loading</td>
                                                <td colspan="4" rowspan="2">For delivery of goods please apply to:<input
                                                        type="text" class="form-control-inline"
                                                        placeholder="${xyz}" max-line=3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Port of Discharge<input type="text"
                                                        class="form-control-inline" placeholder="${portDischarge}"></td>
                                                <td colspan="2">Final Destination<input type="text"
                                                        class="form-control-inline" placeholder="${finalDestination}"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"> Container & Seal No</td>
                                                <td colspan="1"> Quality and Kind of Packages</td>
                                                <td colspan="3">Particulars Furnished By Merchant Description of Goods
                                                </td>
                                                <td colspan="2">Measurement(CBM) Gross Weight(KGS)</td>
                                            </tr>
                                            <tr style="height:500px">
                                                <td colspan="2" >
                                                <div  style="position: relative;height:500px">
                                                  <input type="text" class="form-control-inline"
                                                        placeholder="${containerSeal}"> 
                                                       <span style="position: absolute; bottom: 0;left:0;">Total Number of containers<br>of packages (in words)</span></div>
                                              </td>
                                                <td colspan="1"><input type="text" class="form-control-inline"
                                                        placeholder="${qualityPackages}"> </td>
                                                <td colspan="3"><input type="text" class="form-control-inline"
                                                        placeholder="${description}"></td>
                                                <td colspan="2"><input type="text" class="form-control-inline"
                                                        placeholder="${measurement}"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="text" class="form-control-inline" placeholder="${freightCharges}">FREIGHT & CHARGES</td>
                                                <td colspan="1"><input type=text" class="form-control-inline" placeholder="${revenueTon}">Revenue Tons</td>
                                                <td colspan="1"> </td>
                                                <td colspan="1"><input type=text" class="form-control-inline" placeholder="${rate}">Rate</td>
                                                <td colspan="1"><input type=text" class="form-control-inline" placeholder="${prepaid}">Prepaid</td>
                                                <td colspan="2"><input type=text" class="form-control-inline" placeholder="${collect}">Collect</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type=text" class="form-control-inline" placeholder="${serviceType}">Service Type</td>
                                                <td colspan="1"><input type=text" class="form-control-inline" placeholder="${exchangeRate}">Exchange Rate</td>
                                                <td colspan="2"> </td>
                                                <td colspan="1"><input type=text" class="form-control-inline" placeholder="${prepaidAt}">Prepaid at</td>
                                                <td colspan="2"><input type="text" class="form-control-inline"
                                                        placeholder="${payable}">Payable at</td>
                                            </tr>
                                            <tr>
                                                <td colspan="8"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="4" rowspan="2"></td>
                                            </tr>




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
            window.location.href = "export-list-forms.php";

            // Now, send the data to the server using AJAX
            $.ajax({
                type: 'POST',
                url: 'save_printed_content.php', // Update with the correct PHP script path
                data: {
                    content: printWindow.document.documentElement.innerHTML,
                    filename: blNo
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

</div>