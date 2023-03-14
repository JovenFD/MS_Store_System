<?php include('route.php');?>
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">
    <center><a href="."><img style="border-radius: 50%;margin: auto;" src="./uploads/<?php echo $settingObj->getLogo()['path'];?>" alt="LOGO" width="50" height="50" class="d-inline-block align-text-top">
    <br><span style="color: #9e9e9e;font-size: 20px">MS STORE</span></a>
   </center>
    </div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-light p-3" data-bs-toggle="modal" data-bs-target="#changePassModal">
            <center><img src="./uploads/<?php echo $_SESSION['avatar'];?>" alt="avatar" width="130" height="130" style="border-radius: 50%;">
            <p><span style="font-size: 25px;"><?php echo ucwords($_SESSION['name']);?></span><br><span class="text-muted" style="font-size: 14px;">System Administrator</span></p>
            </center>
        </a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo $home;?>" href="administrator"><i class="fa-solid fa-gauge px-2"></i>Dashboard</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo $sales;?>" href="sale.php"><i class="fa-solid fa-cart-shopping px-2"></i>Sales</a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo $category; ?>" href="category.php" ><i class="fa-solid fa-list-check px-2"></i>Category List</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo $product;?>" href="product.php" ><i class="fa-brands fa-product-hunt px-2"></i>Products List</a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo $history;?>" href="history.php"><i class="fa-solid fa-pie-chart px-2"></i>Sales Report</a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo $settings;?>" href="settings.php"><i class="fa-solid fa-gear px-2"></i>System Settings</a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="settings.php"></a>
    </div>
</div>
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" style="height:80px;">
        <div class="container-fluid">
            <button class="btn btn-secondary" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown py-3" style="padding: 10px;">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-user px-2"></i><?php echo ucwords($_SESSION['name']);?></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="padding: 10px;">
                            <a class="dropdown-item py-2" data-bs-toggle="modal" data-bs-target="#changePassModal"><span><img src="./uploads/<?php echo $_SESSION['avatar'];?>" width="20px" height="20px" style="border-radius: 50%;margin-right: 5px;"></span>Update Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item py-2" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket px-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>