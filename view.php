<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog | Portfolio Project</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc !important; 
        }
        .navbar { background-color: #1e293b !important; }
        .card { 
            transition: transform 0.2s ease, box-shadow 0.2s ease; 
            border-radius: 12px;
        }
        .card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; 
        }
        .btn-primary { 
            background-color: #6366f1; 
            border: none; 
            font-weight: 600;
        }
        .btn-primary:hover { background-color: #4f46e5; }
        .date-badge { font-size: 0.8rem; letter-spacing: 0.05em; color: #64748b; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <span class="text-primary">Simple</span>Blog
            </a>
            <div class="ms-auto">
                <a href="admin/index.php" class="btn btn-outline-light btn-sm px-3 rounded-pill">Admin Portal</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <header class="mb-5 text-center">
            <h1 class="fw-bold text-dark">Latest Articles</h1>
            <p class="text-muted">Explore my latest thoughts and stories</p>
        </header>

        <div class="row">
            <?php
            include("connect.php");
            // Added ORDER BY DESC to ensure the newest content appears first
            $sqlSelect = "SELECT * FROM posts ORDER BY id DESC";
            $result = mysqli_query($conn, $sqlSelect);
            
            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="col-md-4 mb-4">
                        <article class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <span class="date-badge text-uppercase fw-bold mb-2 d-block">
                                    <?php echo $data["date"]; ?>
                                </span>
                                <h2 class="h5 card-title fw-bold">
                                    <a href="view.php?id=<?php echo $data['id']; ?>" class="text-decoration-none text-dark">
                                        <?php echo $data["title"]; ?>
                                    </a>
                                </h2>
                                <p class="card-text text-secondary mb-4">
                                    <?php 
                                        // Using summary column if it exists, otherwise trimming content
                                        $preview = !empty($data["summary"]) ? $data["summary"] : $data["content"];
                                        echo substr(strip_tags($preview), 0, 100) . '...';
                                    ?>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-0 px-4 pb-4">
                                <a href="view.php?id=<?php echo $data['id']; ?>" class="btn btn-primary w-100 py-2">Read Article</a>
                            </div>
                        </article>
                    </div>
                <?php 
                } 
            } else {
                echo '<div class="col-12 text-center py-5"><h3>No posts found yet.</h3></div>';
            }
            ?>
        </div>
    </div>

    <footer class="mt-5 py-4 border-top text-center text-muted">
        <p><small>&copy; <?php echo date("Y"); ?> Simple Blog Project</small></p>
    </footer>
</body>
</html>