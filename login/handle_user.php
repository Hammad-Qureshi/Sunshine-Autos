<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['submit'])) 
{

    if (!empty($_POST['cust']) && !empty($_POST['car']) && !empty($_POST['date']) && !empty($_POST['status'])) 
    {
        $cust = $_POST['cust'];
        $car = $_POST['car'];
        $date = date('Y-m-d', strtotime($_POST['date']));
        $status = $_POST['status'];
        $payment = $_POST['payment_status'];

        $query = "SELECT `comission` FROM `salesman` WHERE id='".$_SESSION['id']."'";
        $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));
        $row = mysqli_fetch_row($run);

        $old_comission = intval($row[0]);

        $query = "SELECT `price` FROM `cars` WHERE car_id='$car'";
        $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));
        $row = mysqli_fetch_row($run);
        
        $car_price = $row[0];

        $comission = $old_comission + intval($row[0])*0.01;

        $query = "INSERT INTO order_details(cust_id, car_id, order_status, delivery_date, payment_status) 
        VALUES ('$cust','$car','$status','$date', '$payment')";
        $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));

        $query2 = "UPDATE `salesman` SET `comission`='$comission' WHERE id='".$_SESSION['id']."'";
        $run = mysqli_query($conn,$query2) or die(mysqli_error($myDB));

        $query = "SELECT order_id, payment_status FROM order_details ORDER BY order_id DESC LIMIT 1";
        $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));
        $row = mysqli_fetch_row($run);

        $query3 = "INSERT INTO `payment`(`order_id`, `payment_status`, `amount`) VALUES ('$row[0]','$row[1]','$car_price')";
        $run = mysqli_query($conn,$query3) or die(mysqli_error($myDB));

        if($run)
        {
            echo "Order Created Successfully!";
        }
        else
        {
            echo "Order Creation Failed! :(";
        }
    }
    else
    {
        echo "All fields are required!";
    }
}

if (isset($_POST['update'])) 
{

    if (!empty($_POST['id']) && !empty($_POST['cust']) && !empty($_POST['car']) && !empty($_POST['date']) && !empty($_POST['status']) && !empty($_POST['payment_status'])) 
    {
        $id = $_POST['id'];
        $cust = $_POST['cust'];
        $car = $_POST['car'];
        $date = date('Y-m-d', strtotime($_POST['date']));
        $status = $_POST['status'];
        $payment = $_POST['payment_status'];

        $query = "UPDATE order_details SET cust_id = '$cust', car_id = '$car', order_status = '$status', delivery_date = '$date', payment_status = '$payment' WHERE order_id = $id";
        $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));

        $query2 = "UPDATE `payment` SET `payment_status`='$payment' WHERE order_id = $id";
        $run = mysqli_query($conn,$query2) or die(mysqli_error($myDB));

        if($run)
        {
            echo "Customer Updated Successfully!";
        }
        else
        {
            echo "Updating Failed! :(";
        }
    }
    else
    {
        echo "All fields are required!";
    }
}

if (isset($_POST['register'])) 
{

    if (!empty($_POST['name']) && !empty($_POST['cnic']) && !empty($_POST['phone'])) 
    {
        $name = $_POST['name'];
        $cnic = $_POST['cnic'];
        $phone = $_POST['phone'];

        $query = "INSERT INTO customers(cust_name, cust_cnic, cust_phone) 
        VALUES ('$name','$cnic','$phone')";

        $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));

        if($run)
        {
            echo "Customer Registered Successfully!";
        }
        else
        {
            echo "Registration Failed! :(";
        }
    }
    else
    {
        echo "All fields are required!";
    }
}

if (isset($_POST['delete'])) 
{

    if (!empty($_POST['ID'])) 
    {
        $id = $_POST['ID'];

        $query = "DELETE FROM order_details WHERE order_id = $id";

        $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));

        if($run)
        {
            echo "Order Deleted Successfully!";
        }
        else
        {
            echo "Deletion Failed! :(";
        }
    }
    else
    {
        echo "All fields are required!";
    }
}

sleep(1);
header("Location: admin-panel.php");
?>