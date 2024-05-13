<?php
require_once "config.php";

$manifestIdError = ""; // Initialize Manifest ID error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish database connection (you should include your database connection code here)

    // Get Generator ID and Manifest ID from POST data
    $generator_id = $_POST['generator_id'];
    $manifest_id = $_POST['manifest_id'];

    // Define the location
    // $location = "https://localhost/Flotilla-logistic/assets/BILL OF MEIFEST/$manifest_id.html";
    $location = "https://system.Flotillalogistics.com/assets/BILL OF MEIFEST/$manifest_id.html";


    // Validate Manifest ID (not empty)
    if (empty($manifest_id)) {
        $manifestIdError = "Please enter Manifest ID.";
    } else {
        // Prepare and execute SQL query to insert data
        $query = "INSERT INTO manifest_invoice(manifest_id, generator_id, location) VALUES (?, ?, ?)";
        $stmt = $link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sss", $manifest_id, $generator_id, $location);

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
<div class="modal-dialog" style="max-width: 1100px;">
    <div class="modal-content">

        <style>
            table {
                font-family: Arial, sans-serif;
                border: 4px solid blue;
                border-collapse: collapse;
                width: 100%;
            }

            input {
                width: 100px
            }


            table input,
            textarea {
                /* border: none; */

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
            <h4 style="margin-left:20px;">BILL OF MENIFEST</h4>
            <div class="print-container m-3" id="invoiceModalContent">

                <table>
                    <tr style="vertical-align: top;">
                        <td colspan="3">UNIFORM HAZARDOUS WASTE MANIFEST</th>
                        <td colspan="5">1.Generator ID Number
                            <br><input type="text" id="generator_id" name="generator_id"
                                placeholder="Generator ID Number">

                        </td>
                        <td colspan="2">2.Page 1 of <br><input type="text" id="page" name="page" placeholder="enter">
                        </td>
                        <td colspan="3">3.Emergency Response Phone <br><input type="text" id="emergPhone"
                                name="emergPhone" placeholder="enter"></td>
                        <td colspan="5">4.Manifest Tracking Number <br><input type="text" id="manifest_id"
                                name="manifest_id" placeholder="enter" oninput="toggleSubmitButton()"> <span
                                style="color: red;">
                                <?php echo $manifestIdError; ?>
                            </span></td>
                    </tr>

                    <tr style="vertical-align: top;">
                        <td colspan="11">
                            <div style="">
                                <span>5.Generator's Name and Mailing Address</span>
                                <br> <textarea rows="3" cols="30" id="nameAndAddress" name="nameAndAddress"></textarea>

                                <br><br>
                                <span style="">Generator's Phone:<input type="text" id="generatorPhone"
                                        name="generatorPhone"></span>
                            </div>
                        </td>
                        <td colspan="7">Generator's Site address(if different than mailing address)
                            <br><textarea rows="3" cols="30" id="generatorSiteAddr" name="generatorSiteAddr"></textarea>
                        </td>
                    </tr>

                    <tr style="vertical-align: top;">
                        <td colspan="13">6.Transpoter 1 Company Name<input type="text" id="trans1ComName"
                                name="trans1ComName"></td>
                        <td colspan="5">U.S. EPA ID Number<input type="text" id="trans1EPA" name="trans1EPA"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="13">7.Transporter 2 Company Name<input type="text" id="trans2ComName"
                                name="trans2ComNam"></td>
                        <td colspan="5">U.S. EPA ID Number<input type="text" id="trans2EPA" name="trans2EPA"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="13">
                            <div style="">
                                <span> 7.Designated Facility Name and Site Address</span>
                                <br><input type="text" id="designNameAndAddr" name="designNameAndAddr">
                                <br><br>
                                <span style="">Facility's Phone:<input type="text" id="facilityPhone"
                                        name="facilityPhone"></span>
                            </div>

                        </td>
                        <td colspan="5">U.S. EPA ID Number <input type="text" id="EPA3" name="EPA3"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="1">9a.HM</td>
                        <td colspan="10">9b. U.S. DOT Description (including Proper Shipping Name, Hazard Class, ID
                            Number,and Packing Group (if any))</td>
                        <td colspan="1">10. Containers No</td>
                        <td colspan="1">10. Containers Type</td>
                        <td colspan="1">11 TotalQuantity</td>
                        <td colspan="1">12 Unit Wt./Vol.</td>
                        <td colspan="3">13. Waste Codes</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="1"></td>
                        <td colspan="10">1.<br><textarea rows="3" cols="50" id="firstFrist"
                                name="firstFrist"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="10" id="firstSecond" name="firstSecond"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="firstThird" name="firstThird"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="firstFourth" name="firstFourth"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="5" id="firstFifth" name="firstFifth"></textarea>
                        </td>
                        <td colspan="3">

                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="firstWasteCodeFirst"
                                        name="firstWasteCodeFirst" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="firstWasteCodeSecond"
                                        name="firstWasteCodeSecond" style="font-size:10px;width:50px;">
                                </div>
                            </div>
                            <br>
                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="firstWasteCodeThird"
                                        name="firstWasteCodeThird" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="firstWasteCodeFourth"
                                        name="firstWasteCodeFourth" style="font-size:10px;width:50px;">
                                </div>
                            </div>

                        </td>
                    </tr>

                    <tr style="vertical-align: top;">
                        <td colspan="1"></td>
                        <td colspan="10">2.<br><textarea rows="3" cols="50" id="secondFirst"
                                name="secondFirst"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="10" id="secondSecond"
                                name="secondSecond"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="secondThird" name="secondThird"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="secondFourth"
                                name="secondFourth"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="5" id="secondFifth" name="secondFifth"></textarea>
                        </td>
                        <td colspan="3">

                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="secondWasteCodeFirst"
                                        name="secondWasteCodeFirst" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="secondWasteCodeSecond"
                                        name="secondWasteCodeSecond" style="font-size:10px;width:50px;">
                                </div>
                            </div>
                            <br>
                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="secondWasteCodeThird"
                                        name="secondWasteCodeThird" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="secondWasteCodeFourth"
                                        name="secondWasteCodeFourth" style="font-size:10px;width:50px;">
                                </div>
                            </div>

                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="1"></td>
                        <td colspan="10">3.<br><textarea rows="3" cols="50" id="thirdFirst"
                                name="thirdFirst"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="10" id="thirdSecond" name="thirdSecond"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="thirdThird" name="thirdThird"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="thirdFourth" name="thirdFourth"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="5" id="thirdFifth" name="thirdFifth"></textarea>
                        </td>
                        <td colspan="3">

                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="thirdWasteCodeFirst"
                                        name="thirdWasteCodeFirst" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="thirdWasteCodeSecond"
                                        name="thirdWasteCodeSecond" style="font-size:10px;width:50px;">
                                </div>
                            </div>
                            <br>
                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="thirdWasteCodeThird"
                                        name="thirdWasteCodeThird" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="thirdWasteCodeFourth"
                                        name="thirdWasteCodeFourth" style="font-size:10px;width:50px;">
                                </div>
                            </div>

                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="1"></td>
                        <td colspan="10">4.<br><textarea rows="3" cols="50" id="fourthFirst"
                                name="fourthFirst"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="10" id="fourthSecond"
                                name="fourthSecond"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="fourthThird" name="fourthThird"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="fourthFourth"
                                name="fourthFourth"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="5" id="fourthFifth" name="fourthFifth"></textarea>
                        </td>
                        <td colspan="3">

                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fourthWasteCodeFirst"
                                        name="fourthWasteCodeFirst" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fourthWasteCodeSecond"
                                        name="fourthWasteCodeSecond" style="font-size:10px;width:50px;">
                                </div>
                            </div>
                            <br>
                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fourthWasteCodeThird"
                                        name="fourthWasteCodeThird" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fourthWasteCodeFourth"
                                        name="fourthWasteCodeFourth" style="font-size:10px;width:50px;">
                                </div>
                            </div>

                        </td>
                    </tr>

                    <tr style="vertical-align: top;">
                        <td colspan="18">14. Special Handling Instructions and Additional Information<input type="text"
                                id="specialInfo" name="specialInfo">
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">15. GENERATOR’S/OFFEROR’S CERTIFICATION: I hereby declare that the contents
                            of this consignment are fully and accurately described above by the proper shipping name,
                            and are classified, packaged,
                            marked and labeled/placarded, and are in all respects in proper condition for transport
                            according to applicable international and national governmental regulations. If export
                            shipment and I am the Primary
                            Exporter, I certify that the contents of this consignment conform to the terms of the
                            attached EPAAcknowledgment of Consent.
                            I certify that the waste minimization statement identified in 40 CFR 262.27(a) (if I am a
                            large quantity generator) or (b) (if I am a small quantity generator) is true.</td>
                    </tr>
                    <tr>
                        <td colspan="9">Generator's/Offeror's Printed/Typed Name</td>
                        <td colspan="6">Signature</td>
                        <td colspan="3"><input type="date" id="genDate" name="genDate"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">16. International Shipments
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="importCheck" id="importCheck" style="width:20px">
                            Import to U.S.&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="exportCheck" id="exportCheck" style="width:20px">
                            Export from U.S.&nbsp;&nbsp;&nbsp;&nbsp;
                            Port of entry/exit
                            Date leaving U.S.:
                            <input type="date" id="ponameAndAddress" name="ponameAndAddress">
                        </td>

                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">17. Transporter Acknowledgment of Receipt of Materials</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="9">Transporter 1 Printed/Typed Name<input type="text" id="transPrint1Name"
                                name="transPrint1Name"></td>
                        <td colspan="6">Signature</td>
                        <td colspan="3"><input type="date" id="trans1Date" name="trans1Date"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="9">Transporter 2 Printed/Typed Name<input type="text" id="transPrint2Name"
                                name="transPrint2Name"></td>
                        <td colspan="6">Signature</td>
                        <td colspan="3"><input type="date" id="trans2Date" name="trans2Date"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">18. Discrepancy</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">18a. Discrepancy Indication Space
                            &nbsp;
                            <input type="checkbox" name="qcheck" id="qcheck" style="width:20px">
                            Quantity&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="tcheck" id="tcheck" style="width:20px">
                            Type&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="rcheck" id="rcheck" style="width:20px">&nbsp;&nbsp;&nbsp;&nbsp;
                            Residue
                            <input type="checkbox" name="pcheck" id="pcheck" style="width:20px">&nbsp;&nbsp;&nbsp;&nbsp;
                            Partial Rejection
                            <input type="checkbox" name="fcheck" id="fcheck" style="width:20px">&nbsp;&nbsp;&nbsp;&nbsp;
                            Full Rejection
                            <br>
                            Manifest Reference Number:
                            <input type="text" name="maniRef" id="maniRef">&nbsp;&nbsp;&nbsp;&nbsp;

                        </td>

                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="13">
                            <div style="">
                                <span>18b. Alternate Facility (or Generator)</span>
                                <br><input type="text" id="altFacility" name="altFacility">
                                <br><br>
                                <span style="">Facility's Phone:<input type="text" id="18bPhone" name="18bPhone"></span>
                            </div>

                        </td>
                        <td colspan="5">U.S. EPA ID Number<input type="text" id="18bEPA" name="18bEPA"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="15">18c. Signature of Alternate Facility (or Generator)</td>

                        <td colspan="3"><input type="date" id="18cDate" name="18cDate"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">19.Hazardous Waste Report Management Method Codes (i.e., codes for hazardous
                            waste treatment, disposal, and recycling systems)</td>
                    </tr>
                    <tr>
                        <td colspan="4">1<input type="text" id="code1" name="code1"></td>
                        <td colspan="5">2<input type="text" id="code2" name="code2"></td>
                        <td colspan="5">3<input type="text" id="code3" name="code3"></td>
                        <td colspan="4">4<input type="text" id="code4" name="code4"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">20. Designated Facility Owner or Operator: Certification of receipt of
                            hazardous materials covered by the manifest except as noted in Item 18a</td>
                    </tr>
                    <td colspan="9">Printed/Typed Name<input type="text" id="printName" name="printName"></td>
                    <td colspan="6">Signature</td>
                    <td colspan="3"><input type="date" id="printDate" name="printDate"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18"> <span style="color:red;text-align:end;">DESIGNATED FACILITY TO DESTINATION
                                STATE (IF REQUIRED)</span></td>
                    </tr>


                </table>


                <!-- Add Print button -->

            </div>
            <div class="text-end m-3">

                <button type="submit" id="submitButton" class="btn btn-primary" onclick="printInvoice()">Print</button>
            </div>
        </form>

        <script>
            function toggleSubmitButton() {
                // Get the Manifest ID input
                var manifestIdInput = document.getElementById('manifest_id');
                // Get the value of the Manifest ID input
                var manifestIdValue = manifestIdInput.value.trim();
                // Get the submit button
                var submitButton = document.getElementById('submitButton');

                // Enable the submit button if Manifest ID is not empty, otherwise disable it
                if (manifestIdValue !== '') {
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
                var manifest_id = document.getElementById('manifest_id').value;
                var generator_id = document.getElementById('generator_id').value;
                // console.log(manifest_id)
                var page = document.getElementById('page').value;
                var emergPhone = document.getElementById('emergPhone').value;
                var nameAndAddress = document.getElementById('nameAndAddress').value;
                var generatorPhone = document.getElementById('generatorPhone').value;
                var generatorSiteAddr = document.getElementById('generatorSiteAddr').value;
                var trans1ComName = document.getElementById('trans1ComName').value;
                var trans1EPA = document.getElementById('trans1EPA').value;
                var trans2ComName = document.getElementById('trans2ComName').value;
                var trans2EPA = document.getElementById('trans2EPA').value;
                var designNameAndAddr = document.getElementById('designNameAndAddr').value;
                var facilityPhone = document.getElementById('facilityPhone').value;
                var EPA3 = document.getElementById('EPA3').value;
                var genDate = document.getElementById('genDate').value;
                var ponameAndAddress = document.getElementById('ponameAndAddress').value;
                var trans1Date = document.getElementById('trans1Date').value;
                var trans2Date = document.getElementById('trans2Date').value;
                var altFacility = document.getElementById('altFacility').value;
                var b18Phone = document.getElementById('18bPhone').value;
                var b18EPA = document.getElementById('18bEPA').value;
                var c18Date = document.getElementById('18cDate').value;
                var printName = document.getElementById('printName').value;
                var printDate = document.getElementById('printDate').value;
                var trans1Date = document.getElementById('trans1Date').value;
                var trans2Date = document.getElementById('trans2Date').value;
                var firstFrist = document.getElementById('firstFrist').value;
                var firstSecond = document.getElementById('firstThird').value;
                var firstThird = document.getElementById('trans2Date').value;
                var firstFourth = document.getElementById('firstFourth').value;
                var firstFifth = document.getElementById('firstFifth').value;
                var firstWasteCodeFirst = document.getElementById('firstWasteCodeFirst').value;
                var firstWasteCodeSecond = document.getElementById('firstWasteCodeSecond').value;
                var firstWasteCodeThird = document.getElementById('firstWasteCodeThird').value;
                var firstWasteCodeFourth = document.getElementById('firstWasteCodeFourth').value;

                var secondFirst = document.getElementById('secondFirst').value;
                var secondSecond = document.getElementById('secondSecond').value;
                var secondThird = document.getElementById('secondThird').value;
                var secondFourth = document.getElementById('secondFourth').value;
                var secondFifth = document.getElementById('secondFifth').value;

                var secondWasteCodeFirst = document.getElementById('secondWasteCodeFirst').value;
                var secondWasteCodeSecond = document.getElementById('secondWasteCodeSecond').value;
                var secondWasteCodeThird = document.getElementById('secondWasteCodeThird').value;
                var secondWasteCodeFourth = document.getElementById('secondWasteCodeFourth').value;

                var thirdFirst = document.getElementById('thirdFirst').value;
                var thirdSecond = document.getElementById('thirdSecond').value;
                var thirdThird = document.getElementById('thirdThird').value;
                var thirdFourth = document.getElementById('thirdFourth').value;
                var thirdFifth = document.getElementById('thirdFifth').value;

                var thirdWasteCodeFirst = document.getElementById('thirdWasteCodeFirst').value;
                var thirdWasteCodeSecond = document.getElementById('thirdWasteCodeSecond').value;
                var thirdWasteCodeThird = document.getElementById('thirdWasteCodeThird').value;
                var thirdWasteCodeFourth = document.getElementById('thirdWasteCodeFourth').value;

                var fourthFirst = document.getElementById('fourthFirst').value;
                var fourthSecond = document.getElementById('fourthSecond').value;
                var fourthThird = document.getElementById('fourthThird').value;
                var fourthFourth = document.getElementById('fourthFourth').value;
                var fourthFifth = document.getElementById('fourthFifth').value;

                var fourthWasteCodeFirst = document.getElementById('fourthWasteCodeFirst').value;
                var fourthWasteCodeSecond = document.getElementById('fourthWasteCodeSecond').value;
                var fourthWasteCodeThird = document.getElementById('fourthWasteCodeThird').value;
                var fourthWasteCodeFourth = document.getElementById('fourthWasteCodeFourth').value;

                var specialInfo = document.getElementById('specialInfo').value;

                var transPrint1Name = document.getElementById('transPrint1Name').value;
                var transPrint2Name = document.getElementById('transPrint2Name').value;

                var code1 = document.getElementById('code1').value;
                var code2 = document.getElementById('code2').value;
                var code3 = document.getElementById('code3').value;
                var code4 = document.getElementById('code4').value;

                var qcheck = document.getElementById('qcheck').value;
                var tcheck = document.getElementById('tcheck').value;
                var rcheck = document.getElementById('rcheck').value;
                var pcheck = document.getElementById('pcheck').value;
                var fcheck = document.getElementById('fcheck').value;
                var maniRef = document.getElementById('maniRef').value;

                var importCheck = document.getElementById('importCheck').value;
                var exportCheck = document.getElementById('exportCheck').value;










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
                    <tr style="vertical-align: top;">
                        <td colspan="3">UNIFORM HAZARDOUS WASTE MANIFEST</th>
                        <td colspan="5">1.Generator ID Number
                        <br><input type="text" id="generator_id" name="generator_id" placeholder="${generator_id}">         
                        </td>
                        <td colspan="2">2.Page 1 of <br><input type="text" id="page" name="page" placeholder="${page}">
                        </td>
                        <td colspan="3">3.Emergency Response Phone <br><input type="text" id="emergPhone"
                                name="emergPhone" placeholder="${emergPhone}"></td>
                        <td colspan="5">4.Manifest Tracking Number <br><input type="text" id="manifest_id" name="manifest_id"  placeholder="${manifest_id}"></th>
                    </tr>

             <tr style="vertical-align: top;">
                        <td colspan="11">
                            <div style="">
                                <span>5.Generator's Name and Mailing Address</span>
                                <br> <textarea rows="2" cols="30" id="nameAndAddress" name="nameAndAddress"placeholder="${nameAndAddress}"></textarea>

                                <br><br>
                                <span style="">Generator's Phone:<input type="text" id="generatorPhone"
                                        name="generatorPhone"placeholder="${generatorPhone}"></span>
                            </div>
                        </td>
                        <td colspan="7">Generator's Site address(if different than mailing address)
                            <br><textarea rows="2" cols="30" id="generatorSiteAddr" name="generatorSiteAddr"placeholder="${generatorSiteAddr}"></textarea>
                        </td>
                    </tr>
              <tr>
                        <td colspan="7">Generator's Site address(if different than mailing address)
                            <br><textarea rows="3" cols="30" id="generatorSiteAddr" name="generatorSiteAddr"placeholder="${generatorSiteAddr}"></textarea>
                        </td>
                    </tr>

                    <tr style="vertical-align: top;">
                        <td colspan="13">6.Transpoter 1 Company Name<input type="text" id="trans1ComName"
                                name="trans1ComName"placeholder="${trans1ComName}"></td>
                        <td colspan="5">U.S. EPA ID Number<input type="text" id="trans1EPA" name="trans1EPA"placeholder="${trans1EPA}"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="13">7.Transporter 2 Company Name<input type="text" id="trans2ComName"
                                name="trans2ComNam"placeholder="${trans2ComName}"></td>
                        <td colspan="5">U.S. EPA ID Number<input type="text" id="trans2EPA" name="trans2EPA"placeholder="${trans2EPA}"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="13">
                            <div style="">
                                <span> 7.Designated Facility Name and Site Address</span>
                                <br><input type="text" id="designNameAndAddr" name="designNameAndAddr"placeholder="${designNameAndAddr}">
                                <br><br>
                                <span style="">Facility's Phone:<input type="text" id="facilityPhone"
                                        name="facilityPhone"placeholder="${facilityPhone}"></span>
                            </div>

                        </td>
                        <td colspan="5">U.S. EPA ID Number <input type="text" id="EPA3" name="EPA3"placeholder="${EPA3}"></td>
                    </tr>  <tr style="vertical-align: top;">
                        <td colspan="1">9a.HM</td>
                        <td colspan="10">9b. U.S. DOT Description (including Proper Shipping Name, Hazard Class, ID
                            Number,and Packing Group (if any))</td>
                        <td colspan="1">10. Containers No</td>
                        <td colspan="1">10. Containers Type</td>
                        <td colspan="1">11 TotalQuantity</td>
                        <td colspan="1">12 Unit Wt./Vol.</td>
                        <td colspan="3">13. Waste Codes</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="1"></td>
                        <td colspan="10">1.<br><textarea rows="3" cols="50" id="firstFrist"
                                name="firstFrist"placeholder="${firstFrist}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="10" id="firstSecond" name="firstSecond"placeholder="${firstSecond}"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="firstThird" name="firstThird"placeholder="${firstThird}"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="firstFourth" name="firstFourth"placeholder="${firstFourth}"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="5" id="firstFifth" name="firstFifth"placeholder="${firstFifth}"></textarea>
                        </td>
                        <td colspan="3">

                             <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="firstWasteCodeFirst"
                                        name="firstWasteCodeFirst" placeholder="${firstWasteCodeFirst}" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="firstWasteCodeSecond"
                                        name="firstWasteCodeSecond" placeholder="${firstWasteCodeSecond}" style="font-size:10px;width:50px;">
                                </div>
                            </div>
                            <br>
                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="firstWasteCodeThird"
                                        name="firstWasteCodeThird" placeholder="${firstWasteCodeThird}" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="firstWasteCodeFourth"
                                        name="firstWasteCodeFourth" placeholder="${firstWasteCodeFourth}" style="font-size:10px;width:50px;">
                                </div>
                            </div>

                        </td>
                    </tr>

                    <tr style="vertical-align: top;">
                        <td colspan="1"></td>
                        <td colspan="10">2.<br><textarea rows="3" cols="50" id="secondFirst"
                                name="secondFirst"placeholder="${secondFirst}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="10" id="secondSecond"
                                name="secondSecond"placeholder="${secondSecond}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="secondThird" name="secondThird"placeholder="${secondThird}"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="secondFourth"
                                name="secondFourth"placeholder="${secondFourth}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="5" id="secondFifth" name="secondFifth"placeholder="${secondFifth}"></textarea>
                        </td>
                        <td colspan="3">

                           <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="secondWasteCodeFirst"
                                        name="secondWasteCodeFirst" placeholder="${secondWasteCodeFirst}" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="secondWasteCodeSecond"
                                        name="secondWasteCodeSecond" placeholder="${secondWasteCodeSecond}" style="font-size:10px;width:50px;">
                                </div>
                            </div>
                            <br>
                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="secondWasteCodeThird"
                                        name="secondWasteCodeThird" placeholder="${secondWasteCodeThird}" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="secondWasteCodeFourth"
                                        name="secondWasteCodeFourth" placeholder="${secondWasteCodeFourth}" style="font-size:10px;width:50px;">
                                </div>
                            </div>

                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="1"></td>
                        <td colspan="10">3.<br><textarea rows="3" cols="50" id="thirdFirst"
                                name="thirdFirst"placeholder="${thirdFirst}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="10" id="thirdSecond"
                                name="thirdSecond"placeholder="${thirdSecond}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="thirdThird"
                                name="thirdThird"placeholder="${thirdThird}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="thirdFourth"
                                name="thirdFourth"placeholder="${thirdFourth}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="5" id="thirdFifth"
                                name="thirdFifth"placeholder="${thirdFifth}"></textarea></td>
                        <td colspan="3">

                             <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="thirdWasteCodeFirst"
                                        name="thirdWasteCodeFirst" placeholder="${thirdWasteCodeFirst}" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="thirdWasteCodeSecond"
                                        name="thirdWasteCodeSecond" placeholder="${thirdWasteCodeSecond}" style="font-size:10px;width:50px;">
                                </div>
                            </div>
                            <br>
                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="thirdWasteCodeThird"
                                        name="thirdWasteCodeThird" placeholder="${thirdWasteCodeThird}" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="thirdWasteCodeFourth"
                                        name="thirdWasteCodeFourth" placeholder="${thirdWasteCodeFourth}" style="font-size:10px;width:50px;">
                                </div>
                            </div>

                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                       <td colspan="1"></td>
                        <td colspan="10">4.<br><textarea rows="3" cols="50" id="fourthFirst"
                                name="fourthFirst"placeholder="${fourthFirst}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="10" id="fourthSecond"
                                name="fourthSecond"placeholder="${fourthSecond}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="fourthThird" name="fourthThird"placeholder="${fourthThird}"></textarea>
                        </td>
                        <td colspan="1"><br><textarea rows="3" cols="9" id="fourthFourth"
                                name="fourthFourth"placeholder="${fourthFourth}"></textarea></td>
                        <td colspan="1"><br><textarea rows="3" cols="5" id="fourthFifth" name="fourthFifth"placeholder="${fourthFifth}"></textarea>
                        </td>

                            <td colspan="3">

                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fourthWasteCodeFirst"
                                        name="fourthWasteCodeFirst" placeholder="${fourthWasteCodeFirst}" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fourthWasteCodeSecond"
                                        name="fourthWasteCodeSecond" placeholder="${fourthWasteCodeSecond}" style="font-size:10px;width:50px;">
                                </div>
                            </div>
                            <br>
                            <div class="row" style="margin-right:10px;padding:0">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fourthWasteCodeThird"
                                        name="fourthWasteCodeThird" placeholder="${fourthWasteCodeThird}" style="font-size:10px;width:50px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fourthWasteCodeFourth"
                                        name="fourthWasteCodeFourth" placeholder="${fourthWasteCodeFourth}" style="font-size:10px;width:50px;">
                                </div>
                            </div>

                        </td>
                    </tr>

                    <tr style="vertical-align: top;">
                         <td colspan="18">14. Special Handling Instructions and Additional Information<input type="text"
                                id="specialInfo" name="specialInfo" placeholder="${specialInfo}">
                        </td>
                    <tr style="vertical-align: top;">
                        <td colspan="18">15. GENERATOR’S/OFFEROR’S CERTIFICATION: I hereby declare that the contents
                            of this consignment are fully and accurately described above by the proper shipping name,
                            and are classified, packaged,
                            marked and labeled/placarded, and are in all respects in proper condition for transport
                            according to applicable international and national governmental regulations. If export
                            shipment and I am the Primary
                            Exporter, I certify that the contents of this consignment conform to the terms of the
                            attached EPAAcknowledgment of Consent.
                            I certify that the waste minimization statement identified in 40 CFR 262.27(a) (if I am a
                            large quantity generator) or (b) (if I am a small quantity generator) is true.</td>
                    </tr>
                    <tr>
                        <td colspan="9">Generator's/Offeror's Printed/Typed Name</td>
                        <td colspan="6">Signature</td>
                        <td colspan="3"><input type="date" id="genDate" name="genDate"value="${genDate}"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">16. International Shipments
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="importCheck" id="importCheck" value="${importCheck}"style="width:20px">
                            Import to U.S.&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="exportCheck" id="exportCheck" value="${exportCheck}"style="width:20px">
                            Export from U.S.&nbsp;&nbsp;&nbsp;&nbsp;
                            Port of entry/exit
                            Date leaving U.S.:
                            <input type="date" id="ponameAndAddress" name="ponameAndAddress"placeholder="${ponameAndAddress}">
                        </td>

                    </tr>
                           <tr style="vertical-align: top;">
                        <td colspan="18">17. Transporter Acknowledgment of Receipt of Materials</td>
                    </tr>
                    <tr style="vertical-align: top;">
                         <td colspan="9">Transporter 1 Printed/Typed Name<input type="text" id="transPrint1Name"
                                name="transPrint1Name"placeholder="${transPrint1Name}"></td>
                        <td colspan="6">Signature</td>
                        <td colspan="3"><input type="date" id="trans1Date" name="transDate"value="${trans1Date}"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                       <td colspan="9">Transporter 2 Printed/Typed Name<input type="text" id="transPrint2Name"
                                name="transPrint2Name"placeholder="${transPrint2Name}"></td>
                        <td colspan="6">Signature</td>
                        <td colspan="3"><input type="date" id="trans2Date" name="trans2Date"value="${trans2Date}"></td>
                    </tr>
                        <tr style="vertical-align: top;">
                        <td colspan="18">18. Discrepancy</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">18a. Discrepancy Indication Space
                            &nbsp;
                            <input type="checkbox" name="qcheck" id="qcheck" value="${qcheck}"style="width:20px">
                            Quantity&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="tcheck" id="tcheck" value="${tcheck}"style="width:20px">
                            Type&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="rcheck" id="rcheck" value="${rcheck}"style="width:20px">&nbsp;&nbsp;&nbsp;&nbsp;
                            Residue
                            <input type="checkbox" name="pcheck" id="pcheck" value="${pcheck}"style="width:20px">&nbsp;&nbsp;&nbsp;&nbsp;
                            Partial Rejection
                            <input type="checkbox" name="fcheck" id="fcheck" value="${fcheck}"style="width:20px">&nbsp;&nbsp;&nbsp;&nbsp;
                            Full Rejection
                            <br>
                            Manifest Reference Number:
                            <input type="text" name="maniRef" id="maniRef"value="${maniRef}">&nbsp;&nbsp;&nbsp;&nbsp;

                        </td>

                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="13">
                            <div style="">
                                <span>18b. Alternate Facility (or Generator)</span>
                                <br><input type="text" id="altFacility" name="altFacility"placeholder="${altFacility}">
                                <br><br>
                             <span style="">Facility's Phone:<input type="text" id="18bPhone" name="18bPhone"placeholder="${b18Phone}"></span>
                            </div>

                        </td>
                         <td colspan="5">U.S. EPA ID Number<input type="date" id="18bEPA" name="18bEPA"placeholder="${b18EPA}"></td>
                    </tr>
                                   <tr style="vertical-align: top;">
                        <td colspan="15">18c. Signature of Alternate Facility (or Generator)</td>

                        <td colspan="3"><input type="date" id="18cDate" name="18cDate" value="${c18Date}"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">19.Hazardous Waste Report Management Method Codes (i.e., codes for hazardous
                            waste treatment, disposal, and recycling systems)</td>
                    </tr>
                    <tr>
                        <td colspan="4">1<input type="text" id="code1" name="code1"placeholder="${code1}"></td>
                        <td colspan="5">2<input type="text" id="code2" name="code2"placeholder="${code2}"></td>
                        <td colspan="5">3<input type="text" id="code3" name="code3"placeholder="${code3}"></td>
                        <td colspan="4">4<input type="text" id="code4" name="code4"placeholder="${code4}"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18">20. Designated Facility Owner or Operator: Certification of receipt of
                            hazardous materials covered by the manifest except as noted in Item 18a</td>
                    </tr>
                    <td colspan="9">Printed/Typed Name<input type="text" id="printName" name="printName"placeholder="${printName}"></td>
                    <td colspan="6">Signature</td>
                    <td colspan="3"><input type="date" id="printDate" name="printDate"value="${printDate}"></td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td colspan="18"> <span style="color:red;text-align:end;">DESIGNATED FACILITY TO DESTINATION
                                STATE (IF REQUIRED)</span></td>
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
                window.location.href = "import-list-manifest-invoice.php";
                console.log("das")
                // Now, send the data to the server using AJAX
                $.ajax({
                    type: 'POST',
                    url: 'save_printed_content_import.php', // Update with the correct PHP script path
                    data: {
                        content: printWindow.document.documentElement.innerHTML,
                        filename: manifest_id
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