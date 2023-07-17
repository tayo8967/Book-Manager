<?php
    include '../inc/header.php';
    include '../config/config.php';
    include '../classes/Database.php';
    include '../classes/Book.php';

    $database = new Database();
    $db = $database->connect();
    $book = new Book($db);

    $titlePage = 'Remove Book';
    $descPage = 'Are you sure you want to remove book?';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    if (isset($_POST['submit'])){
        $book->removeBook($id);
    }
?>
<title>Book Manager - <?php echo $titlePage; ?></title>

<div class="container d-flex flex-column align-items-center">
    <h2><?php echo $titlePage; ?></h2>
    <p class="lead text-center"><?php echo $descPage; ?></p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $id); ?>" method="POST">
        <div class="mb-3">
            <input type="submit" name="submit" value="Yes" class="btn btn-primary" style="width: 300px;">
        </div>
        <div class="mb-3">
            <a href="../index.php">
                <input type="button" name="cancel" value="No" class="btn btn-danger" style="width: 300px;">
            </a>
        </div>
    </form>
</div>

<?php include '../inc/footer.php' ?>