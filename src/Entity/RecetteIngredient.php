<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecetteIngredient
 *
 * @ORM\Table(name="recette_ingredient", indexes={@ORM\Index(name="recette_ingredient_ibfk_1", columns={"idRecette"}), @ORM\Index(name="IDX_17C041A9B1A786E8", columns={"idIng"})})
 * @ORM\Entity
 */
class RecetteIngredient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="quantite", type="string", precision=10, scale=0, nullable=false)
     */
    private $quantite;

    /**
     * @var \Recette
     *
     * @ORM\ManyToOne(targetEntity="Recette")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRecette", referencedColumnName="idRecette")
     * })
     */
    private $idrecette;

    /**
     * @var \Ingredient
     *
     * @ORM\ManyToOne(targetEntity="Ingredient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idIng", referencedColumnName="idIng")
     * })
     */
    private $iding;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(String $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getIdrecette(): ?Recette
    {
        return $this->idrecette;
    }

    public function setIdrecette(?Recette $idrecette): self
    {
        $this->idrecette = $idrecette;

        return $this;
    }

    public function getIding(): ?Ingredient
    {
        return $this->iding;
    }

    public function setIding(?Ingredient $iding): self
    {
        $this->iding = $iding;

        return $this;
    }


}
