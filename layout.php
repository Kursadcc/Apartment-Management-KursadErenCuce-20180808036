<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <!-- <link rel="shortcut icon" href="img/icons/icon-48x48.png" /> -->
    <link rel="shortcut icon" href="../img/kccproperty.png" />

    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="../js/app.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="../js/validatorRules.js"></script>

</head>

<body>
    <?php
    $loginResult = checkLogin();
    if (!$loginResult) {
        header("Refresh: 2; url=loginPage.php");
    } else if ($_SESSION["isManager"] != "1") {
        $isManager = false;
    } else {
        $isManager = true;
    }
    ?>
    <div class="wrapper">

        <?php
        $selectedMenuName = $selectedMenu;
        if ($isManager == true)
            include 'sidebar.php';
        else {
            include 'residentSidebar.php';
        }
        ?>

        <div class="main" style="background-color:rgb(241,241,241);">

            <?php include 'header.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <?php
                    include($content);
                    ?>
                </div>
            </main>

            <?php include 'footer.php'; ?>


        </div>
    </div>
</body>
<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<script>
    $(document).ready(function() {

        window.setDataTable = function(controlId) {
            var table = $('#' + controlId).DataTable({
                "iDisplayLength": 20,
                "lengthMenu": [
                    [20, 50, 100, -1],
                    [20, 50, 100, "All"]
                ],
                "pageLength": 20,
                "sDom": 'Tl<"pull-right" f><"pull-right mt-5" B>rtip',

                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "oTableTools": {

                    "aButtons": [{
                            "sExtends": "xls",
                            "bSelectedOnly": true
                        },
                        {
                            "sExtends": "pdf",
                            "bSelectedOnly": true
                        },
                        {
                            "sExtends": "copy",
                            "bSelectedOnly": true
                        }
                    ],
                    "sSwfPath": "../../Scripts/datatable/swf/copy_csv_xls_pdf.swf",
                },
                "proccessing": true,

            });
        }



    });
</script>

</html>