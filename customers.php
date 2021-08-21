<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Customers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" href="message.css">
    

    <style type="text/css">
      button{
        transition: 1.9s;
      }
      button:hover{
        background-color:green;
        color: white;
      }
    </style>
</head>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="customers.php">Customers</a>
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
          <a class="nav-link active" aria-current="page" href="transactions.php">Transaction History</a>
        </li>   
      </ul>  
    </div>  
  </div>
</nav>

<body style="background-image:url(images/customer.jpg); background-size:cover">
     <section style="padding-top:30px;">
          <div class="scroll-left text-light" style="background: transparent; margin-top: 10px;">
          <h1 style="opacity:0.3; width:100%;"> <b>Welcome to S-G Bank....Your Satisfaction is our concern...Send Money Confidently and Securely</b></h1>
        </div>
<?php
    include 'config.php';
    $sql = "SELECT * FROM `account_details`";
    $result = mysqli_query($conn,$sql);
?>
<div class="container">
  <h2 class="text-center pt-4" style="color : white;">Customers</h2><br>
    <div class="row">
        <div class="col">
            <div class="table-responsive-sm">
              <table class="table table-hover table-sm" style="background: #00467F;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #A5CC82, #00467F);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #A5CC82, #00467F); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
" >
                  <thead style="color : white;">
                      <tr>
                      <th scope="col" class="text-center py-2">S/N</th>
                      <th scope="col" class="text-center py-2">Account Name.</th>
                      <th scope="col" class="text-center py-2">Account Number</th>
                      <th scope="col" class="text-center py-2">Account Balance (₦)</th>
                      <th scope="col" class="text-center py-2">E-Mail</th>
                      <th scope="col" class="text-center py-2">Phone</th>
                      <th scope="col" class="text-center py-2">Type</th>

                      </tr>
                  </thead>
                  <tbody>
                  <?php 
                      while($rows=mysqli_fetch_assoc($result)){
                  ?>
                    <tr class="text-center" style="color : white;">
                        <td class="py-2"><?php echo $rows['id']?></td>
                        <td class="py-2"><?php echo $rows['account_Name']?></td>
                        <td class="py-2"><?php echo $rows['account_Number']?></td>
                        <td class="py-2"><?php echo $rows['account_Balance']?></td>
                        <td class="py-2"><?php echo $rows['email']?></td>
                        <td class="py-2"><?php echo $rows['phone']?></td>
                        <td class="py-2"><?php echo $rows['type']?></td>
                        <td class="py-2" style="padding-left:70px;"><a href="selectedusers.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="btn" style="background-color : #ACB6E5;">Send Fund Now</button></a></td> 
                    </tr>
                    <?php
                        }
                    ?>

                  </tbody>
              </table>
            </div>
        </div>
      </div> 
    </div>

    <footer class="text-center mt-5 py-2 text-light" style="position:relative;bottom:0;width:100%;">
        <p>&copy 2021 <b>Segun Emmanuel</b> <br>S-G Bank</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 

</body>
</html>