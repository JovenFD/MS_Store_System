<?php
    class Tiles extends Db {

        public function totalCategory() {
            try {
                $stmt = $this->connect()->prepare("SELECT COUNT(*) AS `total` FROM tbl_category");
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
                
            } catch (Exception $e) {
                return array(
                    'message'=> $e->getMessage(),
                    'status' => 'error'
                );
            }
        }

        public function totalProduct() {
            try {
                $stmt = $this->connect()->prepare("SELECT COUNT(*) AS `total` FROM tbl_product");
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
                
            } catch (Exception $e) {
                return array(
                    'message'=> $e->getMessage(),
                    'status' => 'error'
                );
            }
        }

        public function totalLog() {
            try {
                $stmt = $this->connect()->prepare("SELECT COUNT(*) AS `total` FROM tbl_history");
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
                
            } catch (Exception $e) {
                return array(
                    'message'=> $e->getMessage(),
                    'status' => 'error'
                );
            }
        }

        public function getSalesBarGraph($moth) {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_history");
                $stmt->execute();
                $total = 0;

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)
                ){
                    if($moth == date('m', strtotime($row['create_date']))
                    ) {
                        $total += ($row['price'] * $row['qty']); 
                    }
                }

                return $total;
                
            } catch (Exception $e) {
                return array(
                    'message'=> $e->getMessage(),
                    'status' => 'error'
                );
            }
        }
    }
?>