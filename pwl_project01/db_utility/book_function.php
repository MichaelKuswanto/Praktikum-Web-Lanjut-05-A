<?php

function fetchBookFromDb()
{
    $link = createMySQLConnection();
    $query = "SELECT book.cover, book.isbn, book.title, book.author, book.publisher, book.publish_year, book.short_description, genre.name AS 'genre_name' 
            FROM book INNER JOIN genre WHERE book.genre_id = genre.id";
    $stmt = $link->prepare($query);
    $stmt ->execute();
    $result = $stmt->fetchAll();
    $link = null;
    return $result;
}

function addNewBook($isbn, $title, $author, $publisher, $year, $des, $genre)
{
    $result = 0;
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'INSERT INTO book(isbn, title, author, publisher, publish_year, short_description, genre_id ) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$isbn);
    $stmt->bindParam(2,$title);
    $stmt->bindParam(3,$author);
    $stmt->bindParam(4,$publisher);
    $stmt->bindParam(5,$year);
    $stmt->bindParam(6,$des);
    $stmt->bindParam(7,$genre);
    if ($stmt->execute()) {
        $link->commit();
        $result = 1;
    } else {
        $link->rollBack();
    }
    $link = null;
    return $result;
}

function fetchOneBook($isbn) {
    $link = createMySQLConnection();
    $query = 'SELECT cover, isbn, title, author, publisher, publish_year, short_description, genre_id FROM book WHERE isbn = ?';
    $stmt = $link->prepare($query);
    $stmt ->bindParam(1,$isbn);
    $stmt ->execute();
    $result = $stmt->fetch();
    $link = null;
    return $result;
}

function updateBookToDb ($isbn, $newTitle, $newAuthor, $newPublisher, $newYear, $newDes, $newGenre ) {
    $result = 0;
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'UPDATE book SET title = ?, author = ?, publisher = ?, publish_year = ?, short_description = ?, genre_id = ? WHERE  isbn = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$newTitle);
    $stmt->bindParam(2,$newAuthor);
    $stmt->bindParam(3,$newPublisher);
    $stmt->bindParam(4,$newYear);
    $stmt->bindParam(5,$newDes);
    $stmt->bindParam(6,$newGenre);
    $stmt->bindParam(7,$isbn);
    if ($stmt ->execute()) {
        $link->commit();
        $result = 1;
    } else {
        $link->rollBack();
    }
    $link = null;
    return $result;
}

function deleteBookToDb ($isbn) {
    $result = 0;
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'DELETE FROM book WHERE isbn = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$isbn);
    if ($stmt ->execute()) {
        $link->commit();
        $result = 1;
    } else {
        $link->rollBack();
    }
    $link = null;
    return $result;
}

function updateBookCover($isbn, $cover) {
    $result = 0;
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'UPDATE book SET cover = ? WHERE isbn = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$cover);
    $stmt->bindParam(2,$isbn);
    if ($stmt ->execute()) {
        $link->commit();
        $result = 1;
    } else {
        $link->rollBack();
    }
    $link = null;
    return $result;
}