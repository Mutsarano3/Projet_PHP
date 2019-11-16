<?php
/*Opérations de l'utilisateur/client*/
class User
{
    //ATTRIBUT
    private $nom;
    private $prenom;
    private $solde;
    private $email;
    private $mdp;
    private $sexe;
    private $date_naissance;
    private $pays;
    private $rue;
    private $db_user;
    private $localite;
    public $prenomErreur;
    public $nomErreur;
    public $mdpErreur;
    public $emailErreur;
    public $isvalid;
    public $sexeE;
    public $localiteErreur;
    public $dateErreur;
    public $paysErreur;
    public $rueE;
    public $messageError;
    private $isLog;
    private $db;
    private $message;
    //GET SET
    public function __construct( PDO $bdd)
    {
        $this->db = $bdd;
        $this->isvalid = false;
        
    }
    public function getIsLog()
    {
        return $this->isLog;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($var)
    {
        $this->message = $var;

    }
    public function setIsLog($bool)
    {
        $this->isLog = $bool;

    }
    public function getNom()
    {
        return $this->nom;

    }

    private function setNom($nom_p)
    {
        $this->nom = $nom_p;
    }

    public function getPrenom()
    {
        return $this->prenom;

    }

    private function setPrenom($prenom_p)
    {
        $this->prenom = $prenom_p;
    }

    public function getEmail()
    {
        return $this->email;

    }

   private function setEmail($email_p)
    {
        $this->email = $email_p;
    }

    public function getMdp()
    {
       return $this->mdp;

    }

    public function setMdp($mdp_p)
    {
        $this->mdp = $mdp_p;
    }

    public function getSolde()
    {
        return $this->solde;

    }

    public function setSolde($solde_p)
    {
        $this->solde = $solde_p;
    }

    public function getSexe()
    {
        return $this->sexe;

    }

    public function setSexe($sexe_p)
    {
        $this->sexe = $sexe_p;
    }

    public function getDate()
    {
        return $this->date_naissance;

    }

    public function setDate($date_p)
    {
        $this->date_naissance = $date_p;
    }

    public function getPays()
    {
        return $this->pays;

    }

    public function setPays($pays_p)
    {
        $this->pays = $pays_p;
    }
    private function IsValidEmail($var)
    {
        return filter_var($var,FILTER_VALIDATE_EMAIL);
    }

    public function getLocalite()
    {
        return $this->localite;

    }

    public function setLocalite($localite_p)
    {
        $this->localite = $localite_p;
    }

    public function getRue()
    {
        return $this->rue;

    }

    public function setRue($rue_p)
    {
        $this->rue = $rue_p;
    }

    //METHODES
    public function isSecure($var)
    {
        $var = trim($var); 
        $var = stripslashes($var);
        $var = htmlspecialchars($var); 
        return $var;
    }
    public function isNewUser()
    {
                $this->setDate("");
                $this->setEmail("");
                $this->setMdp("");
                $this->setNom("");
                $this->setLocalite("");
                $this->setPrenom("");
                $this->setSexe("");
                $this->setRue("");
                $this->setPays("");
    }
    
        
    
    private function isExistEmail()
    {
        $sql=$this->db->prepare("SELECT Email FROM users");
        $sql->execute();
        while($row = $sql->fetch())
        {
            if($row['Email'] == $this->getEmail())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }

    private function isLoginValidEmail($e)
    {
        $mail = "";
        $sql=$this->db->prepare("SELECT Email FROM users WHERE Email= ?");
        $sql->execute(array($e));
        while($row = $sql->fetch())
        {
            if($row['Email'] == $e)
            {
                $mail=$row['Email'];
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
        $sql=$this->db->prepare("SELECT Email FROM users WHERE Mot_de_passe = ? AND Email=?");
        $sql->execute(array(sha1($e),$m));
        while($row = $sql->fetch())
        {
            if($row['Email'] == $m)
            {
                $mdp=$row['Email'];
                return $mdp;
            }
            else
            {
                return "";
            }
        }
    }
    public function UserLogin($mail,$mdp,$ban,$desinscri)   
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(empty($this->isLoginValidEmail($mail)) or empty($this->isLoginValidMdp($mdp,$mail)) or $ban == 0 or $desinscri == 0)
            {
                $this->setIsLog(false);
                
                
                
            }
            else
            {
                echo "Succés connection réussi";
                $this->setIsLog(true);
               
                
            }
        }
    }
    public function RecupPrenom($email)
    {
        $sql = $this->db->prepare('SELECT Prenom FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupNom($email)
    {
        $sql = $this->db->prepare('SELECT Nom FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupEmail($email)
    {
        $sql = $this->db->prepare('SELECT Email FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupPays($email)
    {
        $sql = $this->db->prepare('SELECT Pays FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupSexe($email)
    {
        $sql = $this->db->prepare('SELECT Sexe FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupId($email)
    {
        $sql = $this->db->prepare('SELECT ID_users FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupDate($email)
    {
        $sql = $this->db->prepare('SELECT Date_Naissance FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupSolde($email)
    {
        $sql = $this->db->prepare('SELECT Solde FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupLocalite($email)
    {
        $sql = $this->db->prepare('SELECT Localite FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupRue($email)
    {
        $sql = $this->db->prepare('SELECT Rue FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupAdmin($email)
    {
        $sql = $this->db->prepare('SELECT admin FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }

    public function RecupDesinscri($email)
    {
        $sql = $this->db->prepare('SELECT admin FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupMdp($email)
    {
        $sql = $this->db->prepare('SELECT Mot_de_passe FROM users WHERE Email=?');
        $sql->execute(array($email));
        $row = $sql->fetch();
        return $row;
    }

    private function ChangerMdp($mdpnew,$email)
    {
        $sql=$this->db->prepare("UPDATE users SET Mot_de_passe = ? WHERE Email = ? ");
        $_SESSION['mdp'][0] = $mdpnew;
        $sql->execute(array($mdpnew,$email));
        
    }

    public function VerifMdpChange($email,$mdpold,$mdpnew,$mdpnewconfirm,$mdpsession)
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $mdpold = $this->isSecure($mdpold);
            $mdpnew = $this->isSecure($mdpnew);
            $mdpconfirm = $this->isSecure($mdpnewconfirm);
        if( !preg_match("#^[A-Z][^/*-+_<>]+[0-9]#",$mdpnew) or(empty($mdpold)) or (empty($mdpnew)) or (empty($mdpnewconfirm)) and ($mdpold != $mdpsession) or ($mdpnew != $mdpnewconfirm) or($mdpold == $mdpnew) or strlen($mdpnew) < 4)
        {
            $this->mdpErreur = true;
            
        }
        else
        {
            $this->mdpErreur = false;
            $this->ChangerMdp(sha1($mdpnew),$email);
            $_SESSION['mdp'][0] = sha1($mdpnew);
            //sleep(5);
            header('location: ../Vue_PHP/Profil.php');
        }

        }
        

    }

    public function UserUpdate($firstname,$name,$sexe,$date,$pays,$localite,$rue)
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            
            $this->setPrenom($this->isSecure($firstname));
            $this->setNom($this->isSecure($name));
            $this->setPays($this->isSecure($pays));
            $this->setLocalite($this->isSecure($localite));
            $this->setRue($this->isSecure($rue));
            $this->setSexe($this->isSecure($sexe));
            $this->nomErreur = false;
            $this->prenomErreur = false;
            $this->emailErreur = false; 
            $this->sexeE = false;
            $this->isvalid = true;

        if(empty($firstname) or !preg_match("#^[A-Z][^0-9][^/*-+_<>]#",($firstname)))
        {
            $this->prenomErreur = true;
            $this->isvalid = false;

        }

        if(empty($name) or !preg_match("#^[A-Z][^0-9][^/*-+_<>]#",$name))
        {
            $this->nomErreur = true;
            $this->isvalid = false;

        }
        if(!isset($sexe) or !$sexe == "f" or !$sexe == "h")
        {
                $this->sexeE = true;
                $this->isvalid = false;
                

        }
        else
        {
            $this->sexeE = false;
            //$this->sexe = $sexe;
        }
        
        if(empty($date))
        {
            
            $this->dateErreur = true;
            $this->isvalid = false;
                

        }
        else
        {
            
            $this->dateErreur = false;
            $this->date_naissance = $date;
        }
        if(empty($localite) or !preg_match("#[0-9][^a-z][^/*-+_<>]#",$localite))
        {
             $this->localiteErreur = true;
             $this->isvalid = false;

        }
        if(empty($pays) or !$pays == 'BE' or !$pays == "FR")
        {
            $this->paysErreur = true;
            $this->isvalid = false;
        }
        if(empty($rue) or !preg_match("#^[A-Z][^/*-+_<>]+[0-9]#",$rue))
        {
            $this->rueE = true;
            $this->isvalid = false;
        }

        }
        

    }
    

    public function UserValid($mail,$firstname,$name,$sexe,$date,$passwd,$confirm,$pays,$Localite,$rue)
    {
           
           if($_SERVER["REQUEST_METHOD"] == "POST")
           {
            $this->setEmail($this->isSecure($mail));
            $this->setPrenom($this->isSecure($firstname));
            $this->setNom($this->isSecure($name));
            $this->setMdp($this->isSecure(sha1($passwd)));
            $this->setPays($this->isSecure($pays));
            $this->setLocalite($this->isSecure($Localite));
            $this->setRue($this->isSecure($rue));
            $this->setSexe($this->isSecure($sexe));
            $this->nomErreur = false;
            $this->prenomErreur = false;
            $this->emailErreur = false; 
            $this->mdpErreur = false;
            $this->sexeE = false;
            $this->isvalid = true;
           
            if(empty($firstname) or !preg_match("#^[A-Z][^0-9][^/*-+_<>]#",($firstname)))
            {
                $this->prenomErreur = true;
                $this->isvalid = false;

            }
            if(empty($name) or !preg_match("#^[A-Z][^0-9][^/*-+_<>]#",$name))
            {
                $this->nomErreur = true;
                $this->isvalid = false;

            }
            if(!$this->IsValidEmail($mail) or ($this->isExistEmail() == true))
            {
                $this->emailErreur = true;
                $this->isvalid = false;

            }
            if(empty($passwd) or !preg_match("#^[A-Z][^/*-+_<>]+[0-9]#",$passwd) or ($passwd != $confirm) or strlen($passwd) <4 )
            {
                $this->mdpErreur = true;
                $this->isvalid = false;
                
            }
            if(!isset($sexe) or !$sexe == "f" or !$sexe == "h")
            {
                $this->sexeE = true;
                $this->isvalid = false;
                

            }
            else
            {
                $this->sexeE = false;
                //$this->sexe = $sexe;
            }
            if(empty($date))
            {
                $this->dateErreur = true;
                $this->isvalid = false;
                

            }
            else
            {
                $this->dateErreur = false;
                $this->date_naissance = $date;
            }
            if(empty($Localite) or !preg_match("#[0-9][^a-z][^/*-+_<>]#",$Localite))
            {
                $this->localiteErreur = true;
                $this->isvalid = false;

            }
            if(empty($pays) or !$pays == 'BE' or !$pays == "FR")
            {
                $this->paysErreur = true;
                $this->isvalid = false;
            }
            if(empty($rue) or !preg_match("#^[A-Z][^/*-+_<>]+[0-9]#",$rue))
            {
                $this->rueE = true;
                $this->isvalid = false;
            }
            
            if($this->isvalid == true)
            {
                // TO DO
                
            }
            
        }
        else
        {
            $this->isvalid = false;
        }

           

           
    }

    public function RecrediteSolde($p,$psource)
    {
       
        
            $tmpo=$this->isSecure($p);
            $solde_add = doubleval($tmpo);
        
            $psource=$psource+$solde_add;
            $this->setSolde($psource);

        
        
    }

    public function MessageisValid($message,$source)
    {
        $this->setMessage($this->isSecure($message));
        $messagevalid=true;
        $this->messageError = false;
        $sql = $this->db->prepare('INSERT INTO chat(email,Message) VALUES(?,?)');
        if(empty($message) or !preg_match("#[^/*-+_<>]#",$message))
        {
            $messagevalid = false;
            $this->messageError = true;
        }
        else
        {
            $sql->execute(array($source,$this->getMessage()));
            //sleep(2);
            header('location: ../Vue_PHP/Accueil.php ');

        }


    }



    

    
}
?>