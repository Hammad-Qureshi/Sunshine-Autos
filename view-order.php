<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>View Orders</title>
</head>
<body>
    <!-- <center> -->
        <a href="./index.html">< HOME</a>
        <h1 id="order" class="heading">Search your Booking</h1>
        <form action="" method="POST" name="myForm" onsubmit="return validateForm()" required>
            <input type="text" name="id" placeholder="Enter Order ID"/>
            <input type="submit" name="search" value="Search">
        </form>
    <!-- </center> -->

    <?php
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, 'myDB');

        if (isset($_POST['search'])) {

            ?>

            <hr id="line">

            <?php
            $id = $_POST['id'];
            $i=0;

            $query = "SELECT * FROM order_details where order_id=$id";
            $query_run = mysqli_query($connection,$query);

            if (mysqli_num_rows($query_run) > 0) {
                while($row = mysqli_fetch_array($query_run))
                {
                    ?>
                        <form action="" method="POST">
                        
                            <br><br>
                            <input class="custom" type="text" size="13" id="resultNo" readonly value="Order Details:"><br><br>
                            <input class="custom" type="text" size= "25" name="cust_id" readonly value="Customer ID: <?php echo $row['cust_id'] ?>"><br><br>
                            <input class="custom" type="text" size= "25" name="car_id" readonly value="Car ID: <?php echo $row['car_id'] ?>"><br><br>
                            <input class="custom" type="text" size= "25" name="order_status" readonly value="Status: <?php echo $row['order_status'] ?>"><br><br>
                            <input class="custom" type="text" size= "25" name="delivery_date" readonly value="Delivery Date: <?php echo $row['delivery_date'] ?>"><br><br>
                        </form>
                    <?php
                }
            }
            else
            {
                ?>
                    <h2 id="null">No data found :(</h2>
                <?php
            }
            
        }
    ?>
    <script>
        function validateForm() {
        var x = document.forms["myForm"]["id"].value;
        if (x == "") {
            alert("Please enter Order ID to search.");
            return false;
        }
        }

        function showLine() {
        document.getElementById('line').style.display = "block";
        }
    </script>
</body>
</html>