<?php

session_start();
 if ($_SESSION['user_role'] == 'admin') {


include "../layouts/nav_sidebar.php";
include "../dbconnect.php";

$sql = "SELECT * FROM users ORDER BY id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll();
// var_dump($users);



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    header('location: users.php');
    exit;
}

?>

<main>
    <div class="container-fluid px-4">

        <h1 class="mt-4">Users</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="../index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Users</li>
        </ol>

        <div class="card mb-4">

            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users List
            </div>

            <div class="card-body">

                <table id="datatablesSimple">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $no = 1;
                    foreach ($users as $user) {
                    ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['password']; ?></td>
                            <td><?= $user['role']; ?></td>
                            <td>
                                <button class="btn btn-danger delete" data-id="<?= $user['id']; ?>">Delete</button>

                                <a href="edit.php?id=<?= $user['id']; ?>" class="btn btn-warning">
                                    Edit
                                </a>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>
</main>


                <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-danger text-light">

                <h1 class="modal-title fs-5">
                    Delete User
                </h1>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>

                <form method="POST">

                    <input
                        type="hidden"
                        name="id"
                        id="user-id">

                    <button
                        type="submit"
                        class="btn btn-danger">
                        Delete
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

$(document).ready(function(){

    $('tbody').on('click', '.delete', function(){

        let id = $(this).data('id');

        $('#user-id').val(id);

        $('#deleteModal').modal('show');

    });

});

</script>

<?php
include "../layouts/footer.php";

 }else{
        header('location: ../login.php');
       }
?>