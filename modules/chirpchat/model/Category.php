<?php

namespace ChirpChat\Model;

/**
 * Représente une catégorie.
 */
class Category
{
    /**
     * Crée une nouvelle instance de Category.
     *
     * @param int $idCat L'ID de la catégorie.
     * @param string $libelle Le libellé de la catégorie.
     * @param string $description La description de la catégorie.
     */
    public function __construct(private int $idCat, private string $libelle, private string $description){}

    /**
     * Obtient l'ID de la catégorie.
     *
     * @return int L'ID de la catégorie.
     */
    public function getIdCat(): int
    {
        return $this->idCat;
    }

    /**
     * Obtient la description de la catégorie.
     *
     * @return string La description de la catégorie.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Obtient le libellé de la catégorie.
     *
     * @return string Le libellé de la catégorie.
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }


}

