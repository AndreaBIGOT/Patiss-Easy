<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 *
 * @ORM\Table(name="ingredient")
 * @ORM\Entity
 */
class Ingredient
{
    /**
     * @var int
     *
     * @ORM\Column(name="idIng", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iding;

    /**
     * @var string
     *
     * @ORM\Column(name="ingredient", type="string", length=50, nullable=false)
     */
    private $ingredient;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Lieu", inversedBy="iding")
     * @ORM\JoinTable(name="ingredient_lieu",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idIng", referencedColumnName="idIng")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idLieu", referencedColumnName="idLieu")
     *   }
     * )
     */
    private $idlieu;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recette", mappedBy="iding")
     */
    private $idrecette;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idlieu = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idrecette = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->ingredient;
    }

    public function getIding(): ?int
    {
        return $this->iding;
    }

    public function getIngredient(): ?string
    {
        return $this->ingredient;
    }

    public function setIngredient(string $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * @return Collection|Lieu[]
     */
    public function getIdlieu(): Collection
    {
        return $this->idlieu;
    }

    public function addIdlieu(Lieu $idlieu): self
    {
        if (!$this->idlieu->contains($idlieu)) {
            $this->idlieu[] = $idlieu;
        }

        return $this;
    }

    public function removeIdlieu(Lieu $idlieu): self
    {
        $this->idlieu->removeElement($idlieu);

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getIdrecette(): Collection
    {
        return $this->idrecette;
    }

    public function addIdrecette(Recette $idrecette): self
    {
        if (!$this->idrecette->contains($idrecette)) {
            $this->idrecette[] = $idrecette;
            $idrecette->addIding($this);
        }

        return $this;
    }

    public function removeIdrecette(Recette $idrecette): self
    {
        if ($this->idrecette->removeElement($idrecette)) {
            $idrecette->removeIding($this);
        }

        return $this;
    }

}
