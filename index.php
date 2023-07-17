<?php
include 'inc/header.php';
include 'config/config.php';
include 'classes/Database.php';
include 'classes/Book.php';

$database = new Database();
$db = $database->connect();
$book = new Book($db);


// Get all books
$books = $book->getAllBooks();
?>

<title>Bookstore - Book List</title>

<div style="display: flex; align-items: center;">
    <h1 style="margin-right: 10px;">Book List</h1>
    <a href="views/add_book_form.php">
        <button class="btn btn-success">
            <i class="bi bi-book-fill"></i>
            New Book
        </button>
    </a>
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered algin-middle">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Author</th>
            <th>Published Year</th>
        </tr>
        <?php while ($row = $books->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['Title']; ?></td>
                <td><?php echo $row['Description']; ?>
                <td><?php echo $row['Author']; ?></td>
                <td><?php echo $row['Published_Year']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include 'inc/footer.php' ?>