<?php 
include '../dbconnect.php';

if($_SERVER ['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $created = date('Y-m-d H:i:s');


    $sql = "INSERT INTO users (name,email,password,created)
    VALUE (:name , :email, :password, :created )";

    $stmt = $conn->prepare($sql);
    $stmt ->bindParam( ':name', $name);
    $stmt ->bindParam( ':email', $email);
    $stmt ->bindParam( ':password', $password);
    $stmt ->bindParam( ':created', $created );

    $stmt ->execute();

    header ('location: user.php');

    



}

include '../layouts/nav_sidebar.php';
?>

<div class="container-fluid px-4">
            
            <div class="mt-3">
                <h3 class="mt-4 d-inline">Posts</h3>
                <a href="posts.php" class="btn btn-danger float-end">Cancel</a>
            </div>
            
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="user.php">Users</a></li>
                <li class="breadcrumb-item active">Users Create</li>

            </ol>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Create Users
                </div>
                <div class="card-body">
                    <form action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Users Name</label>
                            <input type="text" class="form-control" id="title" name="name">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" class="form-control" id="password"></input>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php 
include '../layouts/footer.php';

?>
