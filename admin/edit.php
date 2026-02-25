<?php 
include("templates/header.php");
// Route protection
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

$id = $_GET['id'];
if($id){
    include("../connect.php");
    // Secure the ID variable to prevent basic SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $sqlEdit = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($conn, $sqlEdit);
} else {
    header("Location: index.php"); // Redirect if no ID is provided
}
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 ps-4">
                    <h2 class="fw-bold mb-0">Update Post</h2>
                    <p class="text-muted small">Modify the fields below to update your article.</p>
                </div>
                <div class="card-body p-4">
                    <form action="process.php" method="post">
                        <?php 
                        if ($data = mysqli_fetch_array($result)) {
                        ?>
                            <div class="form-group mb-4">
                                <label for="title" class="form-label fw-semibold text-secondary">Post Title</label>
                                <input type="text" class="form-control form-control-lg bg-light border-0" name="title" id="title" value="<?php echo $data['title']; ?>" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="summary" class="form-label fw-semibold text-secondary">Short Summary</label>
                                <textarea name="summary" class="form-control bg-light border-0" id="summary" rows="3" required><?php echo $data['summary']; ?></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="content" class="form-label fw-semibold text-secondary">Full Article Content</label>
                                <textarea name="content" class="form-control bg-light border-0" id="content" rows="12" required><?php echo $data['content']; ?></textarea>
                            </div>

                            <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <div class="d-flex justify-content-between align-items-center border-top pt-4">
                                <a href="index.php" class="btn btn-link text-secondary text-decoration-none">Discard Changes</a>
                                <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm fw-bold" name="update">
                                    Update Post
                                </button>
                            </div>
                        <?php
                        } else {
                            echo "<div class='alert alert-danger'>Post not found in database.</div>";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include("templates/footer.php");
?>