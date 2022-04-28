<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="Société", type="string", length=50, nullable=true)
     */
    private $société;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Sponsor", type="string", length=50, nullable=true)
     */
    private $sponsor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Montant", type="integer", nullable=true)
     */
    private $montant;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Duree_spons", type="integer", nullable=true)
     */
    private $dureeSpons;

    public function getIdSponsor(): ?int
    {
        return $this->idSponsor;
    }

    public function getSociété(): ?string
    {
        return $this->société;
    }

    public function setSociété(?string $société): self
    {
        $this->société = $société;

        return $this;
    }

    public function getSponsor(): ?string
    {
        return $this->sponsor;
    }

    public function setSponsor(?string $sponsor): self
    {
        $this->sponsor = $sponsor;

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
