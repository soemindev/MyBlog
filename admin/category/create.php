<?php 
include '../dbconnect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name =$_POST['name'];
    $created = 1;

    $sql="INSERT INTO categories (name,created)
    VALUE (:name , :created)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':created',$created);
    $stmt->execute();

    header('location: category.php');



}

include '../layouts/nav_sidebar.php';
?>

    <div class="container-fluid px-4">
            
            <div class="mt-3">
                <h3 class="mt-4 d-inline">Category</h3>
                <a href="category.php" class="btn btn-danger float-end">Cancel</a>
            </div>
            
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="category.php">Category</a></li>
                <li class="breadcrumb-item active">Post Create</li>

            </ol>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Create Posts
                </div>
                <div class="card-body">
                    <form action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
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


