<?php include('includes/header.php'); ?>
<h1 class="text-center mb-4">📚 Library Management System</h1>

<div class="row text-center">
    <div class="col-md-3 mb-3">
        <a href="pages/books/index.php" class="btn btn-outline-primary w-100 p-3">
            📘 Manage Books
        </a>
    </div>
    <div class="col-md-3 mb-3">
        <a href="pages/members/index.php" class="btn btn-outline-success w-100 p-3">
            👤 Manage Members
        </a>
    </div>
    <div class="col-md-3 mb-3">
        <a href="pages/borrow/list.php" class="btn btn-outline-warning w-100 p-3">
            📦 Borrow / Return
        </a>
    </div>
    <div class="col-md-3 mb-3">
        <a href="pages/fines/list.php" class="btn btn-outline-danger w-100 p-3">
            💸 View Fines
        </a>
    </div>
</div>
<?php include('includes/footer.php'); ?>
