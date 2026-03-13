<?php
include "database/db.php";

//  emp_id อัตโนมัติ
$result_id = $conn->query("SELECT emp_id FROM employee ORDER BY emp_id DESC LIMIT 1");

if ($result_id->num_rows > 0) {

    $row = $result_id->fetch_assoc();
    $last_id = $row['emp_id'];
    $num = (int)substr($last_id, 3);
    $num++;

    $next_id = "EMP" . str_pad($num, 3, "0", STR_PAD_LEFT);
} else {

    $next_id = "EMP001";
}

if (isset($_POST['insert'])) {
    $id = $_POST['emp_id'];
    $name = $_POST['emp_name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    $conn->query("INSERT INTO employee (emp_id, emp_name, age, phone)
    VALUES ('$id','$name','$age','$phone')");
}

if (isset($_POST['update'])) {
    $id = $_POST['emp_id'];
    $name = $_POST['emp_name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    $conn->query("UPDATE employee 
                  SET emp_name='$name', age='$age', phone='$phone'
                  WHERE emp_id='$id'");
}

if (isset($_POST['delete'])) {
    $id = $_POST['emp_id'];

    $conn->query("DELETE FROM employee WHERE emp_id='$id'");
}

$result = $conn->query("SELECT * FROM employee");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Employee Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        <?php include "css/style.css"; ?>
    </style>


</head>

<body class="container mt-4">

    <h3>Employee Management</h3>

    <form method="POST">

        <div class="row align-items-end">

            <div class="col-md-3">
                <label>Employee ID</label>
                <input type="text" name="emp_id" id="emp_id"
                    class="form-control"
                    value="<?php echo $next_id; ?>" readonly>
                <input type="hidden" id="next_id" value="<?php echo $next_id; ?>">
            </div>

            <div class="col-md-3">
                <label>Name</label>
                <input type="text" name="emp_name" id="emp_name" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Age</label>
                <input type="text" name="age" id="age" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>

            <div class="col-md-1">
                <button type="button" class="btn btn-secondary w-100" onclick="clearForm()">
                    CLEAR
                </button>
            </div>

        </div>

        <br>

        <button type="submit" name="insert" class="btn btn-success">INSERT</button>
        <button type="submit" name="update" class="btn btn-warning">UPDATE</button>
        <button name="delete" class="btn btn-danger" onclick="return confirmDelete()">DELETE</button>

    </form>

    <hr>

    <h4>Employee List</h4>

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Phone</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <tr onclick="selectRow(this)">

                <td><?php echo $row['emp_id']; ?></td>
                <td><?php echo $row['emp_name']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['phone']; ?></td>

            </tr>

        <?php } ?>

    </table>


    <script src="js/script.js"></script>
</body>

</html>