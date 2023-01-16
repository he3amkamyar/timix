                    <?php
                    session_start();
                    $conn = mysqli_connect("localhost", "root", "", "shop");
                    $id = $_GET['id'];
                    $sql_new ="UPDATE messages SET count_dislike = count_dislike +1 WHERE id = '$id'";
                    $query_new = mysqli_query($conn,$sql_new);
                    if($query_new)
                    {
                        $i = $_SESSION['proid'];
                        header("Location: post.php?id=$i");
                    }
                    ?>