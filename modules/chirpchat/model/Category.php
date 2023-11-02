<?php

namespace ChirpChat\Model;

class Category
{

    public function __construct(private int $idCat, private string $libelle, private string $description){}

    /**
     * @return int
     */
    public function getIdCat(): int
    {
        return $this->idCat;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getNbPostInCategory() : int{
        $catRepo = new CategoryRepository(Database::getInstance()->getConnection());
        return $catRepo->getNbPostForCategory($this->idCat);
    }


}

