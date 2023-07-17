<?php
include '../inc/header.php';
include '../config/config.php';
include '../classes/Database.php';
include '../classes/Book.php';

$database = new Database();
$db = $database->connect();
$book = new Book($db);

$title = $author = $description = $publish = '';
$titleErr = $authorErr = $descriptionErr = $publishErr = '';

// Form submit
if (isset($_POST['submit'])){
    // Validate title
    if (empty($_POST['title'])){
        $titleErr = 'Title is required';
    } 
    else {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // Validate author
    if (empty($_POST['author'])){
        $authorErr = "Author is required";
    }
    else{
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // Validate description
    if (empty($_POST['description'])){
        $descriptionErr = "Description is required";
    }
    else{
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // Validate publish
    if (empty($_POST['publish'])){
        $publishErr = "Published Year is required";
    }
    else{
        $publish = filter_input(INPUT_POST, 'publish', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if(empty($titleErr) && empty($authorErr) && empty($descriptionErr) && empty($publishErr)){
        // Add to database
        $book->addBook($title, $author, $description, $publish);
    }
}
?>
<title>Bookstore - New Book</title>

<div class="container d-flex flex-column align-items-center">
    <h2>New Book</h2>
    <p class="lead text-center">Add a new book to be listed</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-4 w-75">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control <?php echo $titleErr ? 'is-invalid' : null; ?>" id="title" name="title" placeholder="Enter your title">
            <div class="invalid-feedback">
                <?php echo $titleErr; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control <?php echo $authorErr ? 'is-invalid' : null; ?>" id="author" name="author" placeholder="Enter your author">
            <div class="invalid-feedback">
                <?php echo $authorErr; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control <?php echo $descriptionErr ? 'is-invalid' : null; ?>" style="height: 250px;" id="description" name="description" placeholder="Enter your description"></textarea>
            <div class="invalid-feedback">
                <?php echo $descriptionErr; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="publish" class="form-label">Published Year</label>
            <input type="date" class="form-control <?php echo $publishErr ? 'is-invalid' : null; ?>" id="publish" name="publish">
            <div class="invalid-feedback">
                <?php echo $publishErr; ?>
            </div>
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