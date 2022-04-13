<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReponseReclam
 *
 * @ORM\Table(name="reponse_reclam", indexes={@ORM\Index(name="id_rec", columns={"id_rec"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class ReponseReclam
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_answer", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAnswer;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=20, nullable=false)
     */
    private $content;

    /**
     * @var \Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rec", referencedColumnName="id_rec")
     * })
     */
    private $idRec;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    public function getIdAnswer(): ?int
    {
        return $this->idAnswer;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getIdRec(): ?Reclamation
    {
        return $this->idRec;
    }

    public function setIdRec(?Reclamation $idRec): self
    {
        $this->idRec = $idRec;

        return $this;
    }

    public function getId(): ?User
    {
        return $this->id;
    }

    public function setId(?User $id): self
    {
        $this->id = $id;

        return $this;
    }


}
