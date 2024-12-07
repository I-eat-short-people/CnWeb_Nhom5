<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../../style.css">
    
</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Website Tin Tức</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="CnWeb_Nhom5/views/admin/login.php">Đăng nhập Admin</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="GET" action="index.php">
    <input class="form-control me-2" type="search" name="query" placeholder="Tìm kiếm..." aria-label="Search" value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">
    <button class="btn btn-light" type="submit">Tìm</button>
</form>
            </div>
        </div>
    </nav>
