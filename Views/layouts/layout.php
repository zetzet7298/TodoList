<html>
<head>
    <title><?php echo "TodoList"; ?></title>
    <link rel="stylesheet" href="./public/assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/assets/css/calendar.css">
    <link rel="stylesheet" href="./public/assets/css/work.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <script src="./public/assets/dist/js/jquery.min.js"></script>
    <script src="./public/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/assets/dist/js/moment.min.js"></script>
</head>
<body>
<?php include "header.php";?>
<section class="py-5">
    <div class="container">
<!--        <h1 class="fw-light">--><?php //echo $title; ?><!--</h1>-->
        <?php include $viewPath?>
    </div>
</section>
<?php include "footer.php";?>
</body>
<script src="./public/assets/js/calendar.js"></script>
<script src="./public/assets/js/work.js"></script>
</html>
