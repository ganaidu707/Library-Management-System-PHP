<?php
session_start();
if(!isset($_SESSION["librarian"])){
    ?>
    <script type="text/javascript">
        window.location="login.php";

    </script>
    <?php
}

include "connection.php";
include "header.php";
?>
<!-- page content area main -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Plain Page</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row" style="min-height:500px">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Issue Books</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form name="form1" action="" method="post">
                            <table>
                                <tr>
                                    <td>
                                        <select name="enr" class="form-control selectpicker">
                                            <?php
                                            $result=mysqli_query($link, "select regd from student_reg");
                                            while($row=mysqli_fetch_array($result)){
                                                echo "<option>";
                                                echo $row["regd"];
                                                echo "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" name="submit1" value="Search" class="form-control btn btn-default"
                                               style="margin-top: 5px ">
                                    </td>
                                </tr>
                            </table>


                        <?php
                        if(isset($_POST["submit1"])){

                            $res5=mysqli_query($link, "select * from student_reg where regd='$_POST[enr]'");
                            while($row5=mysqli_fetch_array($res5)){
                                $firstname=$row5["firstname"];
                                $lastname=$row5["lastname"];
                                $username=$row5["username"];
                                $email=$row5["email"];
                                $contact=$row5["contact"];
                                $year=$row5["year"];
                                $sem=$row5["sem"];
                                $regd=$row5["regd"];
                                $_SESSION["regd"]=$regd;
                                $_SESSION["username"]=$username;
                            }

                            ?>
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Regd Id" name="regd" value="<?php echo $regd; ?>"
                                               disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="student name" name="studentname"
                                               value="<?php echo $firstname.' '.$lastname; ?>" required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="year" name="studentyear"
                                               value="<?php echo $year; ?>"required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="semister" name="studentsem"
                                               value="<?php echo $sem; ?>"required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="student contact" name="studentcontact"
                                               value="<?php echo $contact; ?>"required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="student email" name="studentemail"
                                               value="<?php echo $email; ?>"required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="bookname" class="form-control selectpicker">
                                            <?php
                                            $result=mysqli_query($link, "select book_name from add_books");
                                            while($row=mysqli_fetch_array($result)){
                                                echo "<option>";
                                                echo $row["book_name"];
                                                echo "</option>";
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="books issue date" name="booksissuedate"
                                               value="<?php echo date("D-M-Y"); ?>" required="">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="student username" name="studentusername"
                                               value="<?php echo $username; ?>"disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="submit2" value="Book Issue" class="form-control btn btn-default"
                                               style="background-color: #A878AF; color: white">
                                    </td>
                                </tr>
                                </table>

                            <?php
                        }
                        ?>
                        </form>

                        <?php

                        if(isset($_POST["submit2"])) {

                            $qty=0;
                            $result=mysqli_query($link, "select * from add_books where book_name='$_POST[bookname]'");
                            while($row=mysqli_fetch_array($result)){
                                $qty=$row["available_books"];
                            }
                            if($qty==0){
                                ?>
                                <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                    <strong style="color:white">No books available of this type now</strong>
                                </div>
                            <?php

                            }
                            else{
                                mysqli_query($link, "insert into issue_books values('','$_SESSION[regd]','$_POST[studentname]', '$_POST[studentyear]', '$_POST[studentsem]','$_POST[studentcontact]','$_POST[studentemail]','$_POST[bookname]', '$_POST[booksissuedate]','', '$_SESSION[username]')");
                                mysqli_query($link, "update add_books set available_books=available_books-1 where book_name='$POST[bookname]'");
                                ?>
                                <script type="text/javascript">
                                    alert("book issued");
                                    window.location.href=window.location.href;
                                </script>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php
include "footer.php";
?>





