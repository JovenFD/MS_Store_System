<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Ms Store</title>
    <?php include('header.php');?>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php $settings='active'; include('sidebar.php');?>
        <div class="container-fluid pt-3">
           <div class="card">
               <div class="card-header">
                    Manage Settings
               </div>
               <div class="card-body">
                   <form action="route.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <center><img src="./uploads/<?php echo $settingObj->getLogo()['path'];?>" id="avatarProduct" alt="avatar" width="130" height="130" style="border-radius: 50%;">
                        </center>
                        <input class="form-control" id="fileChooser" type="file" name="file" accept="image/png, image/jpeg" style="margin-top: 8px;">
                        <script>
                            fileChooser.onchange = (e) => {
                                if (e.target.files && e.target.files[0]) {
                                    document.querySelector('#avatarProduct').src = URL.createObjectURL(event.target.files[0]);
                                }
                            }
                        </script>
                    </div>
               </div>
               <div class="card-footer">
                   <input type="hidden" name="updateLogo" value="<?php echo $settingObj->getLogo()['logo_id']?>">
                   <center><button class="btn btn-primary">Submit</button></center>
                   </form>
               </div>
           </div>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>