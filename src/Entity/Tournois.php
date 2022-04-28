<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Tournois
 *
 * @ORM\Table(name="tournois")
 * @ORM\Entity(repositoryClass="App\Repository\TournoisRepository")
 * @UniqueEntity(fields={"nom"}, message="Ce nom est déja  utilisé")
 */
class Tournois
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
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     * @Assert\NotBlank (message="Veuillez remplir ce champ")
     * @Assert\Length(min=2, max=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_equipes", type="integer", nullable=false)
     * @Assert\Positive (message="le nombre d'équipes doit etre positive")
     * @Assert\NotBlank (message="Veuillez remplir ce champ")
     * @Assert\Range(min=2, max=600)
     */
    private $nbEquipes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="date", nullable=false)
     * @Assert\NotBlank (message="Veuillez remplir ce champ")
     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     * @Assert\NotBlank (message="Veuillez remplir ce champ")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="jeux", type="string", length=50, nullable=false)
     * @Assert\NotBlank (message="Veuillez remplir ce champ")
     */
    private $jeux;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partie" , mappedBy="idTournoi")
     */
    public $parties;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbEquipes(): ?int
    {
        return $this->nbEquipes;
    }

    public function setNbEquipes(int $nbEquipes): self
    {
        $this->nbEquipes = $nbEquipes;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getJeux(): ?string
    {
        return $this->jeux;
    }

    public function setJeux(string $jeux): self
    {
        $this->jeux = $jeux;

        return $this;
    }

    /**
     * @return Collection<int, Partie>
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): self
    {
        if (!$this->parties->contains($party)) {
            $this->parties[] = $party;
            $party->setIdTournoi($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->removeElement($party)) {
            // set the owning side to null (unless already changed)
            if ($party->getIdTournoi() === $this) {
                $party->setIdTournoi(null);
            }
        }

        return $this;
    }




}
