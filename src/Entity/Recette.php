<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity
 */
class Recette
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRecette", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrecette;

    /**
     * @var string
     *
     * @ORM\Column(name="recette", type="string", length=50, nullable=false)
     */
    private $recette;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionRecette", type="text", length=65535, nullable=false)
     */
    private $descriptionrecette;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime", nullable=false)
     */
    private $datepublication;


    /**
     * @var string|null
     *
     * @ORM\Column(name="petitePhrase", type="text", length=65535, nullable=true)
     */
    private $petitephrase;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Astuce", inversedBy="idrecette")
     * @ORM\JoinTable(name="recette_astuce",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idRecette", referencedColumnName="idRecette")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idAstuce", referencedColumnName="idAstuce")
     *   }
     * )
     */
    private $idastuce;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Categorie", inversedBy="idrecette")
     * @ORM\JoinTable(name="recette_categ",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idRecette", referencedColumnName="idRecette")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idCateg", referencedColumnName="idCateg")
     *   }
     * )
     */
    private $idcateg;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Theme", inversedBy="idrecette")
     * @ORM\JoinTable(name="recette_theme",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idRecette", referencedColumnName="idRecette")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idTheme", referencedColumnName="idTheme")
     *   }
     * )
     */
    private $idtheme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ustensile", inversedBy="idrecette")
     * @ORM\JoinTable(name="recette_ustensile",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idRecette", referencedColumnName="idRecette")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idUstensile", referencedColumnName="idUstensile")
     *   }
     * )
     */
    private $idustensile;


        /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="RecetteIngredient", inversedBy="idrecette")
     * @ORM\JoinTable(name="recette_ingredient",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idRecette", referencedColumnName="idRecette")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idRecette", referencedColumnName="idRecette")
     *   }
     * )
     */
     private $recetteIngredient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idastuce = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idcateg = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idtheme = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idustensile = new \Doctrine\Common\Collections\ArrayCollection();
        $this->recetteIngredient = new ArrayCollection();
    }

    public function getIdrecette(): ?int
    {
        return $this->idrecette;
    }

    public function getRecetteIngredient(): Collection
    {
        return $this->recetteIngredient;
    }

    public function getRecette(): ?string
    {
        return $this->recette;
    }

    public function setRecette(string $recette): self
    {
        $this->recette = $recette;

        return $this;
    }

    public function getDescriptionrecette(): ?string
    {
        return $this->descriptionrecette;
    }

    public function setDescriptionrecette(string $descriptionrecette): self
    {
        $this->descriptionrecette = $descriptionrecette;

        return $this;
    }

    public function getDatepublication(): ?\DateTimeInterface
    {
        return $this->datepublication;
    }

    public function setDatepublication(\DateTimeInterface $datepublication): self
    {
        $this->datepublication = $datepublication;

        return $this;
    }

    public function getPetitephrase(): ?string
    {
        return $this->petitephrase;
    }

    public function setPetitephrase(?string $petitephrase): self
    {
        $this->petitephrase = $petitephrase;

        return $this;
    }

    /**
     * @return Collection|Astuce[]
     */
    public function getIdastuce(): Collection
    {
        return $this->idastuce;
    }

    public function addIdastuce(Astuce $idastuce): self
    {
        if (!$this->idastuce->contains($idastuce)) {
            $this->idastuce[] = $idastuce;
        }

        return $this;
    }

    public function removeIdastuce(Astuce $idastuce): self
    {
        $this->idastuce->removeElement($idastuce);

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getIdcateg(): Collection
    {
        return $this->idcateg;
    }

    public function addIdcateg(Categorie $idcateg): self
    {
        if (!$this->idcateg->contains($idcateg)) {
            $this->idcateg[] = $idcateg;
        }

        return $this;
    }

    public function removeIdcateg(Categorie $idcateg): self
    {
        $this->idcateg->removeElement($idcateg);

        return $this;
    }

    /**
     * @return Collection|Theme[]
     */
    public function getIdtheme(): Collection
    {
        return $this->idtheme;
    }

    public function addIdtheme(Theme $idtheme): self
    {
        if (!$this->idtheme->contains($idtheme)) {
            $this->idtheme[] = $idtheme;
        }

        return $this;
    }

    public function removeIdtheme(Theme $idtheme): self
    {
        $this->idtheme->removeElement($idtheme);

        return $this;
    }

    /**
     * @return Collection|Ustensile[]
     */
    public function getIdustensile(): Collection
    {
        return $this->idustensile;
    }

    public function addIdustensile(Ustensile $idustensile): self
    {
        if (!$this->idustensile->contains($idustensile)) {
            $this->idustensile[] = $idustensile;
        }

        return $this;
    }

    public function removeIdustensile(Ustensile $idustensile): self
    {
        $this->idustensile->removeElement($idustensile);

        return $this;
    }

    public function addRecetteIngredient(RecetteIngredient $recetteIngredient): self
    {
        if (!$this->recetteIngredient->contains($recetteIngredient)) {
            $this->recetteIngredient[] = $recetteIngredient;
        }

        return $this;
    }

    public function removeRecetteIngredient(RecetteIngredient $recetteIngredient): self
    {
        $this->recetteIngredient->removeElement($recetteIngredient);

        return $this;
    }

    public function __toString()
    {
        return $this->recette;
    }

    public function getImages(){

        $images=array();

        $imgDir= 'image/gateau/recette-id-'.$this->idrecette;

        if ( is_dir($imgDir) && $handle= opendir($imgDir)) {
            
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".."){
                    if (str_contains($entry, '.jpg') || str_contains($entry, '.jpeg') || str_contains($entry, '.png') ){
                        $images[]= "/".$imgDir."/".$entry;
                    }
                }
            }
            closedir($handle);
        }

        if (empty($images)) {
            $images= ['/image/gateau/no-image.jpg'];
        }

        return $images;
    }

}
