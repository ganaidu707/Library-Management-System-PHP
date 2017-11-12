<?php
session_start();
if(!isset($_SESSION["username"])){
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
                        <h2>search Books</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form name="form1" action="", method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <input type="text" name="t1" placeholder="enter book name" class="form-control" required="">
                                    </td>
                                    <td>
                                        <input type="submit" name="submit" value="Search Books" class="form-control btn btn-default">
                                    </td>
                                </tr>

                            </table>
                        </form>

                        <?php
                        if(isset($_POST['submit'])){
                            $result=mysqli_query($link, "select * from add_books where book_name like('%$_POST[t1]%')");
                            echo "<table class='table table-bordered'>";
                            echo "<tr>";
                            while($row=mysqli_fetch_array($result)){
                                echo "<td>";
                                ?><img src="../librarian/<?php echo $row["books_image"]; ?>" height="100" width="100"><?php
                                echo "<br>";
                                echo "<b>"."Book name: ".$row["book_name"]."</b>";
                                echo "<br>";
                                echo "<b>"."available: ".$row["available_books"]."</b>";
                                echo "</td>";


                            }
                            echo "</tr>";
                            echo "</table>";

                        }
                        else{
                            $result=mysqli_query($link, "select * from add_books");
                            echo "<table class='table table-bordered'>";
                            echo "<tr>";
                            while($row=mysqli_fetch_array($result)){
                                echo "<td>";
                                ?><img src="../librarian/<?php echo $row["books_image"]; ?>" height="100" width="100"><?php
                                echo "<br>";
                                echo "<b>"."Book name: ".$row["book_name"]."</b>";
                                echo "<br>";
                                echo "<b>"."available: ".$row["available_books"]."</b>";
                                echo "</td>";


                            }
                            echo "</tr>";
                            echo "</table>";

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



