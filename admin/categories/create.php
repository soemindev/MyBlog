<?php

session_start();
 if ($_SESSION['user_role'] == 'admin') {

include "../dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];

    $sql = "INSERT INTO categories (name)
            VALUES (:name)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':name', $name);

    $stmt->execute();

    header("location: categories.php");
    exit;
}

include "../layouts/nav_sidebar.php";

?>

<div class="container-fluid px-4">

    <div class="mt-3">
        <h3 class="mt-4 d-inline">Categories</h3>

        <a href="categories.php" class="btn btn-danger float-end">
            Cancel
        </a>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="../index.php">Dashboard</a>
        </li>

        <li class="breadcrumb-item">
            <a href="categories.php">Categories</a>
        </li>

        <li class="breadcrumb-item active">
            Categories Create
        </li>
    </ol>

    <div class="card mb-4">

        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Create Category
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Category Name
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                    >
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<?php
include "../layouts/footer.php";

    header('Location: ../login.php');
        }

?>