<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Admin Panel</title>
     <link rel="stylesheet" href="./admin.css">
</head>
<body>
     <div id="header">
          <h2 class="welcome">Hello, <?php echo $_SESSION['name']; ?></h2>
          <div class="buttons">
               <a href="../index.html">Home</a>
               <a href="logout.php">Logout</a>
          </div>
     </div>
     <br><br>

     <?php
          include('db_conn.php');
          $query = "SELECT `comission` FROM `salesman` WHERE id='".$_SESSION['id']."'";
          $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));
          $row = mysqli_fetch_row($run);
     ?>
     <h3 class="comission">Your Comission: Rs.<?php echo $row[0]; ?>/-</h2>
     <!-- <br><br> -->
     <hr id=divider>

     <!-- Tables -->
     <div class="row">
          <div class="block t1">
               <?php 
                    include('db_conn.php'); 
                    $order_query="select * from order_details"; 
                    $order_result=mysqli_query($conn, $order_query); 
               ?> 
               <table> 
               <tr> 
                    <th colspan="6"><h2 class="elementHeading">Order Details</h2></th> 
               </tr>
                    <tr> 
                         <th> Order ID </th> 
                         <th> Customer ID </th> 
                         <th> Car ID </th>
                         <th> Order Status </th>
                         <th> Delivery Date </th>
                         <th> Payment </th>
                    </tr> 
                    
                    <?php while($rows=mysqli_fetch_assoc($order_result)) 
                    { 
                    ?> 
                    <tr> 
                         <td><?php echo $rows['order_id']; ?></td> 
                         <td><?php echo $rows['cust_id']; ?></td> 
                         <td><?php echo $rows['car_id']; ?></td> 
                         <td><?php echo $rows['order_status']; ?></td> 
                         <td><?php echo $rows['delivery_date']; ?></td> 
                         <td><?php echo $rows['payment_status']; ?></td> 
                    </tr> 
                    <?php 
                         } 
                    ?> 
               <!-- </tr> -->
               <!-- <br><br><br> -->
               </table>
          </div>

          <div class="block t2">
               <?php 
                    include('db_conn.php'); 
                    $cars_query="select * from cars"; 
                    $cars_result=mysqli_query($conn, $cars_query); 
               ?> 
               <table> 
               <tr> 
                    <th colspan="4"><h2 class="elementHeading">Cars Table</h2></th> 
               </tr>
                    <tr> 
                         <th> ID </th> 
                         <th> Name </th> 
                         <th> Details </th> 
                         <th> Price </th> 
                         <!-- <th> CNIC </th>
                         <th> Phone </th> -->
                    </tr> 
                    
                    <?php while($rows=mysqli_fetch_assoc($cars_result)) 
                    { 
                    ?> 
                    <tr> 
                         <td><?php echo $rows['car_id']; ?></td> 
                         <td><?php echo $rows['car_name']; ?></td> 
                         <td><?php echo $rows['car_details']; ?></td> 
                         <td>Rs.<?php echo $rows['price']; ?>/-</td> 
                    </tr> 
                    <?php 
                         } 
                    ?> 
               <!-- </tr> -->
               <!-- <br><br><br> -->
               </table>
          </div>
     </div>
     
     <hr id=divider>

     <div class="formRow">
          <div class="col f1">
               <h2 class="elementHeading">Create / Update Order</h2>
               <form action="handle_user.php" method="POST">
                    <label for="id">Order ID: (for updating only)</label><br><input size="30" type="number" name="id" autocomplete="off"><br><br>
                    
                    <label for="cust">Customer ID: </label><br><input size="30" type="number" list="cust" name="cust" autocomplete="off"><br><br>

                    <label for="car">Car ID: </label><br><input size="30" type="number" name="car" autocomplete="off"><br><br>

                    <label for="date">Delivery date: </label><br><input size="30" type="date" name="date"><br><br>
                    
                    <label for="status">Status: </label><br><input size="20" list="statuses" name="status"><br><br>
                         <datalist id="statuses">
                              <option value="Pending">
                              <option value="Confirmed">
                              <option value="Cancelled">
                              <option value="Completed">
                         </datalist>
                    
                    <label for="payment">Payment: </label><br><input size="20" list="payments" name="payment_status"><br><br>
                    <datalist id="payments">
                         <option value="Pending">
                         <option value="Paid">
                    </datalist>
                    <hr id="form">


                    <button class="button" type="submit" name="submit">Create</button>
                    <button class="button" type="submit" name="update">Update</button>
               </form>
          </div>

          <div class="col f2">
          <h2 class="elementHeading">Customer Registration</h2>
               <form action="handle_user.php" method="POST">
                    
                    <label for="name">Customer Name: </label><br><input size="20" type="text" name="name" autocomplete="off"><br><br>

                    <label for="cnic">Enter CNIC: </label><br><input size="30" type="number" name="cnic" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13" autocomplete="off"><br><br>

                    <label for="phone">Enter Phone #: </label><br><input size="30" type="number" name="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" autocomplete="off"><br><br>
                    
                    <hr id="form">

                    <button class="button reg" type="submit" name="register">Register</button>
               </form>
          </div>

          <div class="col f3">
               <h2 class="elementHeading">Delete Order</h2>
               <form action="handle_user.php" method="POST">
                    
                    <label for="name">Enter Order ID:  </label><input size="10" type="number" name="ID" autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2">

                    <button class="button del" type="submit" name="delete">Delete</button>
               </form>

               <hr id="rowDiv">

               <h2 class="elementHeading">Search Customer</h2>
               <form action="" method="POST" name="myForm" onsubmit="return validateForm()" required>
                    
                    <label for="name">Enter Customer CNIC:  </label><input size="10" type="number" name="cnic" autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13">

                    <button class="button del" type="submit" name="search">Search</button>
               </form>
               <?php
                    $connection = mysqli_connect("localhost", "root", "");
                    $db = mysqli_select_db($connection, 'myDB');

                    if (isset($_POST['search'])) 
                    {
                         ?>

                         <hr id="line">

                         <?php

                         $cnic = $_POST['cnic'];

                         $query = "SELECT * FROM customers where cust_cnic=$cnic";
                         $query_run = mysqli_query($connection,$query);

                         if (mysqli_num_rows($query_run) > 0) {
                              while($row = mysqli_fetch_array($query_run))
                              {
                                   ?>
                                   <form action="" method="POST">
                                        <input id="out" type="text" size= "25" name="id" readonly value="ID: <?php echo $row['cust_id'] ?>"><br>
                                        <input id="out" type="text" size= "25" name="name" readonly value="Name: <?php echo $row['cust_name'] ?>"><br>
                                        <input id="out" type="text" size= "25" name="phone" readonly value="Phone # <?php echo $row['cust_phone'] ?>"><br>
                                   </form>
                                   <?php
                              }
                         }
                         else
                         {
                              ?>
                                   <h2 id="null">No customer found :(</h2>
                              <?php
                         }  
                    }
               ?>
          </div>
     </div>
</body>
</html>
<script>
     function validateForm() {
     var x = document.forms["myForm"]["cnic"].value;
     if (x == "") {
          alert("Please enter CNIC to search.");
          return false;
     }
     }

     function showLine() {
     document.getElementById('line').style.display = "block";
     }
</script>

<?php 
}
// else{
//      header("Location: index.php");
//      exit();
// }
?>