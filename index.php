  <?php
        include "layouts/navbar.php";

        include "admin/dbconnect.php";

        if(isset($_GET['categoryID'])){

            $categoryID = $_GET['categoryID'];
            $sql = "SELECT * FROM posts WHERE posts.category_id = :categoryID ORDER BY id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':categoryID', $categoryID);
            $stmt->execute();
            $posts = $stmt->fetchAll();

        }else{

        
  $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name 
        FROM posts 
        INNER JOIN categories ON posts.category_id = categories.id 
        INNER JOIN users ON posts.user_id = users.id 
        ORDER BY posts.id DESC 
        LIMIT 18446744073709551615 OFFSET 1";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  //var_dump($stmt);
  $posts = $stmt->fetchAll();
//   var_dump($posts);

  $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $post = $stmt->fetch();
//   var_dump($post);

        }

        ?> 
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Soe's Blog !</h1>
                    <p class="lead mb-0">I Learn For Me , I Share For You</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->

                    <?php
                        if (isset($_GET['categoryID'])){

                        }else{

                      ?>


                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="admin/<?= $post['image'] ?>" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted"><?= date('F d, Y', strtotime($post['created_at'])) ?></div>
                            <h2 class="card-title"><?= $post['title'] ?></h2>
                            <p class="card-text"><?= substr($post['description'],0,300) ?></p>
                            <a class="btn btn-primary" href="detail.php?id=<?= $post['id'] ?>">Read more →</a>
                        </div>
                    </div>

                    <?php
                        }
                    ?>

                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">

                         <?php
                              foreach($posts as $post){

                             ?>


                            <div class="col-lg-6">
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" src="admin/<?=$post['image']?>" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted"><?= date('F d, Y', strtotime($post['created_at'])) ?></div>
                                        <h2 class="card-title h4"><?= $post['title'] ?></h2>
                                        <p class="card-text"><?= substr($post['description'],0,300) ?></p>
                                        <a class="btn btn-primary" href="detail.php?id=<?= $post['id'] ?>">Read more →</a>
                                    </div>
                                </div>
                            </div>
                  
                        <?php
                         }
                         ?>
                    </div>
                </div>
                
    <?php
        include "layouts/footer.php";
        ?>            