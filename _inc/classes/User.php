<?php
    class User extends Database{
        private $db;
        public function __construct()
        {
            $this->db = $this->make_connection();
        }
        public function login($email, $password){
            try{
                $sql = "SELECT * FROM user WHERE email = ?";
                $query = $this->db->prepare($sql);
                $query->execute([$email]);
                $user = $query->fetch();
                if($user){
                    
                if($user->password === md5($password)){
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['is_admin'] = $user->role;
                    header('Location: index.php');
                    return true;
                }
                else{
                    echo "<h1>Nespravne heslo</h1><br><br>";
                    return false;
                }
                }
                else{
                    echo "<h1>Taký použivateľ neexistuje</h1><br><br>";
                    return false;
                }
            }
                catch(PDOException $e){
                    echo "Chyba pri registracii: ".$e->getMessage();
                    return false;
                }
        }
        public function register($email, $password){
            try{
            $sql = "SELECT * FROM user WHERE email = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$email]);
            if($query->rowCount() == 1){
                return false;
            }
            else{
                $data = array('email' => $email, 'password' => md5($password), 'role' => 0);
                $sql = "INSERT INTO user (email, password, role) VALUES (:email, :password, :role)";
                $query = $this->db->prepare($sql);
                $query->execute($data);
                return true;
                }
            }
            catch(PDOException $e){
                echo "Chyba pri registracii: ".$e->getMessage();
                return false;
            }
        }
    }
?>