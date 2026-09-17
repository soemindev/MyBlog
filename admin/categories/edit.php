<?php

session_start();
 if ($_SESSION['user_role'] == 'admin') {

include "../dbconnect.php";

$id = $_GET['id'];

$sql = "SELECT * FROM categories WHERE id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$category = $stmt->fetch();
// var_dump($category);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];

    $sql = "UPDATE categories
            SET name = :name
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    header("location: categories.php");
    exit;
}

include "../layouts/nav_sidebar.php";

?>

<div class="container-fluid px-4">

    <div class="mt-3">
        <h3 class="mt-4 d-inline">Edit Category</h3>

        <a href="categories.php" class="btn btn-danger float-end">
            Cancel
        </a>
    </div>

    <div class="card mb-4 mt-4">

        <div class="card-header">
            Edit Category
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Category Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?= $category['name']; ?>"
                    >
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