<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

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
     *@Groups("sponsors")
     * @Groups("posts:read")
     */
    private $idSponsor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Societe", type="string", length=50, nullable=true)
     * @Assert\NotBlank
     *@Groups("sponsors")
     * @Groups("posts:read")
     */
    private $societe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_Sponsor", type="string", length=50, nullable=true)
     * @Assert\NotBlank
     *@Groups("sponsors")
     * @Groups("posts:read")
     */
    private $nomSponsor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Montant", type="integer", nullable=true)
     * @Assert\GreaterThan(0)
     *@Groups("sponsors")
     * @Groups("posts:read")
     */
    private $montant;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Duree_spons", type="integer", nullable=true)
     *@Groups("sponsors")
     * @Groups("posts:read")
     */
    private $dureeSpons;




    /**
     * @var string|null
     *
     * @ORM\Column(name="type_Sponsor", type="string", length=50, nullable=true)
     * @Assert\NotBlank
     *@Groups("sponsors")
     * @Groups("posts:read")
     */
    private $typeSponsor;


    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=true)
     *@Groups("sponsors")
     * @Groups("posts:read")
     */
    private $image;



    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }






    public function getTypeSponsor(): ?string
    {
        return $this->typeSponsor;
    }

    public function setTypeSponsor(?string $typeSponsor): self
    {
        $this->typeSponsor = $typeSponsor;

        return $this;
    }









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
