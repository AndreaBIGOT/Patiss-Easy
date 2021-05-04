<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ustensile
 *
 * @ORM\Table(name="ustensile")
 * @ORM\Entity
 */
class Ustensile
{
    /**
     * @var int
     *
     * @ORM\Column(name="idUstensile", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idustensile;

    /**
     * @var string
     *
     * @ORM\Column(name="ustensile", type="string", length=50, nullable=false)
     */
    private $ustensile;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recette", mappedBy="idustensile")
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

    public function getIdustensile(): ?int
    {
        return $this->idustensile;
    }

    public function getUstensile(): ?string
    {
        return $this->ustensile;
    }

    public function setUstensile(string $ustensile): self
    {
        $this->ustensile = $ustensile;

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
            $idrecette->addIdustensile($this);
        }

        return $this;
    }

    public function removeIdrecette(Recette $idrecette): self
    {
        if ($this->idrecette->removeElement($idrecette)) {
            $idrecette->removeIdustensile($this);
        }

        return $this;
    }

}
