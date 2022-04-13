<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sponsors
 *
 * @ORM\Table(name="sponsors")
 * @ORM\Entity
 */
class Sponsors
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Sponsor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSponsor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Societe", type="string", length=50, nullable=true)
     * @Assert\NotBlank
     */
    private $societe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_Sponsor", type="string", length=50, nullable=true)
     * @Assert\NotBlank
     */
    private $nomSponsor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Montant", type="integer", nullable=true)
     * @Assert\GreaterThan(0)
     */
    private $montant;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Duree_spons", type="integer", nullable=true)
     * @Assert\NotBlank
     */
    private $dureeSpons;

    public function getIdSponsor(): ?int
    {
        return $this->idSponsor;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(?string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getNomSponsor(): ?string
    {
        return $this->nomSponsor;
    }

    public function setNomSponsor(?string $nomSponsor): self
    {
        $this->nomSponsor = $nomSponsor;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(?int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDureeSpons(): ?int
    {
        return $this->dureeSpons;
    }

    public function setDureeSpons(?int $dureeSpons): self
    {
        $this->dureeSpons = $dureeSpons;

        return $this;
    }


}
