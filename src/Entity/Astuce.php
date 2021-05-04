<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Astuce
 *
 * @ORM\Table(name="astuce")
 * @ORM\Entity
 */
class Astuce
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAstuce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idastuce;

    /**
     * @var string
     *
     * @ORM\Column(name="astuce", type="text", length=65535, nullable=false)
     */
    private $astuce;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recette", mappedBy="idastuce")
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

    public function getIdastuce(): ?int
    {
        return $this->idastuce;
    }

    public function getAstuce(): ?string
    {
        return $this->astuce;
    }

    public function setAstuce(string $astuce): self
    {
        $this->astuce = $astuce;

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
            $idrecette->addIdastuce($this);
        }

        return $this;
    }

    public function removeIdrecette(Recette $idrecette): self
    {
        if ($this->idrecette->removeElement($idrecette)) {
            $idrecette->removeIdastuce($this);
        }

        return $this;
    }

}
