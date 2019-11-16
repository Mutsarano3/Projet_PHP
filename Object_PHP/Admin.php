<?php
/*Opérations de l'administrateur*/
class Admin
{
    private $email;
    private $mdp;
    public $erreuremail;
    public $erreurmdp;
    private $mdpconfirm;
    public $isValid;
    public $annonceError;
    private $db;
    private $sql;
    private $log;
    private $annonce;
    /*Hors DAO*/
    private $mdpusers;


    public function __construct(PDO $e)
    {
        $this->db =$e;


    }

    public function getAnnonce()
    {
        return $this->annonce;
    }
    public function setAnnonce($var)
    {
        $this->annonce = $var;
    }

    public function getMdpUsers()
    {
        return $this->mdpusers;
    }
    public function setMdpUsers($var)
    {
        $this->mdpusers = $var;
    }



    public function isLog()
    {
        return $this->log;
    }

    private function setLog($e)
    {
        $this->log = $e;

    }
    

    public function getMdpConfirm()
    {
        return $this->mdpconfirm;
    }
    public function setMdpConfirm($var)
    {
        $this->mdpconfirm = $var;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($mail)
    {
        $this->email = $mail;

    }
    public function getMdp()
    {
        return $this->mdp;
    }
    public function setMdp($password)
    {
        $this->mdp = $password;
    }

    private function isExistEmail()
    {
        $sql=$this->db->prepare("SELECT email FROM admin");
        $sql->execute();
        while($row = $sql->fetch())
        {
            if($row['email'] == $this->getEmail())
            {
                
                return true;
            }
            else
            {
                return false;
            }
        }
    }


    public function RecupId($email)
    {
        $sql = $this->db->prepare('SELECT id_admin FROM admin WHERE email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    

    public function RecupEmail($email)
    {
        $sql = $this->db->prepare('SELECT email FROM admin WHERE email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupMdp($email)
    {
        $sql = $this->db->prepare('SELECT Mot_passe FROM admin WHERE email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }

    
    
    private function isValidEmail($mail)
    {
        return filter_var($mail,FILTER_VALIDATE_EMAIL);
    }
    public function AdminLogin($mail,$mdp)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $mail = $this->IsSecure($mail);
            $mdp = $this->IsSecure($mdp);

            if(empty($this->isLoginValidEmail($mail)) or empty($this->isLoginValidMdp($mdp,$mail)))
            {
                $this->setLog(false);
                
                
                
            }
            else
            {
                echo "Succés connection réussi";
                $this->setLog(true);
               
                
            }
        }
    }

    private function isLoginValidEmail($e)
    {
        $mail = "";
        $sql=$this->db->prepare("SELECT email FROM admin WHERE email= ?");
        $sql->execute(array($e));
        while($row = $sql->fetch())
        {
            if($row['email'] == $e)
            {
                $mail=$row['email'];
                return $mail;
            }
            else
            {
                return "";
            }
        }
    }
    private function isLoginValidMdp($e,$m)
    {
        $mdp = "";
        $sql=$this->db->prepare("SELECT email FROM admin WHERE Mot_passe = ? AND email=?");
        $sql->execute(array(sha1($e),$m));
        while($row = $sql->fetch())
        {
            if($row['email'] == $m)
            {
                $mdp=$row['email'];
                return $mdp;
            }
            else
            {
                return "";
            }
        }
    }
    public function IsSecure($var)
    {
        $var = trim($var); 
        $var = stripslashes($var);
        $var = htmlspecialchars($var); 
        return $var;

    }
    private function isPrepare()
    {
        $this->sql=$this->db->prepare("INSERT INTO admin(email,Mot_passe) VALUES(?,?)");
    }
    private function isExecute()
    {
        $this->sql->execute(array($this->getEmail(),$this->getMdp()));

    }
    public function RecupUserEmail($id)
    {
        $sql = $this->db->prepare('SELECT ID_users FROM users WHERE ID_users=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupUserPrenom($id)
    {
        $sql = $this->db->prepare('SELECT Prenom FROM users WHERE ID_users=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupUserNom($id)
    {
        $sql = $this->db->prepare('SELECT Nom FROM users WHERE ID_users=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupUserDate($id)
    {
        $sql = $this->db->prepare('SELECT Date_Naissance FROM users WHERE ID_users=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupUserPays($id)
    {
        $sql = $this->db->prepare('SELECT Pays FROM users WHERE ID_users=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupUserLocalite($id)
    {
        $sql = $this->db->prepare('SELECT Localite FROM users WHERE ID_users=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupUserRue($id)
    {
        $sql = $this->db->prepare('SELECT Rue FROM users WHERE ID_users=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupUserSexe($id)
    {
        $sql = $this->db->prepare('SELECT Sexe FROM users WHERE ID_users=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }



    public function VerifId($var,$compare)
    {
        $var  = $this->IsSecure($var);
        if($var == $compare)
        {
            return $var;

        }
        else
        {
            return -1;

        }
        
    }

    public function AnnoncesisValid($message,$id_admin)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->setAnnonce($this->isSecure($message));
            $messagevalid=true;
            $this->annonceError = false;
            $sql = $this->db->prepare('INSERT INTO annonce(id,annonce) VALUES(?,?)');
            if(empty($message) or !preg_match("#[^/*-+_<>]#",$message))
            {
                $messagevalid = false;
                $this->annonceError = true;
            }
            else
            {
                $sql->execute(array($id_admin,$this->getAnnonce()));
                //sleep(2);
                header('location: ../Vue_PHP/AccueilAdmin.php ');
                exit();
    
            }

        }


    }

    private function ChangerMdp($mdpnew,$email)
    {
        $sql=$this->db->prepare("UPDATE admin SET Mot_passe = ? WHERE email = ? ");
        $_SESSION['passwd'][0] = $mdpnew;
        $sql->execute(array($mdpnew,$email));
        
    }

    private function ChangerMdpUsersSql($mdpnew,$id)
    {
        $sql=$this->db->prepare("UPDATE users SET Mot_de_passe = ? WHERE ID_users = ? ");
        $_SESSION['passwd'][0] = $mdpnew;
        $sql->execute(array($mdpnew,$id));
        
    }


    public function VerifMdpChange($email,$mdpold,$mdpnew,$mdpnewconfirm,$mdpsession)
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $mdpold = $this->isSecure($mdpold);
            $mdpnew = $this->isSecure($mdpnew);
            $mdpconfirm = $this->isSecure($mdpnewconfirm);
        if( !preg_match("#^[A-Z][^/*-+_<>]+[0-9]#",$mdpnew) or(empty($mdpold)) or (empty($mdpnew)) or (empty($mdpnewconfirm)) and ($mdpold != $mdpsession) or ($mdpnew != $mdpnewconfirm) or($mdpold == $mdpnew) or strlen($mdpnew) <4)
        {
            $this->erreurmdp = true;
            
        }
        else
        {
            $this->erreurmdp = false;
            $this->ChangerMdp(sha1($mdpnew),$email);
            $_SESSION['passwd'][0] = sha1($mdpnew);
            //sleep(5);
            header('location: ../Vue_PHP/DashBoard.php');
            exit();
        }

        }
        

    }

    public function ChangeMdpUsers($mdp,$mdpconfirm,$id)
    {
        $this->setMdpUsers($this->IsSecure($mdp));
        $mdpconfirm = $this->IsSecure($mdpconfirm);
        $this->isValid = true;
        $this->erreurmdp = false;
        
        if( !preg_match("#^[A-Z][^/*-+_<>]+[0-9]#",$mdp) or strlen($mdp) <4 or empty($mdp) or empty($mdpconfirm) or $mdp != $mdpconfirm)
        {
            $this->erreurmdp = true;
            
        }
        else
        {
            $this->erreurmdp = false;
            $this->ChangerMdpUsersSql(sha1($mdp),$id);
            //$_SESSION['passwd'][0] = sha1($mdpnew);
            //sleep(5);
            header('location: ../Vue_PHP/DashBoard.php');
            exit();
        }

    }

    
}


?>