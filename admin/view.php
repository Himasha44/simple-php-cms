<?php 
include("templates/header.php");
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <?php
            $id = $_GET["id"];
            if ($id) {
                include("../connect.php");
                // Security: Cast to int to prevent SQL Injection
                $id = (int)$id; 
                $sqlSelectPost = "SELECT * FROM posts WHERE id = $id";
                $result = mysqli_query($conn, $sqlSelectPost);
                
                if ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                        <a href="index.php" class="btn btn-outline-secondary btn-sm">
                            &larr; Back to Dashboard
                        </a>
                        <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm fw-bold">
                            Edit This Post
                        </a>
                    </div>

                    <article class="post-container bg-white p-5 shadow-sm rounded-4">
                        <header class="mb-5">
                            <h1 class="display-5 fw-bold text-dark mb-3"><?php echo $data['title']; ?></h1>
                            <div class="text-muted d-flex align-items-center">
                                <span class="badge bg-primary me-3">Published</span>
                                <span><i class="bi bi-calendar"></i> <?php echo date("F j, Y", strtotime($data['date'])); ?></span>
                            </div>
                        </header>

                        <div class="post-summary lead text-secondary mb-5 p-4 bg-light rounded-3 border-start border-primary border-4">
                            <?php echo $data['summary']; ?>
                        </div>

                        <div class="post-body fs-5 text-dark" style="line-height: 1.8;">
                            <?php echo nl2br($data['content']); ?>
                        </div>
                    </article>

                <?php
                } else {
                    echo "<div class='alert alert-danger'>Post not found in the database.</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>No ID provided.</div>";
            }
            ?>
            
        </div>
    </div>
</div>

<?php
include("templates/footer.php");
?>