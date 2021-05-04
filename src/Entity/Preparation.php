<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Preparation
 *
 * @ORM\Table(name="preparation", indexes={@ORM\Index(name="idRecette", columns={"idRecette"})})
 * @ORM\Entity
 */
class Preparation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPreparation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpreparation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etape", type="text", length=65535, nullable=true)
     */
    private $etape;

    /**
     * @var \Recette
     *
     * @ORM\ManyToOne(targetEntity="Recette")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRecette", referencedColumnName="idRecette")
     * })
     */
    private $idrecette;

    public function getIdpreparation(): ?int
    {
        return $this->idpreparation;
    }

    public function getEtape(): ?string
    {
        return $this->etape;
    }

    public function setEtape(?string $etape): self
    {
        $this->etape = $etape;

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
