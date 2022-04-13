<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Budget
 *
 * @ORM\Table(name="budget", indexes={@ORM\Index(name="ID_Sponsor", columns={"ID_Sponsor"})})
 * @ORM\Entity
 */
class Budget
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Budget", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")

     */
    private $idBudget;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Montant", type="integer", nullable=true)
     * @Assert\GreaterThan(0)
     */
    private $montant;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Activite", type="string", length=100, nullable=true)
     * @Assert\NotBlank
     */
    private $activite;

    /**
     * @var \Sponsors
     *
     * @ORM\ManyToOne(targetEntity="Sponsors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Sponsor", referencedColumnName="ID_Sponsor")
     * })
     */
    private $idSponsor;

    public function getIdBudget(): ?int
    {
        return $this->idBudget;
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

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(?string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    public function getIdSponsor(): ?Sponsors
    {
        return $this->idSponsor;
    }

    public function setIdSponsor(?Sponsors $idSponsor): self
    {
        $this->idSponsor = $idSponsor;

        return $this;
    }


}
