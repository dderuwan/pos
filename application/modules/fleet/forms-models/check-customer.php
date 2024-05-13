To show the input field in red when the phone number already exists in the database, you can add a CSS class to the
input field to change its border color. Here's how you can modify your code to achieve this:

php
Copy code
<?php
require_once "layouts/config.php";

$phoneNumberErrorClass = ""; // Initialize CSS class for the phone number input

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form was submitted for a new customer

    // Get Customer Name, Address, Phone Number, and Budget from POST data
    $customername = $_POST['customername'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];

    // Check if the phone number already exists in the database
    $checkQuery = "SELECT COUNT(*) FROM customers WHERE phonenumber = ?";
    $checkStmt = $link->prepare($checkQuery);
    $checkStmt->bind_param("s", $phonenumber);
    $checkStmt->execute();
    $checkStmt->bind_result($phoneCount);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($phoneCount > 0) {
        echo '<script>alert("Phone Number already exists. Please enter a different phone number.")</script>';
        echo "Phone Number already exists. Please enter a different phone number.";
        $phoneNumberErrorClass = "error"; // Set CSS class for error styling
    } else {
        // Prepare and execute SQL query to insert data
        $query = "INSERT INTO customers (customername, address, phonenumber) VALUES (?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bind_param("sss", $customername, $address, $phonenumber);

        if ($stmt->execute()) {
            echo '<script>alert("New Customer Saved Successfully")</script>';
            echo "Data saved successfully.";
            // header("Location: customer-list.php");
        } else {
            echo '<script>alert("New Customer Save Error")</script>';
            echo "Error saving data.";
        }

        // Close the database connection
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Your HTML head content here -->
</head>

<body>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <style>
    /* Custom CSS */
    .modal-body .form-group {
        margin-bottom: 10px;
    }

    /* Adjust font size for select boxes and inputs */
    .modal-body select,
    .modal-body input {
        font-size: 14px;
    }

    #customerDialogLabel {
        text-align: center;
    }

    /* Style the "Save changes" button */
    .modal-footer .btn-primary {
        background-color: #28a745;
        /* Green color */
        border-color: #28a745;
    }

    /* Style the label and input elements horizontally */
    .modal-body .form-group label {
        display: inline-block;
        width: 30%;
        /* Adjust as needed */
        vertical-align: top;
    }

    .modal-body .form-group input,
    .modal-body .form-group select {
        display: inline-block;
        width: 68%;
        /* Adjust as needed */
        vertical-align: top;
    }

    /* Style the select element to match the form-control class */
    select#oldCustomerContact {
        width: 100%;
        /* Set the width to 100% to match the form-control width */
        padding: 6px 12px;
        /* Adjust padding as needed */
        font-size: 14px;
        /* Adjust font size as needed */
        border: 1px solid #ced4da;
        /* Match the form-control border */
        border-radius: 4px;
        /* Match the form-control border-radius */
    }

    /* Style the options within the select element */
    select#oldCustomerContact option {
        padding: 8px 12px;
        /* Adjust padding as needed */
        font-size: 14px;
        /* Adjust font size as needed */
    }
    </style>

    <div class="" id="customerDialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerDialogLabel">Select Customer Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add the form tag here -->
                    <form method="post">
                        <div class="form-group">
                            <label for="customerType">Customer Type:</label>
                            <select class="form-control" id="customerType" onchange="toggleCustomerFields()">
                                <option value="" selected>Please select customer type</option>
                                <!-- Default selected value -->
                                <option value="New">New Customer</option>
                                <option value="Old">Old Customer</option>
                            </select>
                        </div>

                        <!-- Additional fields for a new customer -->
                        <div id="newCustomerFields" style="display: none;">
                            <div class="form-group">
                                <label for="newCustomerName">Customer Name:</label>
                                <input type="text" class="form-control" id="newCustomerName" name="customername">
                            </div>
                            <div class="form-group">
                                <label for="newCustomerAddress">Customer Address:</label>
                                <input type="text" class="form-control" id="newCustomerAddress" name="address">
                            </div>
                            <div class="form-group">
                                <label for="newCustomerContact">Contact Number:</label>
                                <input type="text" class="form-control" id="newCustomerContact" name="phonenumber"
                                    oninput="toggleSubmitButton()">
                                <span style="color: red;"><?php echo $phoneNumberErrorClass; ?></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>


                        <!-- Additional fields for an old customer -->
                        <div id="oldCustomerFields" style="display: none;">
                            <div class="form-group">
                                <label for="oldCustomerContact">Contact Number:</label>

                                <select class="form-control" id="oldCustomerContact" name="oldCustomerContact">
                                    <option value="" style="width:100px">Please select a contact number</option>
                                    <?php
                                    // Retrieve phone numbers, customer names, and addresses from the database
                                    $query = "SELECT phonenumber, customername, address FROM customers";
                                    $result = mysqli_query($link, $query);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $phoneNumber = $row['phonenumber'];
                                        $customerName = $row['customername'];
                                        $customerAddress = $row['address'];
                                        
                                        // Output each option element with data attributes for customer name and address
                                        echo '<option value="' . $phoneNumber . '" data-customername="' . $customerName . '" data-customeraddress="' . $customerAddress . '">' . $phoneNumber . '</option>';
                                    }
                                    ?>

                                </select>

                            </div>
                            <div class="form-group">
                                <label for="oldCustomerName">Customer Name:</label>
                                <input type="text" class="form-control" id="oldCustomerName" name="oldCustomerName"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="oldCustomerAddress">Customer Address:</label>
                                <input type="text" class="form-control" id="oldCustomerAddress"
                                    name="oldCustomerAddress" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="openCommercialInvoiceModal()">Next Step</button>
                            </div>
                        </div>
                        <div class="modal fade" id="commercialInvoiceModalContent" style="display: none;">
                            <?php include 'commercialInvoiceModal.php'; ?>
                        </div>


                    </form> <!-- Close the form tag -->
                </div>
            </div>
        </div>
    </div>

    <script>
    function toggleSubmitButton() {
        // Get the Phone Number input
        var phoneNumberInput = document.getElementById('phonenumber');
        // Get the value of the Phone Number input
        var phoneNumberValue = phoneNumberInput.value.trim();
        // Get the submit button
        var submitButton = document.getElementById('submitButton');

        // Enable the submit button if Phone Number is not empty, otherwise disable it
        if (phoneNumberValue !== '') {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    function toggleCustomerFields() {
        const selectedOption = $('#customerType').val();
        const newCustomerFields = $('#newCustomerFields');
        const oldCustomerFields = $('#oldCustomerFields');

        if (selectedOption === 'New') {
            newCustomerFields.show();
            oldCustomerFields.hide();
        } else {
            newCustomerFields.hide();
            oldCustomerFields.show();
        }
    }
    $(document).ready(function() {
        // Initialize Select2 for the contact number dropdown
        $('#oldCustomerContact').select2({
            width: '68%',
            height: '50px' // Set the width to match the form-control width
        });

        // Handle selection change in the contact number dropdown
        $('#oldCustomerContact').change(function() {
            const selectedContact = $(this).val();
            const selectedOption = $(this).find('option:selected');

            if (selectedContact) {
                // Retrieve the customer name and address from the data attributes
                const customerName = selectedOption.data('customername');
                const customerAddress = selectedOption.data('customeraddress'); // Get the address
                console.log(customerAddress)
                // console.log(customerAddress)
                // Populate the 'oldCustomerName' and 'oldCustomerAddress' input fields
                $('#oldCustomerName').val(customerName);
                $('#oldCustomerAddress').val(customerAddress); // Set the address
            } else {
                // Clear the 'oldCustomerName' and 'oldCustomerAddress' input fields if no contact is selected
                $('#oldCustomerName').val('');
                $('#oldCustomerAddress').val('');
            }
        });
    });

    function openCommercialInvoiceModal() {
        // Get the selected customer name and phone number
        const customerName = $('#oldCustomerName').val();
        const customerPhoneNumber = $('#oldCustomerContact').val();
        const customerAddress = $('#oldCustomerAddress').val(); // Get the address

        // Set the values in the commercialInvoiceModal form
        $('#commercialInvoiceModalContent').find('input[name="consigneeName"]').val(customerName);
        $('#commercialInvoiceModalContent').find('input[name="consigneePhone"]').val(customerPhoneNumber);
        $('#commercialInvoiceModalContent').find('input[name="address"]').val(customerAddress); // Set the address

        // Show the commercialInvoiceModal
        $('#commercialInvoiceModalContent').modal('show');
    }
    </script>
</body>

</html>