<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount_sent = $_POST['amount_sent'];

    $sql = "SELECT * FROM account_details where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * FROM account_details where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    if (($amount_sent)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  
        echo '</script>';
    }
    else if($amount_sent > $sql1['account_Balance']) 
    {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")'; 
        echo '</script>';
    }
    else if($amount_sent == 0){

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
     }
    else {
        // deducting amount from sender's account
        $newbalance = $sql1['account_Balance'] - $amount_sent;
        $sql = "UPDATE account_details set account_Balance=$newbalance where id=$from";
        mysqli_query($conn,$sql);
        // adding amount to reciever's account
        $newbalance = $sql2['account_Balance'] + $amount_sent;
        $sql = "UPDATE account_details set account_Balance=$newbalance where id=$to";
        mysqli_query($conn,$sql);

        $money_sender = $sql1['id'];
        $money_receiver = $sql2['id'];
        $sql = "INSERT INTO account_transaction(`sender_id`, `receiver_id`, `amount_sent`) VALUES ('$money_sender','$money_receiver','$amount_sent')";
        $query=mysqli_query($conn,$sql);
        if($query){
            echo "<script> alert('Transaction is Successful');window.location='transactions.php';</script>";
        }
        $newbalance= 0;
        $amount_sent =0;
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Money Transfer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="message.css">

    <style type="text/css">
		button{
			border:none;
			background: #d9d9d9;
		}
	    button:hover{
			background-color:#777E8B;
			transform: scale(1.1);
			color:white;
		}

    </style>
</head>

<body style="background-color : #949fb5; background-image:url(images/fundToSafe.jpg); background-size:cover;">
    <!-- Navigation bar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="selectedusers.php">Transfer Money</a>
                </li>
            </ul>
            <a class="navbar-brand" href="index.html";><h1 style="padding-left:450px;">S-G Bank</h1></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="customers.php">Customers</a>
                    </li>
                </ul>  
            </div>
        </div>
    </nav>
    <div class="scroll-left text-light" style="background: transparent; margin-top: 10px;">
        <h1 style="opacity:0.3; width:100%;"><b>Welcome to S-G Bank....You Transaction is Secured</b></h1>
    </div>
	<div class="container">
        <h2 class="text-center pt-4" style="color : white;">Money Transfer</h2>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  account_details where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table" style="background:transparent;">
                <tr style="color : white;">
                    <th scope="col" class="text-center py-2">S/N</th>
                    <th scope="col" class="text-center py-2">Account Name</th>
                    <th scope="col" class="text-center py-2">Account Number</th>
                    <th scope="col" class="text-center py-2">Account Balance (₦)</th>
                    <th scope="col" class="text-center py-2">E-Mail</th>
                    <th scope="col" class="text-center py-2">Phone</th>
                    <th scope="col" class="text-center py-2">Type</th>
                </tr>
                <tr class="text-center" style="color : white;">
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['account_Name']?></td>
                    <td class="py-2"><?php echo $rows['account_Number']?></td>
                    <td class="py-2"><?php echo $rows['account_Balance']?></td>
                    <td class="py-2"><?php echo $rows['email']?></td>
                    <td class="py-2"><?php echo $rows['phone']?></td>
                    <td class="py-2"><?php echo $rows['type']?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label style="color : white;"><b>Transfer To:</b></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose account</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM account_details where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >

                    <?php echo $rows['account_Name'] ;?> (Available Balance: 
                    <?php echo $rows['account_Balance'] ;?> ) 

                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label style="color : white;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount_sent" required placeholder="minimum of ₦1.00">   
            <br><br>
                <div class="text-center" >
            <button class="btn mt-3 bg-primary" name="submit" type="submit" id="myBtn" >Send Fund</button>
            </div>
        </form>
    </div>

    <footer class="text-center mt-5 py-2" style="position:relative;bottom:0;width:100%;">
            <p>&copy 2021 <b>Segun Emmanuel</b> <br>S-G Bank</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>