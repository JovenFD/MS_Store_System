<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        session_start();
        include('header.php');
        include('Classes/Db.php');
        include('loader.php');
    ?>
</head>
<body>
    <?php
        $loginObj  = new Login();
        $proObj    = new Product();
        $catObj    = new Category();
        $saleObj   = new Sale();
        $logObj    = new History();
        $tileObj   = new Tiles();
        $settingObj= new Settings();

        if(isset($_POST['actionLogin'])
        ) {
            $response = $loginObj->loginForm(
                $_POST
            );

            if($response['status'] == 'success') {

                $_SESSION['user_id'] = $response['message']['user_id'];
                $_SESSION['name']    = $response['message']['f_name'] . " " . $response['message']['l_name'];
                $_SESSION['avatar']  = $response['message']['avatar'];
                $_SESSION['loggedin']= 'loggedin';

                header('Location: admin.php');
                    
            } elseif($response['status'] == 'warning') {
                url(
                    'warning', 
                    $response['message'], 
                    'index.php'
                );
            } else {

                url(
                    'error', 
                    $response['message'], 
                    'index.php'
                );
            }

            die();
        }

        if(isset($_POST['changePassAction'])
        ) {
            if($_POST['newPassword'] != $_POST['cPassword']) {
                url(
                    'warning', 
                    'Password Not Match!.', 
                    'admin.php'
                );
                die();
            }
            $file='';

            if($_FILES['file']['error'] != 4) {
                $file = uploaderFile($_FILES['file']['name']);
            }

            $response = $loginObj->changePassAction(
                $_POST,
                $file
            );

            if($response['status'] == 'success') {
                url(
                    'success', 
                    $response['message'], 
                    'admin.php'
                );
            } else {
                url(
                    'error', 
                    $response['message'], 
                    'admin.php'
                );
            }
            die();
        }

        if(isset($_POST['addProductAction'])
        ) {
            $file = uploaderFile($_FILES['file']['name']);

            $response = $proObj->newProduct(
                $_POST,
                $file
            );

            if($response['status'] == 'success') {
                url(
                    'success', 
                    $response['message'], 
                    'product.php'
                );
            } else {
                url(
                    'error', 
                    $response['message'], 
                    'product.php'
                );
            }
            die();
        }

        if(isset($_POST['updateLogo'])
        ) {
            if(empty($_FILES['file']['name'])
            ) {
                url(
                    'warning', 
                    'Empty Choose File Logo Please Try Again!.', 
                    'settings.php'
                );
                die();
            }
            $file ='';
            
            $file = uploaderFile($_FILES['file']['name']);

            $response = $settingObj->updateLogo(
                $file,
                $_POST['updateLogo']
            );

            if($response['status'] == 'success') {
                ?>
                <script>
                    let timerInterval
                    Swal.fire({
                    html: 'Uploading...<b></b>',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "<?php echo $response['message'];?>",
                            showConfirmButton: false,
                            timer: 2000
                        })
                        setTimeout(() => {
                            window.location='settings.php'
                        }, 2000)
                    }
                    })
                </script>
            <?php
            } else {
                url(
                    'error', 
                    $response['message'], 
                    'settings.php'
                );
            }
            die();
        }

        function uploaderFile($file) {
            $fileUpload ='';
            if(!empty($file)
            ) {
                include('uploader.php');
    
                $fileUpload = upload($_FILES['file'], './uploads/');
    
                if($fileUpload['status'] == 'success') {
                    return $fileUpload['avatar'];
                } else {
                    print_r($fileUpload['message']);
                }
                die();
            }
            return '';
        }

        if(isset($_GET['removeProduct'])
        ) {
            $response = $proObj->removeProduct(
                $_GET['removeProduct']
            );

            if($response['status'] == 'success') {
                url(
                    'success', 
                    $response['message'], 
                    'product.php'
                );
            } else {
                url(
                    'error', 
                    $response['message'], 
                    'product.php'
                );
            }
            die();
        }

        if(isset($_POST['addCategoryAction'])
        ) {
            $response = $catObj->newCategory(
                $_POST
            );

            if($response['status'] == 'success') {
                url(
                    'success', 
                    $response['message'], 
                    'category.php'
                );
            } else {
                url(
                    'error', 
                    $response['message'], 
                    'category.php'
                );
            }
            die();
        }

        if(isset($_GET['removeCategory'])
        ) {
            $response = $catObj->removeCategory(
                $_GET['removeCategory']
            );

            if($response['status'] == 'success') {
                url(
                    'success', 
                    $response['message'], 
                    'category.php'
                );
            } else {
                url(
                    'error', 
                    $response['message'], 
                    'category.php'
                );
            }
            die();
        }

        if(isset($_GET['addCart'])
        ) {
            $response = $saleObj->addItemOrder(
                $_GET['addCart']
            );
            $itemList = isset($_SESSION['itemOrder']) ? $_SESSION['itemOrder'] : array();

            if($response['status'] == 'success') {
                $i=0;
                foreach ($itemList as $item) {
                    if ($item['product_id'] == $response['cart'][0]['product_id']) {
                        $_SESSION['itemOrder'][$i]['qty'] += 1; 

                        header('Location: sale.php');
                        die();
                    }
                    $i++;
                }

                $response['cart'][0]['qty'] = 1;
                $_SESSION['itemOrder'][]=$response['cart'][0];

                url(
                    'success', 
                    $response['message'], 
                    'sale.php'
                );
            } else {
                url(
                    'error', 
                    $response['message'], 
                    'sale.php'
                );
            }
            die();
        }

        if(isset($_GET['removeCart'])
        ) {
            unset($_SESSION['itemOrder'][$_GET['removeCart']]);

            url(
                'success', 
                'Remove Cart Successfully.', 
                'sale.php'
            );
            die();
        }

        if(isset($_GET['updateCartQty'])
        ) {
            $_SESSION['itemOrder'][$_GET['indexSession']]['qty'] = $_GET['updateCartQty'];

            url(
                'success', 
                'Change Qty Successfully.', 
                'sale.php'
            );
            die();
        }

        if(isset($_GET['removeAll'])
        ) {
            unset($_SESSION['itemOrder']);
            unset($_SESSION['change']);

            header('Location: sale.php');
            die();
        }

        if(isset($_POST['collectPay'])
        ) {
            $finalTotal = 0;
            
            foreach($_SESSION['itemOrder'] as $total) {
                
                $finalTotal+=$total['qty']*$total['p_price'];
            }

            if($_POST['pay'] < $finalTotal) {
                url(
                    'warning', 
                    'Insufficient!', 
                    'sale.php'
                );
                die();
            }

            $_SESSION['pay'] = $_POST['pay'];
            $_SESSION['change'] = $_POST['pay']-$finalTotal;

            $response = $saleObj->saveTransaction(
                $_SESSION['itemOrder']
            );

            if($response['status'] == 'success') {
                url(
                    'success', 
                    $response['message'], 
                    'printReciept.php'
                );
            } else {
                url(
                    'error', 
                    $response['message'], 
                    'sale.php'
                );
            }
            die();
        }

        if(isset($_POST['searchbarcode'])
        ) {
            if(empty($_POST['barcode'])
            ) {
                url(
                    'warning', 
                    'Please fill up fields!', 
                    'sale.php'
                );
                die();
            }
            $response = $saleObj->searchItem(
                $_POST['barcode']
            );
            $itemList = isset($_SESSION['itemOrder']) ? $_SESSION['itemOrder'] : array();

            if($response['status'] == 'success') {
                $i=0;
                foreach ($itemList as $item) {
                    if ($item['product_id'] == $response['cart'][0]['product_id']) {
                        $_SESSION['itemOrder'][$i]['qty'] += 1; 

                        header('Location: sale.php');
                        die();
                    }
                    $i++;
                }

                $response['cart'][0]['qty'] = 1;
                $_SESSION['itemOrder'][]=$response['cart'][0];

                url(
                    'success', 
                    $response['message'], 
                    'sale.php'
                );
            } else {
                url(
                    'error', 
                    $response['message'], 
                    'sale.php'
                );
            }
            die();
        }
    
        function url($icon, $msg, $path) {
            echo '
                <script>
                    Swal.fire({
                        position: "center",
                        icon: "'.$icon.'",
                        title: "'.$msg.'",
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script>
            ';

            echo '
                <script>
                    setTimeout(() => {
                        window.location="'.$path.'";
                    }, 2000);
                </script>
            ';
        }
    ?>
</body>
</html>