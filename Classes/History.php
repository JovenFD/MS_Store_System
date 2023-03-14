<?php
    class History extends Db {

        public function getSalesHistory() {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_history ORDER BY history_id DESC");
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

        public function generateReports($frmDate, $Todate) {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_history WHERE create_date BETWEEN '$frmDate' AND '$Todate' ORDER BY history_id DESC");
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

        public function getTilesLog() {
            try {
                $stmtTotal = $this->connect()->prepare("SELECT SUM(price) AS `total` FROM tbl_history");
                $stmtTotal->execute();

                $stmtQty = $this->connect()->prepare("SELECT SUM(qty) AS `total` FROM tbl_history");
                $stmtQty->execute();
                

                return array(
                    'qty'    => $stmtQty->fetch(PDO::FETCH_ASSOC)['total'],
                    'total'  => $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'],
                    'status' => 'error'
                );
                
            } catch (Exception $e) {
                return array(
                    'message'=> $e->getMessage(),
                    'status' => 'error'
                );
            }
        }
    }
?>