<?php
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table , tr, td, th{
            border: 1px solid black;
            border-collapse: collapse;

        }
        table{
            width: 30%;
            padding:4px;
            text-align: center;
        }
    </style>
</head>
<body>

<form action="index.php" method="post">

 Email: <input type="email" name="email" value="j@j.j"><br>
 Name: <input type="text" name="name"><br>
 Sex: <select name="sex[]" id="">
        <option value="M">Male</option>
        <option value="F">Female</option>
    </select><br>
 <input type="submit" value="Register" name="register">
</form>

<br><br>
<hr>

    <?php
    try{
     if(isset($_POST['register'])){

        $email = $_POST['email'];
        $name = $_POST['name'];
        $sex ="" ;

        foreach( $_POST['sex'] as $s){
            $sex = $s;
        }
        $query = "INSERT INTO log_info (email,name,sex) VALUES ('$email','$name','$sex')";
        $conn->query($query);
    }

    if(isset($_POST['register']) || isset($_POST['delete']) || isset($_POST['update'])){

        if(isset($_POST['delete']) && isset($_POST['check'])){
            $check = $_POST['check'];
            foreach($_POST['check'] as $c){
                $query2 = "DELETE FROM log_info WHERE email = '$c'";
                $sql1 = mysqli_query($conn, $query2);
            }
         }

         if(isset($_POST['update'])){
            $uemail = $_POST['email'];
            $uname = $_POST['name'];
            $usex = "";
            foreach($_POST['sex'] as $s){
               $usex = $s;
            }
            $query = "UPDATE log_info SET name = '$uname', sex = '$usex' WHERE email = '$uemail'";
            $sql4 = mysqli_query($conn, $query);
         }



        $query1 = "SELECT * FROM log_info";
        $sql = mysqli_query($conn, $query1);
        

        


        echo "<form action='index.php' method='post'>";
       echo" <table>
       <tr>
            <th>checkbox</th>
            <th>Email</th>
            <th>Name</th>
            <th>M</th>
            <th>Date</th>
        </tr>";
        if($sql->num_rows > 0){
            while($data = mysqli_fetch_assoc($sql)){

                echo"

                <tr>
                    <td><input type='checkbox' name='check[]' value=".$data['email']."></td>
                    <td><a href='index.php?email=".$data['email']."'>".$data['email']."</a></td>
                    <td>".$data['name']."</td>
                    <td>".$data['sex']."</td>
                    <td>".$data['date']."</td>
                </tr>
                ";
            }
        }
        echo" <table>";
        
        echo "<input type='submit' value='Delete' name='delete'>";
        echo "</form>";
     }
    }catch(Exception ){
        echo"<script>alert(\"Error\");</script>";
    }
     
   if(isset($_GET['email'])){

    $email= $_GET['email'];

    $query = "SELECT * FROM log_info WHERE email = '$email'";
    $sql = mysqli_query($conn, $query);
    
    while($result = mysqli_fetch_assoc($sql)){
    echo "<form action=\"index.php\" method=\"post\">";

    echo "Email: <input type=\"email\" name=\"email\" value=".$result['email']." readonly><br>";
    echo "Name: <input type=\"text\" name=\"name\"  value=".$result['name']."><br>";
    echo" Sex: <select name=\"sex[]\">";
    if($result['sex'] == 'M'){
        echo " <option value=\"M\" selected>Male</option>";
        echo " <option value=\"F\">Female</option>";
    }else{
        echo " <option value=\"M\" >Male</option>";
        echo " <option value=\"F\" selected>Female</option>";
    }
  echo"
       </select><br>
       ";
   echo" <input type=\"submit\" value=\"Register\" name=\"update\">";
   echo"</form>";
    }


   }



    ?>



   



</body>
</html>