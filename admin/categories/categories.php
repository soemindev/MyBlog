<?php

            session_start();
        
            if ($_SESSION['user_role'] == 'admin') {
   

            include "../dbconnect.php";

            $sql = "SELECT * FROM categories ORDER BY id DESC";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $categories = $stmt->fetchAll();


            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];

            $sql = "DELETE FROM categories WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            header("location: categories.php");
            exit;
        }

            include "../layouts/nav_sidebar.php";

            ?>

                 <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Categories</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                   <tbody>

                                    <?php
                                    $no = 1;

                                    foreach ($categories as $category) {
                                    ?>

                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $category['name']; ?></td>
                                        <td>
                                            <button class="btn btn-danger delete"
                                                    data-id="<?= $category['id']; ?>">
                                                Delete
                                            </button>

                                            <a href="edit.php?id=<?= $category['id']; ?>"
                                            class="btn btn-warning">
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

                <div class="modal fade" id="deleteModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5">Delete Category</h1>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete this category?
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
                        id="category-id">

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

        $('#category-id').val(id);

        $('#deleteModal').modal('show');

    });

});

</script>

<?php
  include "../layouts/footer.php";

    header('Location: ../login.php');
        }

  ?>