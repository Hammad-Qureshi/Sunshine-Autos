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
        $payment = $_POST['payment'];

        $query = "INSERT INTO order_details(cust_id, car_id, order_status, delivery_date, payment) 
        VALUES ('$cust','$car','$status','$date', '$payment')";

        $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));

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

    if (!empty($_POST['id']) && !empty($_POST['cust']) && !empty($_POST['car']) && !empty($_POST['date']) && !empty($_POST['status']) && !empty($_POST['payment'])) 
    {
        $id = $_POST['id'];
        $cust = $_POST['cust'];
        $car = $_POST['car'];
        $date = date('Y-m-d', strtotime($_POST['date']));
        $status = $_POST['status'];
        $payment = $_POST['payment'];

        $query = "UPDATE order_details SET cust_id = '$cust', car_id = '$car', order_status = '$status', delivery_date = '$date', payment = '$payment' WHERE order_id = $id";

        $run = mysqli_query($conn,$query) or die(mysqli_error($myDB));

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