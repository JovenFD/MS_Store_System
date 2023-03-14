<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category | Ms Store</title>
    <?php include('header.php');?>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php $category='active'; include('sidebar.php');?>
        <div class="container-fluid pt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col mt-2">
                            Category List
                        </div>
                        <div class="col">
                            <button style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">New Category</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow: auto;">
                        <table id="tbl" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Category Id</th>
                                    <th class="text-center">Category Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($catObj->getCategory() as $cat):?>
                                    <tr>
                                        <td><?php echo $cat['cat_id']?></td>
                                        <td><?php echo $cat['category']?></td>
                                        <td><center>
                                            <button class="btn-sm btn btn-outline-danger" onclick="removeCategory('<?php echo $cat['cat_id']?>')"><i class="fa-solid fa-trash-can"></i></button>
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
        include('Modal/categoryModal.php');
    ?>
      <script>
        const removeCategory = (id) => {
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
                    window.location = 'route.php?removeCategory='+id;
                }
            })
        }
    </script>
</body>
</html>