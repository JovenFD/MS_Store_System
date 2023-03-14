<?php
    class Category extends Db {

        public function getCategory() {
            
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_category WHERE cat_id ORDER BY cat_id DESC");
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

        public function newCategory($data) {
            try {
                $stmt = $this->connect()->prepare("INSERT INTO tbl_category (`category`)VALUE(:category)");
                $stmt->execute([
                    'category' => $data['category']
                ]);

                return array(
                    'message'=> 'Category Save Successfully.',
                    'status' => 'success'
                );
                
            } catch (Exception $e) {
                
                return array(
                    'message' => $e->getMessage(),
                    'status'  => 'error'
                );
            }
        }

        public function removeCategory($id) {
            try {
                $stmt = $this->connect()->prepare("DELETE FROM tbl_category WHERE cat_id=:cat_id");
                $stmt->execute([
                    'cat_id' => $id
                ]);

                return array(
                    'message'=> 'Category Remove Successfully.',
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