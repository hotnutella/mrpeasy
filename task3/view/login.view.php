<form method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control" />
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" />
    </div>

    <input type="hidden" name="action" value="login" />

    <br />
    <input type="submit" value="Log in" class="btn btn-primary form-control" />
</form> 