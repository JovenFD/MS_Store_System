<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale | MS Store System</title>
    <?php include('header.php');?>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php $sales='active'; include('sidebar.php');
            $qtyTile   = 0;
            $totalTile = 0;
            $itemList = isset($_SESSION['itemOrder']) ? $_SESSION['itemOrder'] : array();

            foreach ($itemList as $compute) {
                $qtyTile  += $compute['qty'];
                $totalTile+= $compute['qty']*$compute['p_price'];
            }
        ?>
        <div class="container-fluid pt-3">
            <div class="row">
                <div class="col-md-4 py-2">
                    <div class="container border rounded p-2" style="overflow-y: scroll; height:400px; background: #ffffff;">
                        <label>Product List</label>
                        <form action="route.php" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search Barcode" name="barcode">
                                <input type="hidden" name="searchbarcode" value="searchbarcode">
                                <button type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                            </div>
                        </form>
                        <div class="row">
                            <?php foreach ($saleObj->showProduct(
                                isset($_GET['cat_id']) ? $_GET['cat_id'] : ''
                            ) as $row):

                            $str= $row['p_name'];
                            $new_str='';

                            if (strlen($str) > 5) {
                                $new_str=substr($str, 0, 5) . '...';
                            }
                            
                            ?>
                                <div class="col-md-6">
                                    <button  type="button" onclick="window.location='route.php?addCart=<?php echo $row['product_id']?>'" class="text-wrap mb-2 mainButton btn btn-outline-secondary" style="width: 100%; height:100px;" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $row['p_name']?>"><?php echo $row['p_name']?><small><b><?php echo $new_str;?></b></small></button>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="route.php" method="post">
                                <label>Amount Pay</label>
                                <input type="number" class="form-control text-center fw-bold mb-2" name="pay" placeholder="0.00" required>
                                <button class="btn btn-secondary" style="width:100%;">Collect Pay</button>
                                <input type="hidden" name="collectPay" value="collectPay" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                <div class="row mb-2">
                    <div class="col py-2">
                        <div class="card">
                            <div class="card-header">
                                Total Qty
                            </div>
                            <div class="card-body text-center">
                                <h2><?php echo $qtyTile;?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col py-2">
                        <div class="card">
                            <div class="card-header">
                                Total Amount
                            </div>
                            <div class="card-body text-center">
                                <h2><?php echo $totalTile;?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col py-2">
                        <div class="card">
                            <div class="card-header">
                                Total Change
                            </div>
                            <div class="card-body text-center">
                                <h2><?php echo isset($_SESSION['change']) ? $_SESSION['change'] : 0;?></h2>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="rouded mb-4" style="overflow: auto;">
                        <table class="table table-bordered text-black bg-light" style="width: 100%; ">
                            <thead>
                                <tr>
                                    <th colspan="5" class="text-center">Ordered List</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a=0; $b=0; foreach ($itemList as $key => $itemList):?>
                                    <tr>
                                        <td class="text-center"><?php echo $itemList['p_name']?></td>
                                        <td class="text-center" style="width: 20%;">
                                            <input type="hidden" id="qtyIndex<?php echo $b;?>" value="<?php echo $key;?>" />
                                            <input type="number" id="qtyVal<?php echo $a;?>" onkeypress="inputQty<?php echo $a;?>(event)" value="<?php echo $itemList['qty']?>" class="form-control text-center">

                                            <script>
                                                const inputQty<?php echo $a;?>=(e) => {
                                                    if (e.keyCode == 13) {
                                                        window.location = 'route.php?updateCartQty='+$('#qtyVal<?php echo $a;?>').val()+'&indexSession='+$('#qtyIndex<?php echo $b;?>').val();
                                                    }
                                                }
                                            </script>
                                        </td>
                                        <td class="text-center"><?php echo $itemList['p_price']?></td>
                                        <td class="text-center"><?php echo ($itemList['qty'] *$itemList['p_price']);?></td>
                                        <td><center><button class="btn-sm btn btn-outline-danger" onclick="removeCart('<?php echo $key;?>')"><i class="fa-solid fa-circle-minus"></i></button></center></td>
                                    </tr>
                                <?php $a++; $b++; endforeach;
                                    if (count($itemList) == 0) {
                                        echo '
                                        <tr>    
                                            <td colspan="5" class="text-center">Data Not Found...</td>
                                        </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                     <button class="btn btn-danger btn-sm" style="float:right;" onclick="removeAll()">RemoveAll</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
      <script>
        const removeCart = (id) => {
            Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Remove'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'route.php?removeCart='+id;
                }
            })
        }

        const removeAll = () => {
            Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove all!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Proceed'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'route.php?removeAll';
                }
            })
        }
    </script>
</body>
</html>