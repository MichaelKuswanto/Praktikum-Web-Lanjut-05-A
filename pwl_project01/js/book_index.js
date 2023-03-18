function editBook (bookIsbn) {
    window.location = "index.php?menu=book_update&bis=" + bookIsbn;
}

function deleteBook(bookIsbn) {
    const confirmation = window.confirm("Are you sure you want to delete this data?")
    if (confirmation) {
        window.location = "index.php?menu=book&cmd=del&bis=" + bookIsbn;
    }
}

function editCover(bookIsbn) {
    window.location = "index.php?menu=cover_update&bis=" + bookIsbn;
}