<?php 
include("templates/header.php");
// Ensure only logged-in users can reach this page
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create New Post</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 ps-4">
                    <h2 class="fw-bold mb-0">Add New Post</h2>
                    <p class="text-muted small">Fill in the details below to publish a new article.</p>
                </div>
                <div class="card-body p-4">
                    <form action="process.php" method="post">
                        <div class="form-group mb-4">
                            <label for="title" class="form-label fw-semibold">Post Title</label>
                            <input type="text" class="form-control form-control-lg bg-light" name="title" id="title" placeholder="e.g. Journey to the Mountains" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="summary" class="form-label fw-semibold">Short Summary</label>
                            <textarea name="summary" class="form-control bg-light" id="summary" rows="3" placeholder="A brief hook for your readers..." required></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="content" class="form-label fw-semibold">Full Article Content</label>
                            <textarea name="content" class="form-control bg-light" id="content" rows="12" placeholder="Tell your story..." required></textarea>
                        </div>

                        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="index.php" class="text-decoration-none text-secondary">Cancel and return</a>
                            <input type="submit" class="btn btn-primary px-5 py-2 shadow-sm fw-bold" value="Publish Post" name="create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include("templates/footer.php");
?>