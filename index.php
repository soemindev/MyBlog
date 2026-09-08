<?php
include 'layouts/nav.php';

include 'admin/dbconnect.php';

$sql = "SELECT posts.*, categories.name as c_name , users.name as u_name FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC";

$stmt = $conn->prepare($sql);
$stmt -> execute();

$posts = $stmt->fetchAll();
// var_dump($posts);
?>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                    <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">January 1, 2023</div>
                            <h2 class="card-title">Featured Post Title</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                            <a class="btn btn-primary" href="detail.php?id=<?= $post['id'] ?>">Read more →</a>
                        </div>
                    </div>
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">

                    <?php 
                        foreach($posts as $post){
                    ?>
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="admin/<?= $post['image'] ?>" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted"><?= date('F d, y', strtotime($post['created'])) ?></div>
                                    <h2 class="card-title h4"><?= $post['title'] ?></h2>
                                    <p class="card-text"><?= $post['description'] ?></p>
                                    <a class="btn btn-primary" href="detail.php?id=<?= $post['id'] ?>">Read more →</a>
                                </div>
                            </div>
                            <!-- Blog post-->
                            
                        </div>
                        <?php }?>
                    </div>                                  
                </div>

<?php
include 'layouts/footer.php';
?>
                