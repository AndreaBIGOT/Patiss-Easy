<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecetteIngredient
 *
 * @ORM\Table(name="recette_ingredient", indexes={@ORM\Index(name="idRecette", columns={"idRecette"}), @ORM\Index(name="IDX_17C041A9B1A786E8", columns={"idIng"})})
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
     * @var float
     *
     * @ORM\Column(name="quantite", type="float", nullable=false)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="unite", type="string", length=10, nullable=false)
     */
    private $unite;

    /**
     * @var \Ingredient
     *
     * @ORM\ManyToOne(targetEntity="Ingredient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idIng", referencedColumnName="idIng")
     * })
     */
    private $iding;

    /**
     * @var \Recette
     *
     * @ORM\ManyToOne(targetEntity="Recette")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRecette", referencedColumnName="idRecette")
     * })
     */
    private $idrecette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(string $unite): self
    {
        $this->unite = $unite;

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

    public function getIdrecette(): ?Recette
    {
        return $this->idrecette;
    }

    public function setIdrecette(?Recette $idrecette): self
    {
        $this->idrecette = $idrecette;

        return $this;
    }


}
