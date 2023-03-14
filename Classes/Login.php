<?php
    class Login extends Db {

        public function loginForm($data) {
            $newPass = md5($data['password']);

            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_user WHERE username=:username AND password=:password LIMIT 01");
                $stmt->execute([
                    'username' => $data['username'],
                    'password' => $newPass
                ]);

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if(!$result) {
                    return array(
                        'message' => 'Invalid Username & Password',
                        'status'  => 'warning'
                    );
                    die();
                }

                return array(
                    'message' => $result,
                    'status'  => 'success'
                );
                
            } catch (Exception $e) {
                
                return array(
                    'message' => $e->getMessage(),
                    'status'  => 'error'
                );
            }
        }

        public function showProfile($id) {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_user WHERE user_id=:user_id LIMIT 01");
                $stmt->execute([
                    'user_id' => $id
                ]);

                return $stmt->fetch(PDO::FETCH_ASSOC);
                
            } catch (Exception $e) {
                return array(
                    'message' => $e->getMessage(),
                    'status'  => 'error'
                );
            }
        }

        public function changePassAction($data, $file) {
            $newPass = md5($data['newPassword']);

            try {
                if(empty($file)
                ) {
                    $stmt = $this->connect()->prepare("UPDATE tbl_user SET username=:username, f_name=:f_name, l_name=:l_name, password=:password WHERE user_id=:user_id");
                    $stmt->execute([
                        'username' => $data['username'],
                        'f_name' => $data['fName'],
                        'l_name' => $data['lName'],
                        'password' => $newPass,
                        'user_id'  => $data['id']
                    ]);

                    return array(
                        'message' => 'Update Account Successfully.',
                        'status'  => 'success'
                    );
                } else {
                    $stmt = $this->connect()->prepare("UPDATE tbl_user SET username=:username, f_name=:f_name, l_name=:l_name, password=:password, avatar=:avatar WHERE user_id=:user_id");
                    $stmt->execute([
                        'username' => $data['username'],
                        'f_name' => $data['fName'],
                        'l_name' => $data['lName'],
                        'password' => $newPass,
                        'user_id'  => $data['id'],
                        'avatar'   => $file
                    ]);

                    return array(
                        'message' => 'Update Account Successfully.',
                        'status'  => 'success'
                    );
                }
                
            } catch (Exception $e) {
                
                return array(
                    'message' => $e->getMessage(),
                    'status'  => 'error'
                );
            }
        }
    }
?>