<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCateg", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcateg;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=50, nullable=false)
     */
    private $categorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recette", mappedBy="idcateg")
     */
    private $idrecette;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idrecette = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->categorie;
    }

    public function getIdcateg(): ?int
    {
        return $this->idcateg;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

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
            $idrecette->addIdcateg($this);
        }

        return $this;
    }

    public function removeIdrecette(Recette $idrecette): self
    {
        if ($this->idrecette->removeElement($idrecette)) {
            $idrecette->removeIdcateg($this);
        }

        return $this;
    }

}
