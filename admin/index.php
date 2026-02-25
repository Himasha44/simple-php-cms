<?php 
include("templates/header.php");
// It is recommended to check for a session here to protect the route
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>

<div class="posts-list w-100 p-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manage Posts</h2>
        <a href="create.php" class="btn btn-primary">+ Add New Post</a>
    </div>

    <?php
    // Consolidated Session Alerts
    $messages = ['create', 'update', 'delete'];
    foreach ($messages as $msg) {
        if (isset($_SESSION[$msg])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    ' . $_SESSION[$msg] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION[$msg]);
        }
    }
    ?>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../connect.php');
                    $sqlSelect = "SELECT * FROM posts ORDER BY id DESC"; // Newest posts first
                    $result = mysqli_query($conn, $sqlSelect);

                    if (mysqli_num_rows($result) > 0) {
                        while($data = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td class="ps-4 text-muted" style="font-size: 0.9rem;"><?php echo $data["date"]?></td>
                            <td class="fw-bold"><?php echo $data["title"]?></td>
                            <td>
                                <div class="text-truncate" style="max-width: 300px;">
                                    <?php echo $data["summary"]?>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-outline-info" href="view.php?id=<?php echo $data["id"]?>">View</a>
                                    <a class="btn btn-outline-warning" href="edit.php?id=<?php echo $data["id"]?>">Edit</a>
                                    <a class="btn btn-outline-danger" 
                                       onclick="return confirm('Are you sure you want to delete this post?')" 
                                       href="delete.php?id=<?php echo $data["id"]?>">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }
                    } else {
                        echo '<tr><td colspan="4" class="text-center p-5 text-muted">No posts found. Create your first post!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include("templates/footer.php");
?>