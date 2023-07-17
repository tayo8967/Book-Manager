<?php
include '../inc/header.php';
include '../config/config.php';
include '../classes/Database.php';
include '../classes/Book.php';

$database = new Database();
$db = $database->connect();
$book = new Book($db);

?>
<title>Bookstore - New Book</title>

<div class="container d-flex flex-column align-items-center">
    <h2>New Book</h2>
    <p class="lead text-center">Add a new book to be listed</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-4 w-75">
        <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter your title">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Enter your author">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" style="height: 250px;" id="description" name="description" placeholder="Enter your description"></textarea>
        </div>
        <div class="mb-3">
            <label for="publish" class="form-label">Published Year</label>
            <input type="date" class="form-control" id="publish" name="publish">
        </div>
        <div class="mb-3">
            <input type="submit" name="submit" value="Submit" class="btn btn-success w-100">
        </div>
        <div class="mb-3">
            <a href="../index.php"><input type="button" name="cancel" value="Cancel" class="btn btn-danger w-100"></a>
        </div>
    </form>
</div>

<?php include '../inc/footer.php' ?>