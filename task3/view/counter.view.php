<?php include('model/User.class.php') ?>
<?php if (strlen($_POST['username']) && strlen($_POST['password'])): ?>
    <?php $user = new User($_POST['username'], $_POST['password']); ?>
    <div class="h-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="col-6 mx-auto">
                <h1><div id="counter"><?php echo $user -> data['counter'] ?></div></h1>
                <button class="btn btn-primary" onclick="javascript:countup('<?php echo $_POST['username'] ?>');">+1</button>
                <br />
                <a href="">Exit</a>
            </div>
        </div>
    </div> 
<?php else: ?>
    Please provide username and password! <br />
    <a href="">Back to login page</a>
<?php endif; ?>