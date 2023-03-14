<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report | Ms Store</title>
    <?php include('header.php');?>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php $history='active'; include('sidebar.php');?>
        <div class="container-fluid pt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col mt-2">
                            INVENTORY REPORTS
                        </div>
                        <div class="col">
                            <form action="printReport.php" method="post">
                            <input type="date" name="dateFrm" value="<?php echo date('Y-m-d');?>" class="form-control" />
                        </div>
                        <div class="col">
                            <input type="date" name="dateTo" value="<?php echo date('Y-m-d');?>" class="form-control" />
                        </div>
                        <div class="col">
                            <button type="submit" style="float: right;" class="btn btn-primary"><i class="fa-solid fa-print px-2"></i>Print</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow: auto;">
                        <table id="tbl" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($logObj->getSalesHistory() as $itemLog):?>
                                    <tr>
                                        <td><?php echo $itemLog['qty']?></td>
                                        <td><?php echo $itemLog['price']?></td>
                                        <td><?php echo ($itemLog['qty'] * $itemLog['price'])?></td>
                                        <td><?php echo $itemLog['create_date']?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    </script>
</body>
</html>