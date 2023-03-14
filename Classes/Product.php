<?php
    class Product extends Db {

        public function getProduct() {
            
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_product p LEFT JOIN  tbl_category c ON c.cat_id=p.cat_id WHERE product_id ORDER BY product_id DESC");
                $stmt->execute();
                $arr = array();

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)
                ){
                    $arr[]=$row; 
                }

                return $arr;
                
            } catch (Exception $e) {
                return array(
                    'message'=> $e->getMessage(),
                    'status' => 'error'
                );
            }
        }

        public function newProduct($data, $file) {
            try {
                $stmt = $this->connect()->prepare("INSERT INTO tbl_product (`p_name`, `barcode`, `p_desc`, `cat_id`, `p_price`, `img`)VALUE(:p_name, :barcode, :p_desc, :cat_id, :p_price, :img)");
                $stmt->execute([
                    'p_name' => $data['name'],
                    'barcode' => uniqid(),
                    'p_desc' => $data['desc'],
                    'cat_id' => $data['category'],
                    'p_price'=> $data['price'],
                    'img'    => $file
                ]);

                return array(
                    'message'=> 'Product Save Successfully.',
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