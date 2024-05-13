<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="index.php">
                        <i class="icon-s" data-feather="home"></i>

                        <span data-key="t-dashboard">
                            <?php echo $language['Dashboard'] ?>
                        </span>
                    </a>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="icon-s" data-feather="send"></i>
                        <span data-key="t-ecommerce">Export </span>

                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="export-new-forms.php" key="t-products">New Export Forms </a></li>
                        <li><a href="export-list-forms.php" data-key="t-product-detail">Export Form List
                            </a></li>

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="icon-s" data-feather="corner-left-down"></i>
                        <span data-key="t-ecommerce">Import</span>

                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="import-new-form.php" key="t-products">New Import Forms </a></li>
                        <li> <a href="import-list-manifest-invoice.php" data-key="t-product-detail">Manifest
                                Invoice List
                            </a></li>
                        <li> <a href="import-list-delivery-order-invoice.php" data-key="t-product-detail"
                                class="d">Delivery Order List
                            </a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="icon-s" data-feather="users"></i>
                        <span data-key="t-ecommerce">Account Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <!-- <i data-feather=""></i> -->
                                <span data-key="t-ecommerce">Customer</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="customer-add.php" key="t-product-detail" class="ca">Add New
                                        Customer</a>
                                </li>
                                <li>
                                    <a href="customer-list.php" key="t-product-detail" class="cass">Customer
                                        List</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <!-- <i data-feather=""></i> -->
                                <span data-key="t-ecommerce">Vendor</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="vendor-add.php" key="t-products" class="va">Add New Vendor</a>
                                </li>
                                <li>
                                    <a href="vendor-list.php" key="t-products" class="vl">Vendor List</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <!-- <i data-feather="user-plus"></i> -->
                                <span data-key="t-ecommerce">Debit Account</span>
                            </a>
                            <ul class="sub-menu">
                                <!-- <li>
                                            <a href="customer-add.php" key="t-products" class="ca">Add New Customer</a>
                                        </li>
                                        <li>
                                            <a href="customer-list.php" key="t-products" class="cass">Customer List</a>
                                        </li> -->
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <!-- <i data-feather="user-plus"></i> -->
                                <span data-key="t-ecommerce">Credit Account</span>
                            </a>
                            <ul class="sub-menu">
                                <!-- <li>
                                            <a href="customer-add.php" key="t-products" class="ca">Add New Customer</a>
                                        </li>
                                        <li>
                                            <a href="customer-list.php" key="t-products" class="cass">Customer List</a>
                                        </li> -->
                            </ul>
                        </li>
                    </ul>
                </li>


                <!--<li>-->
                <!--    <a href="javascript: void(0);" class="has-arrow">-->
                <!--        <i class="icon-s" data-feather="package"></i>-->
                <!--        <span data-key="t-ecommerce">Shippers</span>-->

                <!--    </a>-->
                <!--    <ul class="sub-menu" aria-expanded="false">-->
                <!--        <li><a href="shipper-add.php" key="t-products" class="ca">Add New Shipper</a></li>-->
                <!--        <li><a href="shipper-list.php" key="t-products" class="cass">Shipper List</a></li>-->
                <!--    </ul>-->
                <!--</li>-->



                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="icon-s" data-feather="dollar-sign"></i>
                        <span data-key="t-ecommerce">Credit Note</span>

                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li> <a href="credit-invoice.php" data-key="t-product-detail" class="d">Credit Invoice
                            </a></li>
                        <li> <a href="credit-invoice-list.php" data-key="t-product-detail" class="d">Credit Invoice List
                            </a></li>
                        <!-- 
                                <li> <a href="debit-invoice.php" data-key="t-product-detail">Debit
                                        invoice
                            </a></li> -->
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="icon-s" data-feather="dollar-sign"></i>
                        <span data-key="t-ecommerce">Debit Note</span>

                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li> <a href="debit-invoice.php" data-key="t-product-detail" class="d">Debit Invoice
                            </a></li>
                        <li> <a href="debit-invoice-list.php" data-key="t-product-detail" class="d">Debit Invoice List
                            </a></li>
                        <!-- 
                                <li> <a href="debit-invoice.php" data-key="t-product-detail">Debit
                                        invoice
                                    </a></li> -->

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="icon-s" data-feather="truck"></i>
                        <span data-key="t-ecommerce">Fleet Management</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="fleet_driver.php" key="t-products">Driver </a></li>
                        <li> <a href="fleet_customer.php" data-key="t-product-detail">Customer
                            </a></li>
                        <li> <a href="fleet_vehicle.php" data-key="t-product-detail" class="d">Vehical </a></li>
                        <li> <a href="fleet_booking.php" data-key="t-product-detail" class="d">Booking </a></li>
                        <li> <a href="fleet_availability.php" data-key="t-product-detail" class="d">Availability </a>
                        </li>
                        <li> <a href="fleet_insurance.php" data-key="t-product-detail" class="d">Insurance </a></li>
                        <li> <a href="fleet_maintenance.php" data-key="t-product-detail" class="d">Maintenance </a></li>
                        <li> <a href="fleet_fuel.php" data-key="t-product-detail" class="d">Manage Fuel </a></li>
                        <li> <a href="fleet_setup.php" data-key="t-product-detail" class="d">System Setup </a></li>

                    </ul>
                </li>
            </ul>

            <style>
                /* .#side-menu {} */

                .logo-side span {
                    font-size: 16px;
                    font-weight: 600;
                    margin-left: 10px;
                }

                /* .h-100{
                            background-color:#212529;
                        }
                         */
                .vertical-menu #side-menu li {
                    margin-bottom: 10px;
                }

                /* Hover link color */

                .vertical-menu #side-menu li a:hover {
                    /* Change this to your desired hover color */

                    color: #ff9f1a !important
                }

                .icon-s {
                    color: #ff9f1a !important
                }

                /* CSS for active sidebar menu item */
                .vertical-menu #side-menu li.active {
                    background-color: #ff9f1a !important;
                    /* Change this to your desired active color */
                    color: yellow;
                    /* Change this to your desired active text color */
                }
            </style>
        </div>
        <!-- Sidebar -->
    </div>
</div>