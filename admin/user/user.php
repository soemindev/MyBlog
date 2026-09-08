<?php 
include '../layouts/nav_sidebar.php';
include '../dbconnect.php';

$sql = 'SELECT * FROM  users';
$stmt = $conn -> prepare($sql);
$stmt -> execute();

$users = $stmt -> fetchAll();
?>

<main>
                    <div class="container-fluid px-4">
                        
                        <div class="mt-5 mb-2">
                            <h1 class="mt-4 d-inline">Users</h1>                          
                            <a href="create.php" class="btn btn-primary float-end ">Create User</a>
                            
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
                                <table id="datatablesSimple" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach($users as $user) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $user['name'];?></td>
                                                <td><?php echo $user['email'];?></td>
                                                <td><?php echo $user['password'];?></td>
                                                <td><?php echo $user['created'];?></td>
                                                
                                                <td>
                                                    <button class="btn btn-danger">Delete</button>
                                                    <button class="btn btn-warning">Edit</button>
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