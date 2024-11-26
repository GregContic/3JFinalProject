<?php
    include "db.php";

    if (isset($_GET['id'])){
        $id =$_GET['id'];

        $sql= "DELETE FROM units WHERE id=$id";
        if ($conn->query($sql)=== TRUE){
            echo "REMOVED!";
        }else{
            echo "FAILED";
        }
    }
    header("Location: index.php");
?>