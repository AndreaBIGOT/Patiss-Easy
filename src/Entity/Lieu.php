<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lieu
 *
 * @ORM\Table(name="lieu")
 * @ORM\Entity
 */
class Lieu
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLieu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlieu;

    /**
     * @var string
     *
     * @ORM\Column(name="magasin", type="string", length=70, nullable=false)
     */
    private $magasin;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=false)
     */
    private $ville;

    /**
     * @var int
     *
     * @ORM\Column(name="cp", type="integer", nullable=false)
     */
    private $cp;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ingredient", mappedBy="idlieu")
     */
    private $iding;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->iding = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdlieu(): ?int
    {
        return $this->idlieu;
    }

    public function getMagasin(): ?string
    {
        return $this->magasin;
    }

    public function setMagasin(string $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIding(): Collection
    {
        return $this->iding;
    }

    public function addIding(Ingredient $iding): self
    {
        if (!$this->iding->contains($iding)) {
            $this->iding[] = $iding;
            $iding->addIdlieu($this);
        }

        return $this;
    }

    public function removeIding(Ingredient $iding): self
    {
        if ($this->iding->removeElement($iding)) {
            $iding->removeIdlieu($this);
        }

        return $this;
    }

}
