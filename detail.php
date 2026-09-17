<?php
    include "layouts/navbar.php";
    include 'admin/dbconnect.php';

    $postID = $_GET['id'];
    // echo $postID;
    // die();

    $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id = users.id WHERE posts.id = :postID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':postID',$postID);
    $stmt->execute();
    $post = $stmt->fetch();
    // var_dump($post);
    // die();

    ?>

        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $post['title'] ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on <?= date('F d,Y', strtotime($post['created_at'])); ?></div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?=$post['c_name']; ?></a>
                            
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="admin/<?=$post['image']; ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p><?= $post['description']; ?></p>
                        </section>
                    </article>

                </div>
               

<?php
    include "layouts/footer.php";
    ?>
    