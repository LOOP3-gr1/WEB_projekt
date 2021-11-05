<?php
require_once('includes/header.php');
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $query = "DELETE users, user_info FROM users, user_info WHERE user_info.user_id = '$user_id' AND users.user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    if ($result) echo "<p class='warn'>User Deleted</p>";
    if (!$result) {
        echo "<p class='error'>DELETE FAILED: " . $query . "<br>" . mysqli_error($con) . "</p>";
    }
}

?>

<fieldset>
    <legend>Delete Users (from table user_info)</legend>
    <table class="users">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>User Type</th>
                <th>Email</th>
                <th>Slet</th>

            </tr>
        </thead>

        <tbody>
            <?php
            require_once('includes/header.php');
            $query = "SELECT * FROM users, user_info WHERE user_info.user_id = users.user_id";
            $result = mysqli_query($con, $query);
            if (!$result) {
                echo "<p class='error'>The records could not be retrieved: " . mysqli_error($con) . "</p>";
                die();
            }
            $rows = mysqli_num_rows($result);
            if ($rows == 0) echo "<p class='error'>No records to display</p>";
            echo "<p class='records'><em>" . $rows . " users registered</em>.</p>";
            if ($rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $user_id = $row['user_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $user_type = $row['user_type'];
                    $email = $row['email'];
                    $password = $row['password'];

            ?>
                    <tr>
                        <td><?php echo $first_name; ?></td>
                        <td><?php echo $last_name; ?></td>
                        <td><?php echo $user_type; ?></td>
                        <td><?php echo $email; ?></td>


                        <td>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <input type="submit" value="Delete">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            </form>
                        </td>
                    </tr>
            <?php
                }
            }

            ?>
        </tbody>
    </table>
</fieldset>

<?php
require_once('includes/footer.php');
?>