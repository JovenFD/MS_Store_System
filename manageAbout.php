<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage About</title>
    <?php include('header.php');?>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php $about='active'; include('sidebar.php');?>
        <div class="container-fluid pt-3">
            <div class="card">
                <div class="card-header">
                    MANAGE ABOUT
                </div>
                <div class="card-body">
                    <form action="route.php" method="post">
                    <label>Title</label>
                    <input type="text" name="title" value="<?php echo $contactObj->getAbout()['title']?>" class="form-control">
                    <label>Description</label>
                    <textarea name="desc" cols="30" rows="5" class="form-control"><?php echo $contactObj->getAbout()['desc']?></textarea>
                </div>
                <div class="card-footer">
                <input type="hidden" name="updateAbout" value="updateAbout">
                <input type="hidden" name="id" value="<?php echo $contactObj->getAbout()['about_id']?>">
                    <center>
                        <button class="btn-sm btn-primary">Submit</button>
                    </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>