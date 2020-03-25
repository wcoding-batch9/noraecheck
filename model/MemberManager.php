<?php   
    require_once('model/Manager.php');

    /**
    * TODO: function to deleteMember (delete account)
    */

    class MemberManager extends Manager {
        public function addMember($email, $username, $password) {
            $db = $this->dbConnect();
            $email = htmlspecialchars($email);
            $username = htmlspecialchars($username);
            $password = password_hash(htmlspecialchars($password), PASSWORD_DEFAULT);       
            $addMember = $db->prepare("INSERT INTO members(email, username, password) VALUES(:email, :username, :password)");
            $addMember->bindParam(':email',$email,PDO::PARAM_STR);
            $addMember->bindParam(':username',$username,PDO::PARAM_STR);
            $addMember->bindParam(':password',$password,PDO::PARAM_STR);
            $status = $addMember->execute();
            if (!$status) {
                throw new PDOException('Impossible to add the member!');
            }
            $addMember->closeCursor();  
        } 

        public function getMember($username) {
            $db = $this->dbConnect();
            $members = $db->prepare("SELECT id, username, password FROM members WHERE username = :username");
            $members->bindParam(':username',$username,PDO::PARAM_STR);
            $resp = $members->execute();
            if(!$resp) {
                throw new PDOException('Invalid username or password!');
            }
            return $members->fetch();
        }
    }

