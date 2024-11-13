<?php
require_once "include/connection.php";
$level = $_POST["level"];
$result = mysqli_query($conn,"SELECT * FROM salaries where level = '$level'");
?>
<!-- <option value="">Select Salary</option> -->
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["salary"];?>"><?php echo $row["salary"];?></option>
<?php
}
?>