<html>
    <head>
        <title>Counter app</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/functions.js"></script>
    </head>
    <body>
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="col-6 mx-auto">
                    <?php
                        if (isset($_POST['action']) && $_POST['action'] === 'login') {
                            include('view/counter.view.php');
                        }
                        else {
                            include('view/login.view.php');
                        }
                    ?>
                </div>
            </div>
        </div>                
    </body>
</html>