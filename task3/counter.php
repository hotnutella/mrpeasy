<?php include('User.class.php') ?>
<html>
    <head>
        <title>Counter app</title>
        <link rel="stylesheet" href="bootstrap.min.css" />

        <script src="jquery-3.6.0.min.js"></script>

        <script>
            function countup (username) {
                const newCount = parseInt(document.querySelector('#counter').innerHTML) + 1;
                document.querySelector('#counter').innerHTML = newCount;

                $.post("countup.php", {
                    username: username,
                    counter: newCount
                },
                (data) => {
                    console.log(data);
                });
            }
        </script>
    </head>
    <body>
        
        <?php if (strlen($_POST['username']) && strlen($_POST['password'])): ?>
            <?php $user = new User($_POST['username'], $_POST['password']); ?>

            <div class="h-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="col-6 mx-auto">
                        <h1><div id="counter"><?php echo $user -> data['counter'] ?></div></h1>
                        <button class="btn btn-primary" onclick="javascript:countup('<?php echo $_POST['username'] ?>');">+1</button>
                        <br />
                        <a href="index">Exit</a>
                    </div>
                </div>
            </div> 
        <?php else: ?>
            Please provide username and password! <br />
            <a href="index">Back to login page</a>
        <?php endif; ?>
    </body>

</html>