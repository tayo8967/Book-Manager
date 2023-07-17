<?php
    include '../inc/header.php';
    include '../config/config.php';
    include '../classes/Database.php';
    include '../classes/Book.php';

    $database = new Database();
    $db = $database->connect();
    $book = new Book($db);

    $titlePage = 'New Book';
    $descPage = 'Add a new book to be listed';
    $id = $title = $author = $description = $publish = '';
    $titleErr = $authorErr = $descriptionErr = $publishErr = '';

    // Get specific book to edit
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $bookDb = $book->getSpecificBook($id);
        $bookData = $bookDb->fetch(PDO::FETCH_ASSOC);
        $titlePage = 'Edit Book';
        $descPage = 'Edit book in the list';

        // Assign retrieved data to variables
        $title = $bookData['Title'];
        $author = $bookData['Author'];
        $description = $bookData['Description'];
        $publish = $bookData['Published_Year'];
    }

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
            if (isset($_GET['id'])){
                // Update to database
                $book->updateBook($id, $title, $author, $description, $publish);
            }
            else{
                // Add to database
                $book->addBook($title, $author, $description, $publish);
            }
        }
    }
?>
<title>Book Manager - <?php echo $titlePage; ?></title>

<div class="container d-flex flex-column align-items-center">
    <h2><?php echo $titlePage; ?></h2>
    <p class="lead text-center"><?php echo $descPage; ?></p>
    <form action="<?php echo $id ? htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $id) : htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-4 w-75">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control <?php echo $titleErr ? 'is-invalid' : null; ?>" id="title" name="title" placeholder="Enter your title" value="<?php echo $title ? $title : null; ?>">
            <div class="invalid-feedback">
                <?php echo $titleErr; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control <?php echo $authorErr ? 'is-invalid' : null; ?>" id="author" name="author" placeholder="Enter your author" value="<?php echo $author ? $author : null; ?>">
            <div class="invalid-feedback">
                <?php echo $authorErr; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control <?php echo $descriptionErr ? 'is-invalid' : null; ?>" style="height: 250px;" id="description" name="description" placeholder="Enter your description"><?php echo $description ? $description : null; ?></textarea>
            <div class="invalid-feedback">
                <?php echo $descriptionErr; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="publish" class="form-label">Published Year</label>
            <input type="date" class="form-control <?php echo $publishErr ? 'is-invalid' : null; ?>" id="publish" name="publish" value="<?php echo $publish ? $publish : null; ?>">
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