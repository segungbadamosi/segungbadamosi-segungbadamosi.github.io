<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" href="message.css">
</head>

<body style="background-color:#5234eb; background-image:url(images/satisfied.jpg); background-size:cover">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="transactions.php">Transaction History</a>
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
          <h1 style="opacity:0.3; width:100%;"> <b>Welcome to S-G Bank....Fidelity and Transparency are Our Watchword</b></h1>
  </div>

	<div class="container">
      <h2 class="text-center pt-4" style="color : white;">Transaction History</h2><br>
      <div class="table-responsive-sm">
        <table class="table table-hover table-dark">
          <thead style="color : white;">
              <tr>
                  <th class="text-center">S/N</th>
                  <th class="text-center">Sender's Name</th>
                  <th class="text-center">Receiver's Name</th>
                  <th class="text-center">Amount Transferred (₦)</th>
                  <!--<th class="text-center">Date & Time</th> -->
              </tr>
          </thead>
          <tbody>
            <?php

                include 'config.php';
                $count=1;
                $sql ="select * FROM account_details d,account_transaction t where d.id=t.sender_id;";
                $query =mysqli_query($conn, $sql);
                while($rows = mysqli_fetch_assoc($query))
                {


            ?>

            <tr class="text-center" style="color : white;">
            <td class="py-2"><?php echo $count;$count=$count+1; ?></td>
            <td class="py-2"><?php echo $rows['account_Name']; ?></td>
            <td class="py-2"><?php 
            $sq ="select account_Name FROM account_details d  where d.id={$rows['receiver_id']};";
            $quer =mysqli_query($conn, $sq);
            $row = mysqli_fetch_assoc($quer);
            echo $row['account_Name']; ?></td>
            <td class="py-2"><?php echo $rows['amount_sent'];?> </td>

            <?php
                }
            ?>
          </tbody>
        </table>
    </div>
  </div>

  <footer class="text-center mt-5 py-5" style="position:relative;bottom:0;width:100%;">
    <p>&copy 2021 <b>Segun Emmanuel</b> <br>S-G Bank</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>