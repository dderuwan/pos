<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Include necessary files and database connection
    require_once "layouts/config.php";
    include 'layouts/session.php';
    include 'layouts/head-main.php';

    // Fetch data from the database (example)
    $query = "SELECT * FROM invoice_commercial";
    $result = mysqli_query($link, $query);

    if (isset($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];

        // Prepare DELETE query and execute it
        $deleteQuery = "DELETE FROM invoice_commercial WHERE bl_no = '$deleteId'";
        if (mysqli_query($link, $deleteQuery)) {
            // Redirect back to the main page after successful deletion
            header("Location: export-list-forms.php");
            exit();
        } else {
            // Display an error message if deletion fails
            echo "Error deleting record: " . mysqli_error($link);
        }
    }
    ?>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <style>
        .fc-button-group {
            background-color: #daf5f5 !important;
            /* Change this to highlight color */
        }

        .fc-button-primary {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        .fc-button-primary:hover {
            background-color: #0056b3 !important;
            border-color: #0056b3 !important;
        }

        .fc-button-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5) !important;
        }
    </style>

    <title>
        <?php echo $language["DataTables"]; ?> | New Shaheen LLC - Admin & Dashboard
    </title>

    <?php include 'layouts/head.php'; ?>
    <!-- DataTables -->
    <?php include 'layouts/head-style.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

</head>

<body>
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
                    $maintitle = "List";
                    $title = "Vehicle Calendar";
                    ?>
                    <?php include 'layouts/breadcrumb.php'; ?>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6"></div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Calendar</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id='calendar'></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="mb-4">Bookings</h4>
                                                        <ul class="event-cards list-group list-group-flush mt-3 w-100">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <!-- JavaScript and jQuery libraries -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var calendarEl = document.getElementById('calendar');
                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                initialView: 'dayGridMonth',
                                headerToolbar: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                                },
                                buttonText: {
                                    timeGridDay: "Day",
                                    timeGridWeek: "Week",
                                    dayGridMonth: "Month"
                                },
                            });
                            calendar.render();
                        });
                    </script>
                </div>
            </div>
            <!-- End Page-content -->

            <?php include 'layouts/footer.php'; ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <?php include 'layouts/right-sidebar.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>
</body>

</html>