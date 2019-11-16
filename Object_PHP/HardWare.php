<?php
/*Opérations sur le matériel*/
class HardWare
{
    private $id;
    private $nom;
    private $marque;
    private $num;
    private $prix;
    private $stock;
    private $images;
    public $nom_Error;
    public $marque_Error;
    public $num_Error;
    public $prix_Error;
    public $stock_Error;
    public $images_Error;
    public $id_error;
    public $isValid;
    private $sql;



    public function __construct(PDO $e)
    {
        $this->db =$e;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($var)
    {
        $this->id = $var;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($var)
    {
        $this->nom = $var;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function setMarque($var)
    {
        $this->marque = $var;
    }
    public function getNum()
    {
        return $this->num;
    }
    public function setNum($var)
    {
        $this->num = intval($var);
    }
    public function getPrix()
    {
        return $this->prix;
    }
    public function setPrix($var)
    {
        $this->prix = doubleval($var);
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($var)
    {
        $this->stock = intval($var);
    }
    public function getImages()
    {
        return $this->images;
    }
    public function setImages($var)
    {
        $this->images = $var;
    }
    private function isPrepare()
    {
        $this->sql=$this->db->prepare('INSERT INTO materiel(Nom_Materiel,Marque,Num_categorie,Prix,Stock,images) VALUES(?,?,?,?,?,?)');
    }
    private function isPrepareUpdate()
    {
        $this->sql = $this->db->prepare('UPDATE materiel SET Nom_Materiel=?,Marque=?,Num_categorie=?,Prix=?,Stock=?,images=? WHERE ID_Materiel=?');

    }
    public function isExecuteUpdate($id_update)
    {
        $this->sql->execute(array($this->getNom(),$this->getMarque(),$this->getNum(),$this->getPrix(),$this->getStock(),$this->getImages(),$id_update));

    }

    public function RecupNom($id)
    {
        $sql = $this->db->prepare('SELECT Nom_Materiel FROM materiel WHERE ID_Materiel=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;

    }
    public function RecupMarque($id)
    {
        $sql = $this->db->prepare('SELECT Marque FROM materiel WHERE ID_Materiel=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }
    public function RecupNumCategorie($id)
    {
        $sql = $this->db->prepare('SELECT Num_categorie FROM materiel WHERE ID_Materiel=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;

    }
    public function RecupPrix($id)
    {
        $sql = $this->db->prepare('SELECT Prix FROM materiel WHERE ID_Materiel=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;


    }
    public function RecupStock($id)
    {
        $sql = $this->db->prepare('SELECT Stock FROM materiel WHERE ID_Materiel=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;


    }
    public function RecupImages($id)
    {
        $sql = $this->db->prepare('SELECT images FROM materiel WHERE ID_Materiel=?');
        $sql->execute(array($id));
        $row = $sql->fetch();
        return $row;
    }

    public function verifHardWare($id,$nom,$marque,$prix,$stock,$images)
    {
        $this->setNom($this->IsSecure($nom));
        $this->setMarque($this->IsSecure($marque));
        $this->setPrix($this->IsSecure($prix));
        $this->setStock($this->IsSecure($stock));
        $this->setImages($this->IsSecure($images));
        $this->setId($this->IsSecure($id));
        $this->nom_Error = false;
        $this->marque_Error = false;
        $this->prix_Error = false;
        $this->stock_Error = false;
        $this->images_Error = false;
        $this->id_error = false;
        $this->isValid = true;
        if(empty($nom) or !preg_match("#[^/*-+_<>]#",($nom)))
        {
            $this->nom_Error = true;
            $this->isValid = false;

        }
        if(empty($marque) or !preg_match("#[^0-9][^/*-+_<>]#",($marque)))
        {
            $this->marque_Error = true;
            $this->isValid = false;

        }

        if(empty($prix) or !preg_match("#[^a-z][0-9]*[^/*-+_<>]#",($prix)))
        {
            $this->prix_Error = true;
            $this->isValid = false;

        }
        if(empty($stock) or !preg_match("#[0-9]*[^/*-+_<>]#",($stock)))
        {
            $this->stock_Error = true;
            $this->isValid = false;

        }
        if(empty($images) or !preg_match("#[^/*-+_<>]#",($images)))
        {
            $this->images_Error = true;
            $this->isValid = false;
        }
        if(empty($id) or !preg_match("#[0-9]*[^/*-+_<>]#",($id)))
        {
            $this->id_error = true;
            $this->isValid = false;

        }

    }

    public function HardWareValid($nom,$marque,$num,$prix,$stock,$images)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            
            $this->setNom($this->IsSecure($nom));
            $this->setMarque($this->IsSecure($marque));
            $this->setNum($this->IsSecure($num));
            $this->setPrix($this->IsSecure($prix));
            $this->setStock($this->IsSecure($stock));
            $this->setImages($this->IsSecure($images));
            $this->nom_Error = false;
            $this->marque_Error = false;
            $this->num_Error = false;
            $this->prix_Error = false;
            $this->stock_Error = false;
            $this->images_Error = false;
            $this->isValid = true;
            $this->isPrepare();
        /*--------------------------------------------------------*/
        if(empty($nom) or !preg_match("#[^/*-+_<>]#",($nom)))
        {
            $this->nom_Error = true;
            $this->isValid = false;

        }
        if(empty($marque) or !preg_match("#[^0-9][^/*-+_<>]#",($marque)))
        {
            $this->marque_Error = true;
            $this->isValid = false;

        }
        if(empty($num) or!preg_match("#[0-9]*[^/*-+_<>]#",($num)))
        {
            $this->num_Error = true;
            $this->isValid = false;

        }

        if(empty($prix) or !preg_match("#[^a-z][0-9]*[^/*-+_<>]#",($prix)))
        {
            $this->prix_Error = true;
            $this->isValid = false;

        }
        if(empty($stock) or !preg_match("#[0-9]*[^/*-+_<>]#",($stock)))
        {
            $this->stock_Error = true;
            $this->isValid = false;

        }
        if(empty($images) or !preg_match("#[^/*-+_<>]#",($images)))
        {
            $this->images_Error = true;
            $this->isValid = false;
        }
        if($this->isValid == true)
        {
            $this->isValid = true;
            $this->isExecute();
            //sleep(2);
            header('location: ../Vue_PHP/DashBoard.php');

        }


        }
        


    }

    public function HardWareUpdate($nom,$marque,$num,$prix,$stock,$images,$id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            
            $this->setNom($this->IsSecure($nom));
            $this->setMarque($this->IsSecure($marque));
            $this->setNum($this->IsSecure($num));
            $this->setPrix($this->IsSecure($prix));
            $this->setStock($this->IsSecure($stock));
            $this->setImages($this->IsSecure($images));
            $this->nom_Error = false;
            $this->marque_Error = false;
            $this->num_Error = false;
            $this->prix_Error = false;
            $this->stock_Error = false;
            $this->images_Error = false;
            $this->isValid = true;
            $this->isPrepareUpdate();
        /*--------------------------------------------------------*/
        if(empty($nom) or !preg_match("#[^/*-+_<>]#",($nom)))
        {
            $this->nom_Error = true;
            $this->isValid = false;

        }
        if(empty($marque) or !preg_match("#[^0-9][^/*-+_<>]#",($marque)))
        {
            $this->marque_Error = true;
            $this->isValid = false;

        }
        if(empty($num) or !preg_match("#[0-9]*[^/*-+_<>]#",($num)))
        {
            $this->num_Error = true;
            $this->isValid = false;

        }

        if(empty($prix) or !preg_match("#[0-9]*[^/*-+_<>]#",($prix)) or $prix < 0)
        {
            $this->prix_Error = true;
            $this->isValid = false;

        }
        if(empty($stock) or !is_numeric($stock) or $stock < 0)
        {
            $this->stock_Error = true;
            $this->isValid = false;

        }
        if(empty($images) or !preg_match("#[^/*-+_<>]#",($images)))
        {
            $this->images_Error = true;
            $this->isValid = false;
        }
        if($this->isValid == true)
        {
            $this->isValid = true;
            $this->isExecuteUpdate($id);
            //sleep(2);
            header('location: ../DataTransport/EndModifyHardWare.php');

        }


        }
        


    }


    
    private function isExecute()
    {
        $this->sql->execute(array($this->getNom(),$this->getMarque(),$this->getNum(),$this->getPrix(),$this->getStock(),$this->getImages()));
    }
    public function IsSecure($var)
    {
        $var = trim($var); 
        $var = stripslashes($var);
        $var = htmlspecialchars($var); 
        return $var;

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

   


    
}



?>