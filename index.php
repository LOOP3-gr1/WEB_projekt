<?php
require_once('includes/header.php');
if (isset($_SESSION['user_id'])) {
    $hideme = 'hideme';
} else {
    $hideme = 'showme';
}
if (!isset($_SESSION['user_id'])) {
    $showme = 'hideme';
} else {
    $showme = 'showme';
}
?>

<main>
    <div class="p-5 mb-4 rounded-3 frontpage">
        <div class="container-fluid py-5 bg-transp">
            <h1 class="display-6 fw-bold">Registration and Login System</h1>
            <p class="col-md-8 fs-6">This is an example of a user registration and login system. After the user registers and logs in, 
                he/she will gain access to a specific section of the website based on the given credentials.</p>
        </div>
    </div>
    <div class="container boxes">
        <div class="row align-items-end">
            <div class="col <?php echo $hideme; ?>">
                <h2>Register</h2>
                <p>User registration section of the site.</p>
                <p><a class="btn btn-secondary" href="registration.php" role="button">Register &raquo;</a></p>
            </div>
            <div class="col <?php echo $hideme; ?>">
                <h2>Login</h2>
                <p>User login section of the site.</p>
                <p><a class="btn btn-secondary" href="login.php" role="button">Login &raquo;</a></p>
            </div>
            <div class="col <?php echo $showme; ?>">
                <h2>Profile</h2>
                <p>View and Update the user profile</p>
                <p><a class="btn btn-secondary" href="profile.php" role="button">Profile &raquo;</a></p>
            </div>
        </div>
    </div>
</main>

<?php
require_once('includes/footer.php');
?>