<?php
class Categorie{
    private $num;
    private $libelle;

    /**
     * Get the value of num
     */ 
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Get the value of libelle
     */ 
    public function getLibelle() : string
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle(string $libelle) : self
    {
        $this->libelle = $libelle;

        return $this;
    }
    /**
     * Retourne les continents
     *
     * @return Categorie[] tableau de continent 
     */
    public static function findAll():array
    {
        $req=MonPdo::getInstance()->prepare("select * from genre");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Genre');
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }
    /**
     * trouve un continent par son id
     *
     * @param integer $id
     * @return Categorie
     */
    public static function findById(int $id) :Categorie{
        $req=MonPdo::getInstance()->prepare("select * from genre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Genre');
        $req->bindParam(':id',$id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }
    /**
     * Ajoute un continent
     *
     * @param Categorie $categorie
     * @return integer
     */
    public static function add(Categorie $categorie) :int{ 
        $req=MonPdo::getInstance()->prepare("insert into genre(libelle) values(:libelle)");
        $libelle=$categorie->getLibelle();
        $req->bindParam(':libelle', $categorie->getLibelle());
        $nb=$req->execute();
        return $nb;
    }
    /**
     * modif un continent
     *
     * @param Categorie $categorie
     * @return integer
     */
    public static function update(Categorie $categorie) :int{
        $req=MonPdo::getInstance()->prepare("update genre set libelle= :libelle where num= :id");
        $num=$categorie->getNum();
        $libelle=$categorie->getLibelle();
        $req->bindParam(':id',$num);
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }
    /**
     * supprime un continent
     *
     * @param Categorie $categorie
     * @return integer
     */
    public static function delete(Categorie $categorie) :int{
        $req=MonPdo::getInstance()->prepare("delete from genre where num= :id");
        $num=$categorie->getNum();
        $req->bindParam(':id',$num);
        $nb=$req->execute();
        return $nb;
    }


    /**
     * Set the value of num
     *
     * @return  self
     */ 
    public function setNum($num) :self
    {
        $this->num = $num;

        return $this;
    }
}

?>