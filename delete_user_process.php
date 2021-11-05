<?php
require_once('includes/header.php');

if (isset($_POST['user_id'])) {
    $user_id = get_post($con, 'user_id');
    $query = "DELETE FROM user_info WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<p class='warn'>Record deleted</p>";
        echo "<p>User ID: " . $user_id . "</p>";
    }
    if (!$result) {
        echo "<p class='error'>DELETE FAILED: " . mysqli_error($con) . ".</p>";
        die();
    }
}
    function get_post($con, $var) {
        return mysqli_real_escape_string($con, $_POST[$var]);
    }

?>


<?php
require_once('includes/footer.php');
?>