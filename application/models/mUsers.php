<?php
    class mUsers extends Model {
        
        /*
            1   id                  int(11)         AUTO_INCREMENT
            2   login               varchar(20)
            3   password            varchar(128)
            4   email               varchar(254)
            5   registration_date   int(11)
            5   last_connection     int(11)
            6   passphrase          varchar(128)
        */
        
        private $id;
        private $login;
        private $password;
        private $email;
        private $passphrase;
        
        /* ******************** SETTER ******************** */
            
        function setId($id) {
            $this->id = $id;
        }
        
        function setLogin($login) {
            $this->login = $login;
        }
        
        function setEmail($email) {
            $this->email = $email;
        }
            
        function setPassphrase($pp){
            $this->passphrase = $pp;
        }
        
        function setPassword($p) {
            $this->password = $p;
        }
        
        /* ******************** GETTER ******************** */
        function getId() {
            $req = $this->_sql->prepare("SELECT id FROM users WHERE email = ?");
            $req->execute(array($this->email));
            if($req->rowCount() == 0)
                return false;
            $res = $req->fetch();
            return $res['id'];
        }
        
        function getEmail() {
            $req = $this->_sql->prepare("SELECT email FROM users WHERE id = ?");
            $req->execute(array($this->id));
            if($req->rowCount() == 0)
                return false;
            $res = $req->fetch();
            return $res['email'];
        }
        
        function getPassphrase() {
             return $this->passphrase;
        }
        
        function getPassword() {
             return $this->password;
        }
            
        function getLogin() {
             return $this->login;
        }
        
        /* **************************************** */
        
        function EmailExists() {
            $req = $this->_sql->prepare("SELECT id FROM users WHERE email = ?");
            $req->execute(array($this->email));
            if($req->rowCount())
                return true;
            return false;
        }
        
        function LoginExists() {
            $req = $this->_sql->prepare("SELECT id FROM users WHERE login = ?");
            $req->execute(array($this->login));
            if($req->rowCount())
                return true;
            return false;
        }
        
        function Insertion() {
            $req = $this->_sql->prepare("INSERT INTO users VALUES ('', ?, ?, ?, ?, ?, ?)");
            $ret = $req->execute(array($this->login, $this->password, $this->email, time(), time(), $this->passphrase));   
            return $ret;
        }
        
		function Connection() {
			$req = $this->_sql->prepare("SELECT id FROM users WHERE email = ? AND password = ? AND passphrase = ?");
            $req->execute(array($this->email, $this->password, $this->passphrase));
            if($req->rowCount())
                return true;
            return false;
		}

        
        /*function getPassPhraseByIdUtilisateur() {
        	$pdo = $this->_InstancePDO->prepare($this->_RequeteSql);
        	
        	$idUtilisateur = $this->getidUtilisateur();
        	$pdo->bindValue("idUtilisateur",$idUtilisateur);
        	
        	$pdo->execute();
        	
        	if($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
        		$pp = $row['passPhrase'];
        	}
        	
        	return $pp;
        }*/
    }
?>