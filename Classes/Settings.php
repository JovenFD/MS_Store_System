<?php 
    class Settings extends Db {

        public function getLogo() {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_logo");
                $stmt->execute();

                if($row = $stmt->fetch(PDO::FETCH_ASSOC)
                ) {
                    return $row;
                }

            } catch (Exception $e) {
                return array(
                    'message'=> $e->getMessage(),
                    'status' => 'error'
                );
            }
        }

        public function updateLogo($file, $id) {
            try {
                $stmt = $this->connect()->prepare("UPDATE tbl_logo SET path=:path WHERE logo_id=:logo_id");
                $stmt->execute([
                    'path'    => $file,
                    'logo_id' => $id
                ]);

                return array(
                    'message' => 'Update Logo Successfully.',
                    'status'  => 'success'
                );
                
            } catch (Exception $e) {
                return array(
                    'message' => $e->getMessage(),
                    'status'  => 'error'
                );
            }
        }

        public function updateAbout($data) {
            try {
                $stmt = $this->connect()->prepare("UPDATE tbl_about SET title=:title, `desc`=:desc WHERE about_id=:about_id");
                $stmt->execute([
                    'title'    => $data['title'],
                    'desc'     => $data['desc'],
                    'about_id' => $data['id']
                ]);

                return array(
                    'message' => 'Update About Successfully.',
                    'status'  => 'success'
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