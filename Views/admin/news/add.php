<?php include('../../../header.php'); ?>

<div class="container mt-5">
    <h1>Thêm Tin Tức Mới</h1>
    <form action="/admin/news/add" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Tiêu Đề:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="category">Danh Mục:</label>
            <select class="form-control" id="category" name="category" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="content">Nội Dung:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Hình Ảnh:</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Tin Tức</button>
    </form>
</div>

<?php include('../../../footer.php'); ?>