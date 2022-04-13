<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Partie
 *
 * @ORM\Table(name="partie", indexes={@ORM\Index(name="fk_tournois", columns={"id_tournoi"}), @ORM\Index(name="fk_equipe1", columns={"id_equipe1"}), @ORM\Index(name="fk_eq2", columns={"id_equipe2"})})
 * @ORM\Entity
 */
class Partie
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPartie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpartie;

    /**
     * @var float
     *
     * @ORM\Column(name="duree", type="float", precision=10, scale=0, nullable=false)
     * @Assert\Positive (message="La durée doit etre positif")
     * @Assert\NotBlank(message="Veuillez remplir ce champ")
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_derou", type="date", nullable=false)
     * @Assert\NotBlank (message="Veuillez remplir ce champ")

     */
    private $dateDerou;

    /**
     * @var int
     * @Assert\NotBlank (message="Veuillez remplir ce champ")
     * @Assert\Positive (message="Le score doit etre positive")
     * @ORM\Column(name="score1", type="integer", nullable=false)
     */
    private $score1;

    /**
     * @var int
     * @Assert\NotBlank  (message="Veuillez remplir ce champ")
     * @Assert\Positive (message="Le score doit etre positive")
     * @ORM\Column(name="score2", type="integer", nullable=false)
     */
    private $score2;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_equipe1", referencedColumnName="id")
     * })
     */
    private $idEquipe1;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_equipe2", referencedColumnName="id")
     * })
     */
    private $idEquipe2;

    /**
     * @var \Tournois
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Tournois" , inversedBy="parties")
     * @ORM\JoinColumn(name="id_tournoi", referencedColumnName="id")
     */
    private $idTournoi;

    public function getIdpartie(): ?int
    {
        return $this->idpartie;
    }

    public function getDuree(): ?float
    {
        return $this->duree;
    }

    public function setDuree(float $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateDerou(): ?\DateTimeInterface
    {
        return $this->dateDerou;
    }

    public function setDateDerou(\DateTimeInterface $dateDerou): self
    {
        $this->dateDerou = $dateDerou;

        return $this;
    }

    public function getScore1(): ?int
    {
        return $this->score1;
    }

    public function setScore1(int $score1): self
    {
        $this->score1 = $score1;

        return $this;
    }

    public function getScore2(): ?int
    {
        return $this->score2;
    }

    public function setScore2(int $score2): self
    {
        $this->score2 = $score2;

        return $this;
    }

    public function getIdEquipe1(): ?Equipe
    {
        return $this->idEquipe1;
    }

    public function setIdEquipe1(?Equipe $idEquipe1): self
    {
        $this->idEquipe1 = $idEquipe1;

        return $this;
    }

    public function getIdEquipe2(): ?Equipe
    {
        return $this->idEquipe2;
    }

    public function setIdEquipe2(?Equipe $idEquipe2): self
    {
        $this->idEquipe2 = $idEquipe2;

        return $this;
    }

    public function getIdTournoi(): ?Tournois
    {
        return $this->idTournoi;
    }

    public function setIdTournoi(?Tournois $idTournoi): self
    {
        $this->idTournoi = $idTournoi;

        return $this;
    }



}
