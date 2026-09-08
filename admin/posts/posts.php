<?php
include '../layouts/nav_sidebar.php';

include '../dbconnect.php';

$sql = "SELECT posts.*, categories.name as c_name , users.name as u_name FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC";
// $sql = "SELECT * FROM posts";

$stmt = $conn->prepare($sql);
$stmt -> execute();

$posts = $stmt->fetchAll();
// var_dump($posts);
?>
    <main>
                    <div class="container-fluid px-4">
                        
                        <div class="mt-5 mb-2">
                            <h1 class="mt-4 d-inline">Posts</h1>
                            <a href="create.php" class="btn btn-primary float-end">Create Posts</a>
                            
                        </div>
                        
                        
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>

                                        <?php 
                                        $no = 1;
                                        foreach($posts as $post) { 
                                            ?>

                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $post['title'];?></td>
                                                <td><?php echo $post['c_name'];?></td>
                                                <td><?php echo $post['u_name'];?></td>
                                                <td>
                                                    <button class="btn btn-danger">Delete</button>
                                                    <a href="edit.php?id=<?= $post['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                </td>
                                            </tr>
                                            
                                        <?php }?>

                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
    </main>

            
<?php
include '../layouts/footer.php';
?>