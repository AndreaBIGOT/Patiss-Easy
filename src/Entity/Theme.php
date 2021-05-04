<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity
 */
class Theme
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTheme", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtheme;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=50, nullable=false)
     */
    private $theme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recette", mappedBy="idtheme")
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
        return $this->theme;
    }

    public function getIdtheme(): ?int
    {
        return $this->idtheme;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

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
            $idrecette->addIdtheme($this);
        }

        return $this;
    }

    public function removeIdrecette(Recette $idrecette): self
    {
        if ($this->idrecette->removeElement($idrecette)) {
            $idrecette->removeIdtheme($this);
        }

        return $this;
    }

}
