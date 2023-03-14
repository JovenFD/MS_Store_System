<?php include('route.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT RECIEPT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link href="./css/css.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <style>
        body {
            font-family: "Trirong", serif;
        }
    </style>
    <?php 
        $total=0;
        $qty=0;
    ?>
</head>
<body>
    <div class="container" style="width: 30%;">
        <table class="table table-borderedless">
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
                            Cashier: <?php echo ucwords($_SESSION['name']);?>
                        </div>
                        <div class="col" style="text-align: right;">
                            <b ><?php echo date("Y-m-d");?></b>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($_SESSION['itemOrder'] as $key => $item):
                $total += $item['p_price'];
                $qty   += $item['qty'];
            ?>
                <tr>
                    <td><?php echo $key+1?></td>
                    <td><?php echo $item['p_name']?></td>
                    <td><?php echo $item['qty']?></td>
                    <td><?php  echo  $item['p_price']?></td>
                    <td><?php  echo  ($item['qty']*$item['p_price'])?></td>
                </tr>
            <?php endforeach; ?>
            <tfoot>
                <tr>
                    <th colspan="2">Quantity Due:</th>
                    <th colspan="3"><?php echo $qty; ?></th>
                </tr>
                <tr>
                    <th colspan="2">Amount Due:</th>
                    <th colspan="3"><?php echo $total; ?></th>
                </tr>
                <tr>
                    <th colspan="2">Change:</th>
                    <th colspan="3"><?php echo $_SESSION['change']; ?></th>
                </tr>
                <tr>
                    <th colspan="2">Amount Pay:</th>
                    <th colspan="3"><?php echo $_SESSION['pay']; ?></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        window.print();

        window.onafterprint = function(){
            window.location="sale.php";
        }
    </script>

    <?php include('footer.php');?>
</body>
</html>