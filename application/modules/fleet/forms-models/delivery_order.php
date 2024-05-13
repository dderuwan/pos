<?php
require_once "config.php";

$agentDoNoError = ""; // Initialize Agent DO Number error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish database connection (you should include your database connection code here)

    // Get Agent DO No and Serial No from POST data
    $agent_do_no = $_POST['agent_do_no'];
    $serial_no = $_POST['serial_no'];
    $consignee_name_address = $_POST['consignee_name_address'];

    // Define the location
    $location = "https://system.Flotillalogistics.com/assets/BILL OF DELIVERY ORDER/$agent_do_no.html";

    // Validate Agent DO Number (not empty)
    if (empty($agent_do_no)) {
        $agentDoNoError = "Please enter Agent DO Number.";
    } else {
        // Prepare and execute SQL query to insert data
        $query = "INSERT INTO delivery_order(agent_do_no, serial_no, consignee_name_address, location) VALUES (?, ?, ?, ?)";
        $stmt = $link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssss", $agent_do_no, $serial_no, $consignee_name_address, $location);

            if ($stmt->execute()) {
                echo '<script>alert("Invoice Saved Successfully")</script>';
                // echo "Data saved successfully.";
            } else {
                echo '<script>alert("Invoice Save Error")</script>';
                // echo "Error saving data: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $link->error;
        }
    }

    // Close the database connection
    $link->close();
}
?>
<div class="modal-dialog" style="max-width: 1030px;">
    <div class="modal-content">

        <style>
            table {
                font-family: Arial, sans-serif;
                border: 4px solid blue;
                border-collapse: collapse;
                width: 100%;
            }

            table input,
            textarea {
                /* border:none */

            }

            tr {
                vertical-align: top;

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
        <form method="post" id="invoiceForm" class="print-container m-3">

            <div class="print-container m-3" id="invoiceModalContent">
                <h4 style="margin-left:20px;">BILL OF DELIVERY ORDER</h4>
                <table>
                    <td colspan="6" rowspan="3">
                        <div
                            style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
                            <div>
                                1.Please deliver the cargo mentioned <br> in this Delivery Order

                                <input type="text" placeholder="enter" id="cargoMethod" name="cargoMethod">
                                <br />
                                2.to my authorised representative whose <br>Name & Address are given in cage No.4 :
                                <input type="text" placeholder="enter" id="nameAddres" name="nameAddres">
                            </div>

                            <div style="display:flex;justify-content:space-between;align-items:center;gap:50px">
                                <div style="">
                                    Date
                                    <input type="date" id="dinaya" name="dinaya">
                                </div>
                                <div style="">Consignee's Signature</div>
                            </div>
                        </div>
                    </td>
                    <td colspan="2">9.CUSDEC NO. <input type="text" placeholder="enter" id="cusdec" name="cusdec"></td>
                    <td colspan="2">10 a.Agent's DO No <span style="color: red;">
                            <?php echo $agentDoNoError; ?>
                        </span><input type="text" placeholder="enter" name="agent_do_no" id="agent_do_no"
                            oninput="toggleSubmitButton()"><br>
                    </td>
                    <td colspan="2">10 b.Serial No <input type="text" placeholder="enter" name="serial_no"
                            id="serial_no"></td>

                    </tr>

                    <tr>
                        <td colspan="3">11.B/L No<input type="text" placeholder="enter" id="bl" name="bl"></td>
                        <td colspan="3">13.SLPA DO No <input type="text" placeholder="enter" id="slpa" name="slpa"></td>
                    </tr>

                    <tr>
                        <td colspan="3">12.Consignee TIN/NID No <br>
                            <input type="text" placeholder="enter" id="conNID" name="conNID">
                        </td>
                        <td colspan="3">14.Vessel Ref. <input type="text" placeholder="enter" id="vesRef" name="vesRef">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">3.Consignee's Name & Address <textarea name="consignee_name_address"
                                id="consignee_name_address" cols="40" rows="5"></textarea>
                        </td>
                        <td colspan="6">
                            <div style="display:flex;justify-content:space-between;gap:50px">
                                <div>
                                    <span> 15.Vessel / Delivery Agent</span>
                                    <textarea name="vesAgent" id="vesAgent" cols="40" rows="5"></textarea>
                                </div>
                                <div>
                                    <div>

                                    </div>
                                    TEL NO:<input type="text" name="tel" id="tel" placeholder="enter">
                                </div>

                            </div>
                            <div style="display:flex;justify-content:space-between;gap:50px;align-items:center;">
                                <div>
                                    16.DO Expires on : <input type="date" name="doEx" id="doEx">
                                </div>
                                <div>
                                    Code :<input type="text" name="code" id="code" placeholder="enter">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            <div>
                                <div style="display:flex;justify-content:space-between;align-item:center;gap:40px">
                                    <div>
                                        <span>4.Clearing Agent's Name & Address </span>
                                        <textarea name="clName" id="clName" cols="25" rows="5"></textarea>
                                    </div>
                                    <div>
                                        Code<input type="text" name="clCode" id="clCode" placeholder="enter">
                                    </div>


                                </div>
                                <div>
                                    Tele No<input type="text" id="clPhone" name="clPhone" placeholder="enter">
                        </td>
            </div>
    </div>

    <td colspan="3">
        <div style="display:flex;align-item:center;flex-direction:column">
            17.Date of Lading FCL/Destuffing LCL/BB
            <div style="display:flex;gap:20px">
                FCL<input type="checkBox" id="fclCheck" name="fclCheck">
                <input type="date" id="fclDate" name="fclDate">
            </div>

            <div style="display:flex;gap:20px">
                LCL/BB<input type="checkBox" id="lclCheck" name="lclCheck">
            </div>

        </div>

    </td>
    <td colspan="3">18.Any other Services
        <br>
        <textarea name="anySer" id="anySer" cols="25" rows="5"></textarea>

    </td>
    </tr>

    <tr>
        <td colspan="6">5.What Cleark's Name & ID No <br><input type="text" name="whatCl" id="whatCl"
                placeholder="enter"></td>
        <td colspan="3">
            <div style="display:flex;flex-direction:column">
                19.No of Containers Destuffed/Stuffed at Customs Unit
                <div style="display:flex;gap:10px">
                    <input type="checkBox">20FT
                    <input type="checkBox">40FT
                    <input type="checkBox">Over 40FT


                </div>
                <div style="display:flex;gap:10px">
                    <input type="checkBox">DT
                    <input type="checkBox">ST
                </div>
            </div>
        </td>
        <td colspan="3">
            <div style="display:flex;flex-direction:column">
                <div style="">20.Rent <br> From <input type="date" id="rentFrom" name="rentFrom"></div>
                <div style=""> To<input type="date" id="rentTo" name="rentTo"></div>
            </div>


        </td>
    </tr>



    <tr>
        <td colspan="3">6.Voyage No/Date <input type="date" id="voyadate" name="voyadate"></td>
        <td colspan="3">7.Warehouse No <br><input type="text" id="warehouseNo" name="warehouseNo" placeholder="enter">
        </td>
        <td colspan="3">
            <div>
                <div style="">21.Over Time <br> From <input type="date" id="overTimeFrom" name="overTimeFrom"></div>
                <div style=""> To<input type="date" id="overTo" name="overTo"></div>
            </div>
        </td>
        <td colspan="3">Number of Days <br><input type="text" id="numberDay" name="numberDay" placeholder="enter"></td>
    </tr>

    <tr>
        <td colspan="6">8.Vessel <input type="text" id="vessel" name="vessel" placeholder="enter"><br>Port of Loading
            (Optional)<input type="text" id="portLoading" name="portLoading" placeholder="enter"></td>
        <td colspan="6">
            <div style="display:flex;width:500px;gap:5px">
                <div> 22.Dangerous Cargo <br> Number of Days <br><input type="text" id="dangerousCargo"
                        name="dangerousCargo" placeholder="enter" style="width:120px"></div>
                <div>23.Dangerous Cargo <br> Group <br><input type="text" id="dangerousGroup" name="dangerousGroup"
                        placeholder="enter" style="width:120px"></div>
                <div> 24.Date of <br>Landing <br><input type="text" id="landingDate" name="landingDate"
                        placeholder="enter" style="width:120px"></div>
                <div>25.Time<br>. <br><input type="text" id="time" name="time" placeholder="enter" style="width:120px">
                </div>
            </div>
        </td>
    </tr>

    <tr>
        <td colspan="4" rowspan="4">
            <div style="display:flex;gap:20px">
                <div style="display:flex;gap:5px;flex-direction:column">
                    <span>26.Marks & Nos</span> <textarea name="marksNo" id="marksNo" cols="10" rows="20"></textarea>
                </div>
                <div style="display:flex;gap:5px;flex-direction:column">
                    <span>27.Container No</span> <textarea name="containerNo" id="containerNo" cols="10"
                        rows="20"></textarea>
        </td>
</div>
</div>


<td colspan="2" rowspan="4">
    <span>28.Pkg.Type</span><br> <textarea name="pkgType" id="pkgType" cols="20" rows="20"></textarea>
</td>
</td>
<td colspan="3" rowspan="3">29.Description of Goods<br> <textarea name="descriptionOfGoods" id="descriptionOfGoods"
        cols="35" rows="17"></textarea> </td>
<td colspan="2">30.Gross Weight Kg <br><textarea name="grossWeight" id="grossWeight" cols="10" rows="10"></textarea>
</td>
<td colspan="1">31.CBM M3 <br><br><textarea name="cbm" id="cbm" cols="10" rows="10"></textarea> </td>
</tr>

<tr>
    <td colspan="3">
        <div style="display:flex;flex-direction:column">
            32.Number of FCL Containers
            <div style="display:flex;gap:10px">
                <input type="text" name="numberFclFirst" id="numberFclFirst" style="width:40px">20FT
                <input type="text" name="numberFclSecond" id="numberFclSecond" style="width:40px">40FT
                <input type="text" name="numberFclThird" id="numberFclThird" style="width:40px">Over 40FT
            </div>
        </div>
    </td>
</tr>
<tr>
    <td colspan="3">33.CIF Value Rs.<i>(If applicable)</i><br>
        <input type="text" name="cifValu" id="cifValu">
    </td>
</tr>

<tr>
    <td colspan="6">34.Number of Pkgs.In words <br>
        <input type="text" name="numberIn" id="numberIn" style="width:330px">
        <input type="date" name="inWordDate" id="inWordDate">
    </td>
</tr>
<tr>
    <td colspan="4">

        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                35.S/K Verify measurement / D/c Cargo
                <br>
                <input type="text" name="verifyMesur" id="verifyMesur" placeholder="enter">

            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="verifyDate" id="verifyDate">
                </div>
                <div style="">Account Assistent <input type="text" name="account" id="account" placeholder="enter"
                        style="width:100px"></div>
            </div>
        </div>
    </td>
    <td colspan="4">
        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                37.Delivery Authorised
                <br>
                <input type="checkBox" name="outPass" id="outPass" placeholder="enter">Out Pass <br>
                <input type="checkBox" name="internalPass" id="internalPass" placeholder="enter">internal Pass
                <br>
                time
                <input type="text" name="deliveryTime" id="deliveryTime" placeholder="enter" style="width:100px">

            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="deliveryDate" id="deliveryDate">
                </div>
                <div style="">ADC/ASC/SC <br> <input type="text" name="adc" id="adc" placeholder="enter"
                        style="width:100px"></div>
            </div>
        </div>
    </td>


    <td colspan="4">

        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                39.Commercial Division use only
                <br>
                From <input type="text" name="commercialDiv" id="commercialDiv" placeholder="enter"> <br>
                To<input type="text" name="commercialTo" id="commercialTo" placeholder="enter">
                <br>

            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="comDate" id="comDate">
                </div>
                <div style="">Rent And Dues Clerk Signature</div>
            </div>
        </div>
    </td>
</tr>

<tr>
    <td colspan="4" rowspan="2">
        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                36.SK cargo may be released upto
                <br>
                <input type="date" name="cargoMayDate" id="cargoMayDate" placeholder="enter">

            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="assiDate" id="assiDate">
                </div>
                <div style="">Account Assistent <input type="text" name="accountAssi" id="accountAssi"
                        placeholder="enter" style="width:100px"></div>
            </div>
        </div>
    </td>
    <td colspan="4" rowspan="2">
        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                38.Delivery Clerk Delivery Authrised up to
                <br>
                <input type="date" name="deliDate" id="deliDate" placeholder="enter">
                <br><br>
                Bill No:<input type="text" name="bill" id="bill" placeholder="enter">
            </div>



            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="deDate" id="deDate">
                </div>
                <div style="">Account Assistent <input type="text" name="aa" id="aa" placeholder="enter"
                        style="width:100px"></div>
            </div>
        </div>
    </td>


    <td colspan="4">
        <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;text-align:center">
            <div style="background-color:black;width:200px">
                <span style="color:white">WARNING</span><br>
            </div>

            <span>The Consignee is liable for 100% surcharge for wrong declarations.
                No claims will be considered for refund after one month from date of payment
            </span>
        </div>

    </td>
</tr>
<tr>
    <td colspan="6">40.Forwaders Do No <br><input type="text" name="forwader" id="forwader" placeholder="enter"></td>

</tr>
<tr>
    <td colspan="3">
        <div style="display:flex;flex-direction:column;">
            <div>
                <span>41.Document Attached</span>
            </div>
            <div>
                <input type="checkBox" name="docuCopy" id="docuCopy">Copy of B/L
            </div>
            <div>
                <input type="checkBox" name="docuDu" id="docuDu">Duty Paid Receipt (W.A)
            </div>
            <div>
                <input type="checkBox" name="docuInvoice" id="docuInvoice">Invoice (For Liquor and Refer Cargo)
            </div>
            <div>
                <input type="checkBox" name="docuCusdec" id="docuCusdec">CUSDEC/BOI Certificate/Personal Effects/DPL
                Declaration(W.A)
            </div>
        </div>
    </td>
    <td colspan="5">42.Document to be used as
        <br>
        <input type="checkBox" name="docuUse" id="docuUse">Wrong/Nill Mark Application
    </td>
    <td colspan="4">
        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                43.Please deliver to consignee the goods described in this delivery order before the expiry date given
                in cage 16

            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="dfDate" id="dfDate">
                </div>
                <div style="">Agent's Signature
                </div>
            </div>
    </td>

</tr>





</table>

<!-- Add Print button -->

</div>
<div class="text-end m-3">

    <button type="submit" id="submitButton" class="btn btn-primary" onclick="printInvoice()" disabled>Print</button>
</div>
</form>
<script>
    function toggleSubmitButton() {
        // Get the Agent DO Number input
        var agentDoNoInput = document.getElementById('agent_do_no');
        // Get the value of the Agent DO Number input
        var agentDoNoValue = agentDoNoInput.value.trim();
        // Get the submit button
        var submitButton = document.getElementById('submitButton');

        // Enable the submit button if Agent DO Number is not empty, otherwise disable it
        if (agentDoNoValue !== '') {
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
        var agent_do_no = document.getElementById('agent_do_no').value;
        var serial_no = document.getElementById('serial_no').value;
        var consignee_name_address = document.getElementById('consignee_name_address').value;
        var cargoMethod = document.getElementById('cargoMethod').value;
        var nameAddres = document.getElementById('nameAddres').value;
        var dinaya = document.getElementById('dinaya').value;
        var cusdec = document.getElementById('cusdec').value;
        var bl = document.getElementById('bl').value;
        var slpa = document.getElementById('slpa').value;
        var conNID = document.getElementById('conNID').value;
        var vesRef = document.getElementById('vesRef').value;
        var vesAgent = document.getElementById('vesAgent').value;
        var tel = document.getElementById('tel').value;
        var doEx = document.getElementById('doEx').value;
        var code = document.getElementById('code').value;
        var clName = document.getElementById('clName').value;
        var clCode = document.getElementById('clCode').value;
        var clPhone = document.getElementById('clPhone').value;
        var fclCheck = document.getElementById('fclCheck').checked;
        var fclDate = document.getElementById('fclDate').value;
        var lclCheck = document.getElementById('lclCheck').checked;
        var anySer = document.getElementById('anySer').value;
        var whatCl = document.getElementById('whatCl').value;
        var rentFrom = document.getElementById('rentFrom').value;
        var rentTo = document.getElementById('rentTo').value;
        var voyadate = document.getElementById('voyadate').value;
        var warehouseNo = document.getElementById('warehouseNo').value;
        var overTimeFrom = document.getElementById('overTimeFrom').value;
        var overTo = document.getElementById('overTo').value;
        var numberDay = document.getElementById('numberDay').value;

        var vessel = document.getElementById('vessel').value;
        var portLoading = document.getElementById('portLoading').value;
        var dangerousCargo = document.getElementById('dangerousCargo').value;
        var dangerousGroup = document.getElementById('dangerousGroup').value;
        var landingDate = document.getElementById('landingDate').value;
        var time = document.getElementById('time').value;

        var marksNo = document.getElementById('marksNo').value;
        var containerNo = document.getElementById('containerNo').value;
        var pkgType = document.getElementById('pkgType').value;
        var descriptionOfGoods = document.getElementById('descriptionOfGoods').value;
        var grossWeight = document.getElementById('grossWeight').value;
        var cbm = document.getElementById('cbm').value;

        var numberFclFirst = document.getElementById('numberFclFirst').value;
        var numberFclSecond = document.getElementById('numberFclSecond').value;
        var numberFclThird = document.getElementById('numberFclThird').value;

        var cifValu = document.getElementById('cifValu').value;
        var numberIn = document.getElementById('numberIn').value;
        var inWordDate = document.getElementById('inWordDate').value;

        var verifyMesur = document.getElementById('verifyMesur').value;
        var verifyDate = document.getElementById('verifyDate').value;
        var account = document.getElementById('account').value;
        var outPass = document.getElementById('outPass').value;
        var internalPass = document.getElementById('internalPass').value;
        var deliveryTime = document.getElementById('deliveryTime').value;
        var deliveryDate = document.getElementById('deliveryDate').value;
        var adc = document.getElementById('adc').value;

        var commercialDiv = document.getElementById('commercialDiv').value;
        var commercialTo = document.getElementById('commercialTo').value;
        var comDate = document.getElementById('comDate').value;

        var cargoMayDate = document.getElementById('cargoMayDate').value;
        var assiDate = document.getElementById('assiDate').value;
        var accountAssi = document.getElementById('accountAssi').value;
        var deliDate = document.getElementById('deliDate').value;
        var bill = document.getElementById('bill').value;

        var deDate = document.getElementById('deDate').value;
        var aa = document.getElementById('aa').value;

        var forwader = document.getElementById('forwader').value;
        var docuCopy = document.getElementById('docuCopy').value;
        var docuDu = document.getElementById('docuDu').value;
        var docuInvoice = document.getElementById('docuInvoice').value;
        var docuCusdec = document.getElementById('docuCusdec').value;
        var docuUse = document.getElementById('docuUse').value;
        var dfDate = document.getElementById('dfDate').value;
















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
                <td colspan="6" rowspan="3">
                 <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
                    <div>
                        1.Please deliver the cargo mentioned <br> in this Delivery Order

                    <input type="text" placeholder="${cargoMethod}"id="cargoMethod" name="cargoMethod">
                    <br/>
                    2.to my authorised representative whose <br>Name & Address are given in cage No.4 : <input type="text" placeholder="enter"id="nameAddres" name="nameAddres"placeholder="${nameAddres}">
                    </div>
   
                    <div style="display:flex;justify-content:space-between;align-items:center;gap:50px">
                       <div style="">
                       Date 
                       <input type="date"id="dinaya" name="dinaya"value="${dinaya}">
                    </div >
                       <div style="">Consignee's Signature</div> 
                    </div>
                 </div>
                    </td>
        <td colspan="2">9.CUSDEC NO. <input type="text" placeholder="${cusdec}"id="cusdec" name="cusdec"></td>
  <td colspan="2">10 a.Agent's DO No <input type="text" placeholder="${agent_do_no}" name="agent_do_no"></td>
        <td colspan="2">10 b.Serial No <input type="text" placeholder="${serial_no}" name="serial_no"></td>
      
    </tr>

    <tr>
        <td colspan="3">11.B/L No<input type="text" placeholder="enter" id="bl" name="bl"placeholder="${bl}"></td>
        <td colspan="3">13.SLPA DO No <input type="text" placeholder="${slpa}"id="slpa" name="slpa"></td>
    </tr>
 
    <tr>
                        <td colspan="3">12.Consignee TIN/NID No <br>
                            <input type="text" placeholder="${conNID}" id="conNID" name="conNID">
                        </td>
                        <td colspan="3">14.Vessel Ref. <input type="text" placeholder="${vesRef}" id="vesRef" name="vesRef">
                        </td>
                    </tr>

    <tr>
        <td colspan="6">3.Consignee's Name & Address  <textarea placeholder="${consignee_name_address}" id="consignee_name_address" cols="40" rows="5"></textarea>
    </td>
        <td colspan="6">
            <div style="display:flex;justify-content:space-between;gap:50px">
            <div>
            <span> 15.Vessel / Delivery Agent</span>
            <textarea name="" id="" cols="40" rows="5"name="vesAgent" id="vesAgent"placeholder="${vesAgent}"></textarea>
            </div>
            <div>
                                    <div>

                                    </div>
                                    TEL NO:<input type="text" name="tel" id="tel" placeholder="${tel}">
                                </div>

                            </div>
                            <div style="display:flex;justify-content:space-between;gap:50px;align-items:center;">
                                <div>
                                    16.DO Expires on : <input type="date" name="doEx" id="doEx"placeholder="${doEx}">
                                </div>
                                <div>
                                    Code :<input type="text" name="code" id="code" placeholder="${code}">
                                </div>
                            </div>
                        </td>
    </tr>
    
    <tr>
        <td colspan="6">
        <div>
            <div style="display:flex;justify-content:space-between;align-item:center;gap:40px">
                <div>
                <span>4.Clearing Agent's Name & Address </span>
                     <textarea name="clName" id="clName" cols="25" rows="5"placeholder="${clName}"></textarea>   
                </div>
                <div>
                 Code<input type="text" name="clCode" id="clCode" placeholder="${clCode}">
                </div>
                  
                   
            </div>
            <div>
            Tele No<input type="text" id="clPhone"name="clPhone"placeholder="${clPhone}">
            </div>
        </div>
       
        <td colspan="3">
            <div style="display:flex;align-item:center;flex-direction:column">
            17.Date of Lading FCL/Destuffing LCL/BB
            <div style="display:flex;gap:20px">
            FCL<input type="checkBox"id="fclCheck"name="fclCheck"valuer="${fclCheck}">
                <input type="date"id="fclDate"name="fclDate"value="${fclDate}">
            </div>
            
            <div style="display:flex;gap:20px">
            LCL/BB<input type="checkBox"id="lclCheck" name="lclCheck"value="${lclCheck}">
            </div>
            
            </div>
                                                                           
        </td>                                                              
    
        <td colspan="3">18.Any other Services
            <br>
            <textarea name="anySer" id="anySer" cols="25" rows="5"placeholder="${anySer}"></textarea>  

        </td>
    </tr>

    <tr >
         <td colspan="6">5.What Cleark's Name & ID No <br><input type="text" name="whatCl" id="whatCl"
                placeholder="${whatCl}"></td>
        <td colspan="3" >
        <div style="display:flex;flex-direction:column">
        19.No of Containers Destuffed/Stuffed at Customs Unit
            <div style="display:flex;gap:10px">
            <input type="checkBox">20FT
            <input type="checkBox">40FT
            <input type="checkBox">Over 40FT
           

            </div>
            <div style="display:flex;gap:10px">
            <input type="checkBox">DT
            <input type="checkBox">ST
            </div>
            </div>
        </td>
        <td colspan="3">
        <div style="display:flex;flex-direction:column">
            <div style="">20.Rent <br> From <input type="date" id="rentFrom" name="rentFrom"placeholder="${rentFrom}"></div>
                <div style=""> To<input type="date" id="rentTo" name="rentTo"placeholder="${rentTo}"></div>
        </div>    
        

        </td>
    </tr>


        
     <tr>
        <td colspan="3">6.Voyage No/Date <input type="date" id="voyadate" name="voyadate"value="${voyadate}"></td>
        <td colspan="3">7.Warehouse No <br><input type="text" id="warehouseNo" name="warehouseNo" placeholder="${warehouseNo}">
        </td>
        <td colspan="3">
            <div>
                <div style="">21.Over Time <br> From <input type="date" id="overTimeFrom" name="overTimeFrom"placeholder="${overTimeFrom}"></div>
                <div style=""> To<input type="date" id="overTo" name="overTo"placeholder="${overTo}"></div>
            </div>
        </td>
        <td colspan="3">Number of Days <br><input type="text" id="numberDay" name="numberDay" placeholder="${numberDay}"></td>
    </tr>

        
    <tr>
        <td colspan="6">8.Vessel <input type="text" id="vessel" name="vessel"placeholder="${vessel}"><br>Port of Loading (Optional)<input type="text"
                id="portLoading" name="portLoading"placeholder="${portLoading}"></td>
        <td colspan="6">
            <div style="display:flex;width:500px;gap:5px">
                <div> 22.Dangerous Cargo <br> Number of Days <br><input type="text" id="dangerousCargo" name="dangerousCargo"placeholder="${dangerousCargo}"
                        style="width:120px"></div>
                <div>23.Dangerous Cargo <br> Group <br><input type="text" id="dangerousGroup" name="dangerousGroup"placeholder="${dangerousGroup}" style="width:120px"></div>
                <div> 24.Date of <br>Landing <br><input type="text" id="landingDate" name="landingDate"value="${landingDate}" style="width:120px"></div>
                <div>25.Time<br>. <br><input type="text" id="time" name="time"placeholder="${time}" style="width:120px"></div>



            </div>
        </td>
    </tr>


     <tr>
        <td colspan="4" rowspan="4">
            <div style="display:flex;gap:20px">
                <div style="display:flex;gap:5px;flex-direction:column">
                    <span>26.Marks & Nos</span> <textarea name="marksNo" id="marksNo" placeholder="${marksNo}"cols="10" rows="20"></textarea>
                </div>
                <div style="display:flex;gap:5px;flex-direction:column">
                    <span>27.Container No</span> <textarea name="containerNo" id="containerNo" placeholder="${containerNo}"cols="10" rows="20"></textarea>
        </td>
</div>
</div>


<td colspan="2" rowspan="4">
    <span>28.Pkg.Type</span><br> <textarea name="pkgType" id="pkgType" placeholder="${pkgType}"cols="20" rows="20"></textarea>
</td>
</td>
<td colspan="3" rowspan="3">29.Description of Goods<br> <textarea name="descriptionOfGoods" id="descriptionOfGoods" placeholder="${descriptionOfGoods}"cols="35" rows="17"></textarea> </td>
<td colspan="2">30.Gross Weight Kg <br><textarea name="grossWeight" id="grossWeight" placeholder="${grossWeight}"cols="10" rows="10"></textarea> </td>
<td colspan="1">31.CBM M3 <br><br><textarea name="cbm" id="cbm" placeholder="${cbm}"cols="10" rows="10"></textarea> </td>
</tr>

    <tr>
    <td colspan="3">
        <div style="display:flex;flex-direction:column">
            32.Number of FCL Containers
            <div style="display:flex;gap:10px">
                <input type="text" name="numberFclFirst" id="numberFclFirst" placeholder="${numberFclFirst}"style="width:40px">20FT
                <input type="text" name="numberFclSecond" id="numberFclSecond" placeholder="${numberFclSecond}"style="width:40px">40FT
                <input type="text" name="numberFclThird" id="numberFclThird" placeholder="${numberFclThird}"style="width:40px">Over 40FT


            </div>

        </div>
    </td>
</tr>
        <tr>
    <td colspan="3">33.CIF Value Rs.<i>(If applicable)</i><br>
        <input type="text"name="cifValu" id="cifValu"placeholder="${cifValu}">
    </td>
</tr>

<tr>
    <td colspan="6">34.Number of Pkgs.In words <br>
        <input type="text" name="numberIn" id="numberIn"placeholder="${numberIn}"style="width:330px">
        <input type="date"name="inWordDate" id="inWordDate"value="${inWordDate}">
    </td>
</tr>
    <tr>
    <td colspan="4">

              <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                35.S/K Verify measurement / D/c Cargo
                <br>
                <input type="text" name="verifyMesur" id="verifyMesur" placeholder="${verifyMesur}">

            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="verifyDate" id="verifyDate"value="${verifyDate}">
                </div>
                <div style="">Account Assistent <input type="text" name="account" id="account" placeholder="${account}"
                        style="width:100px"></div>
            </div>
        </div>
    </td>
    <td colspan="4">
        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                37.Delivery Authorised
                <br>
                <input type="checkBox" name="outPass" id="outPass" placeholder="${outPass}">Out Pass <br>
                <input type="checkBox" name="internalPass" id="internalPass" placeholder="${internalPass}">internal Pass
                <br>
                time
                <input type="text" name="deliveryTime" id="deliveryTime" placeholder="${deliveryTime}" style="width:100px">

            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="deliveryDate" id="deliveryDate"placeholder="${deliveryDate}">
                </div>
                <div style="">ADC/ASC/SC <br> <input type="text" name="adc" id="adc" placeholder="${adc}"
                        style="width:100px"></div>
            </div>
        </div>
    </td>


        <td colspan="4">

        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                39.Commercial Division use only
                <br>
                From <input type="text"  name="commercialDiv" id="commercialDiv"placeholder="${commercialDiv}"> <br>
                To<input type="text"  name="commercialTo" id="commercialTo"placeholder="${commercialTo}">
                <br>

            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="comDate" id="comDate"value="${comDate}">
                </div>
                <div style="">Rent And Dues Clerk Signature</div>
            </div>
        </div>
    </td>
</tr>
   

<tr>
    <td colspan="4" rowspan="2">
        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                36.SK cargo may be released upto
                <br>
                <input type="date" name="cargoMayDate" id="cargoMayDate"placeholder="${cargoMayDate}">

            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date"name="assiDate" id="assiDate"placeholder="${assiDate}">
                </div>
                <div style="">Account Assistent <input type="text" name="accountAssi" id="accountAssi"placeholder="${accountAssi}" style="width:100px"></div>
            </div>
        </div>
    </td>
    <td colspan="4" rowspan="2">
        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                38.Delivery Clerk Delivery Authrised up to
                <br>
                <input type="date" name="deliDate" id="deliDate"value="${deliDate}">
                <br><br>
                Bill No:<input type="text" name="bill" id="bill"placeholder="${bill}">
            </div>
   


                    <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                <div style="">
                    Date
                    <input type="date" name="deDate" id="deDate"value="${deDate}">
                </div>
                <div style="">Account Assistent <input type="text" name="aa" id="aa" placeholder="${aa}"
                        style="width:100px"></div>
            </div>
        </div>
    </td>
        <td colspan="4">
        <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;text-align:center">
            <div style="background-color:black;width:200px">
                <span style="color:white">WARNING</span><br>
            </div>

            <span>The Consignee is liable for 100% surcharge for wrong declarations.
                No claims will be considered for refund after one month from date of payment
            </span>
        </div>

    </td>
</tr>
<tr>
    <td colspan="6">40.Forwaders Do No <br><input type="text" name="forwader" id="forwader" placeholder="${forwader}"></td>

</tr>
<tr>
    <td colspan="3">
        <div style="display:flex;flex-direction:column;">
            <div>
                <span>41.Document Attached</span>
            </div>
            <div>
                <input type="checkBox" name="docuCopy" id="docuCopy"placeholder="${docuCopy}">Copy of B/L
            </div>
            <div>
                <input type="checkBox" name="docuDu" id="docuDu"placeholder="${docuDu}">Duty Paid Receipt (W.A)
            </div>
            <div>
                <input type="checkBox" name="docuInvoice" id="docuInvoice"placeholder="${docuInvoice}">Invoice (For Liquor and Refer Cargo)
            </div>
            <div>
                <input type="checkBox" name="docuCusdec" id="docuCusdec"placeholder="${docuCusdec}">CUSDEC/BOI Certificate/Personal Effects/DPL
            </div>
        </div>
    </td>
    <td colspan="5">42.Document to be used as
        <br>
        <input type="checkBox" name="docuUse" id="docuUse"placeholder="${docuUse}">Wrong/Nill Mark Application
    </td>
    <td colspan="4">
        <div style="display:flex;flex-direction:column;justify-content:space-between;align-item:center;height:150px">
            <div>
                43.Please deliver to consignee the goods described in this delivery order before the expiry date given
                in cage 16
                <br>

                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;gap:20px">
                    <div style="">
                        Date
                        <input type="date" name="dfDate" id="dfDate"value="${dfDate}">
                    </div>
                    <div style="">Agent's Signature
                    </div>
                </div>
    </td>

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
        window.location.href = "import-list-delivery-order-invoice.php";
        console.log("hhass")
        // Now, send the data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: 'save_printed_content_import_delivery_order.php', // Update with the correct PHP script path
            data: {
                content: printWindow.document.documentElement.innerHTML,
                filename: agent_do_no
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