<?php
    class Sale extends Db {

        public function showProduct($catId) {
            try {
                if(!empty($catId)
                ) {
                    $stmt = $this->connect()->prepare("SELECT * FROM tbl_product p LEFT JOIN  tbl_category c ON c.cat_id=p.cat_id WHERE p.cat_id=:cat_id ORDER BY product_id DESC");
                    $stmt->execute([
                        "cat_id" => $catId
                    ]);
                } else {
                    $stmt = $this->connect()->prepare("SELECT * FROM tbl_product p LEFT JOIN  tbl_category c ON c.cat_id=p.cat_id WHERE product_id ORDER BY product_id DESC");
                    $stmt->execute();
                }
                $arr = array();

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)
                ){
                    $arr[]=$row; 
                }

                return $arr;
                
            } catch (Exception $e) {
                print_r($e->getMessage());
                die();
            }
        }

        public function addItemOrder($id) {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_product WHERE product_id=:product_id");
                $stmt->execute([
                    "product_id" => $id
                ]);
                $arr = array();

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)
                ){
                    $arr[]=$row; 
                }

                return array(
                    'message'=> 'Added 1 Item.',
                    'cart'   => $arr,
                    'status' => 'success'
                );
                
            } catch (Exception $e) {
                return array(
                    'message'=> $e->getMessage(),
                    'status' => 'error'
                );
            }
        }

        public function searchItem($barcode) {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_product WHERE barcode=:barcode");
                $stmt->execute([
                    "barcode" => $barcode
                ]);
                $arr = array();

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)
                ){
                    $arr[]=$row; 
                }

                if(count($arr) == 0) {
                    return array(
                        'message'=> 'Barcode Note found!.',
                        'status' => 'warning'
                    );
                    die();
                }

                return array(
                    'message'=> 'Added 1 Item.',
                    'cart'   => $arr,
                    'status' => 'success'
                );
                
            } catch (Exception $e) {
                return array(
                    'message'=> $e->getMessage(),
                    'status' => 'error'
                );
            }
        }

        public function saveTransaction($items) {
            try {

                foreach ($items as $item) {
                    $stmt = $this->connect()->prepare("INSERT INTO tbl_history (`price`, `qty`, `create_date`)VALUES(:price, :qty, DATE(NOW()))");
                    $stmt->execute([
                        'price' => $item['p_price'],
                        'qty'   => $item['qty']
                    ]);
                }

                return array(
                    'message'=> 'Data Save.',
                    'status' => 'success'
                );
                
            } catch (Exception $e) {
                
                return array(
                    'message' => $e->getMessage(),
                    'status'  => 'error'
                );
            }
        }

        public function removeProduct($id) {
            try {
                $stmt = $this->connect()->prepare("DELETE FROM tbl_product WHERE product_id=:product_id");
                $stmt->execute([
                    'product_id' => $id
                ]);

                return array(
                    'message'=> 'Product Remove Successfully.',
                    'status' => 'success'
                );
                
            } catch (Exception $e) {
                
                return array(
                    'message' => $e->getMessage(),
                    'status'  => 'error'
                );
            }
        }
    }
?>