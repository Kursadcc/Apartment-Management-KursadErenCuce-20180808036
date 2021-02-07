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
    <link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    <link href="../css/app.css" rel="stylesheet">

</head>

<body>
    <div class="wrapper">

    <?php 
    $selectedMenuName = $selectedMenu;
    include 'sidebar.php';
    ?>

    <div class="main" style="background-color:rgb(241,241,241);">

        <?php include 'header.php';?>

            <main class="content">
                <div class="container-fluid p-0">
                    <?php include($content); ?>
                </div>
            </main>

            <?php include 'footer.php';?>
            
            <script src="../js/app.js"></script>
            <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
            
        </div>
    </div>
</body>

</html>