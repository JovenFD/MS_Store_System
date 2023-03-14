<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Ms Store</title>
    <?php include('header.php');?>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php $product='active'; include('sidebar.php');?>
        <div class="container-fluid pt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col mt-2">
                            Product List
                        </div>
                        <div class="col">
                            <button style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">New Product</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow: auto;">
                        <table id="tbl" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Item Id</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Item Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($proObj->getProduct() as $row):?>
                                    <tr>
                                        <td><?php echo $row['product_id']?></td>
                                        <td><center><img style="border-radius: 50%;" src="./uploads/<?php echo $row['img']?>" width="50" height="50" alt="image"></center></td>
                                        <td><?php echo $row['p_name']?></td>
                                        <td><?php echo $row['p_desc']?></td>
                                        <td><?php echo $row['category']?></td>
                                        <td><?php echo $row['p_price']?></td>
                                        <td><center>
                                            <button class="btn-sm btn btn-outline-danger" onclick="removeProduct('<?php echo $row['product_id']?>')"><i class="fa-solid fa-trash-can"></i></button>
                                        </center></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        include('footer.php');
        include('Modal/productModal.php');
    ?>
      <script>
        const removeProduct = (id) => {
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
                    window.location = 'route.php?removeProduct='+id;
                }
            })
        }
    </script>
</body>
</html>