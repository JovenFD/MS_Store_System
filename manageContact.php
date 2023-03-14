<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact | Angie Store System</title>
    <?php include('header.php');?>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php $contact='active'; include('sidebar.php');?>
        <div class="container-fluid pt-3">
            <div class="card">
                <div class="card-header">
                    MANAGE CONTACT
                </div>
                <div class="card-body">
                    <form action="route.php" method="post">
                    <label>Telephone #</label>
                    <input type="text" name="telephone" value="<?php echo $contactObj->getContact()['telephone']?>" class="form-control">
                    <label>Phone #</label>
                    <input type="text" name="phone" value="<?php echo $contactObj->getContact()['phoneNum']?>" class="form-control">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $contactObj->getContact()['email']?>" class="form-control">
                    <label>Address</label>
                    <input type="text" name="address" value="<?php echo $contactObj->getContact()['address']?>" class="form-control">
                </div>
                <div class="card-footer">
                    <input type="hidden" name="updateContact" value="updateContact">
                    <input type="hidden" name="id" name="id" value="<?php echo $contactObj->getContact()['contact_id']?>">
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