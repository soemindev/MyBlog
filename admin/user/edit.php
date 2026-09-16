<?php

session_start();
 if ($_SESSION['user_role'] == 'admin') {


include "../dbconnect.php";

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id = :id";

$stmt = $conn->prepare($sql);

$stmt->bindParam(':id', $id);

$stmt->execute();

$user = $stmt->fetch();

// var_dump($user);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "UPDATE users
            SET name = :name,
                email = :email,
                password = :password,
                role = :role
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    header("location: users.php");
    exit;
}


include "../layouts/nav_sidebar.php";

?>

<div class="container-fluid px-4">

    <div class="mt-3">
        <h3 class="mt-4 d-inline">Edit User</h3>

        <a href="users.php" class="btn btn-danger float-end">
            Cancel
        </a>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="../index.php">Dashboard</a>
        </li>

        <li class="breadcrumb-item">
            <a href="users.php">Users</a>
        </li>

        <li class="breadcrumb-item active">
            Edit User
        </li>
    </ol>

    <div class="card mb-4">

        <div class="card-header">
            Edit User
        </div>

        <div class="card-body">

            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

                <div class="mb-3">
                    <label class="form-label">Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?= $user['name']; ?>"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= $user['email']; ?>"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>

                    <input
                        type="text"
                        name="password"
                        class="form-control"
                        value="<?= $user['password']; ?>"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>

                    <select name="role" class="form-select">

                        <option value="admin"
                            <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>
                            Admin
                        </option>

                        <option value="user"
                            <?= $user['role'] == 'user' ? 'selected' : ''; ?>>
                            User
                        </option>

                        <option value="author"
                            <?= $user['role'] == 'author' ? 'selected' : ''; ?>>
                            Author
                        </option>

                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<?php
include "../layouts/footer.php";

 }else{
        header('location: ../login.php');
       }
?>