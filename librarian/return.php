<?php
include "connection.php";
$id=$_GET["id"];
$a=date("D-M-Y");
mysqli_query($link, "update issue_books set book_return_date='$a' where id=$id");


$book_name="";
$result=mysqli_query($link, "select * from issue_books where id=$id");
while($row=mysqli_fetch_array($result)){
    $book_name=$_POST["book_name"];
}
mysqli_query($link, "update add_books set available_books=available_books+1  where book_name='$book_name'");
?>

<script type="text/javascript" >
    window.location="return_books.php";
</script>
