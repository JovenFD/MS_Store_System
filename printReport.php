<?php include('route.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link href="./css/css.css" rel="stylesheet" />
    <link href="css/styles.css" rel="s
    tylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <style>
        body {
            font-family: "Trirong", serif;
        }
    </style>
    <?php
        $bg=false; 
        $logObj    = new History();
    ?>
    <title>Print Reports</title>
</head> 
<body>
    <?php 
       $hisTotal = 0;
       $hisQty   = 0;
       $loghistoryPrint =  $logObj->generateReports(
            isset($_POST['dateFrm']) ? $_POST['dateFrm'] : '',
            isset($_POST['dateTo'])  ? $_POST['dateTo'] : ''
        );
    ?>

    <div class="container-fluid">
        <table class="table table-striped">
            <tr>
                <th colspan="1"> 
                    <img style="border-radius: 50%;" src="./uploads/<?php echo $settingObj->getLogo()['path'];?>" alt="LOGO" width="50" height="50" class="d-inline-block align-text-top">
                </th>
                <th colspan="4">
                    <p class="mt-3">MS STORE SYSTEM</p>
                </th>
            </tr>
            <tr>
                <th colspan="5">
                    <div class="row">
                        <div class="col">
                            Printed By: <?php echo ucwords($_SESSION['name']);?>
                        </div>
                        <div class="col" style="text-align: right;">
                            <b ><?php echo date("Y-m-d");?></b>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Price</th>
                <th class="text-center">Subtotal</th>
                <th class="text-center">Date</th>
            </tr>
            <tr>
                <?php foreach ($loghistoryPrint as $key => $his):
                    $hisQty   += $his['qty'];
                    $hisTotal += $his['price'];
                ?>
                    <tr>
                        <td><?php echo $key+1?></td>
                        <td><?php echo $his['qty']?></td>
                        <td><?php echo $his['price']?></td>
                        <td><?php echo ($his['qty']*$his['price']);?></td>
                        <td><?php echo $his['create_date']?></td>
                    </tr>
                <?php endforeach; ?>
            </tr>
            <tfoot>
                <tr>
                    <th colspan="3">Totol Qty</th>
                    <th colspan="2"><?php echo $hisQty;?></th>
                </tr>
                <tr>
                    <th colspan="3">Totol Amount</th>
                    <th colspan="2"><?php echo $hisTotal;?></th>
                </tr>
            </tfoot>
        </table>
    </div>


    <script>
        window.print();

        window.onafterprint = function(){
            window.location="history.php";
        }
    </script>
    <?php include('footer.php'); ?>
</body>
</html>