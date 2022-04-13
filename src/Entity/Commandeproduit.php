<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commandeproduit
 *
 * @ORM\Table(name="commandeproduit", indexes={@ORM\Index(name="productconstraint", columns={"productID"}), @ORM\Index(name="orderID", columns={"orderID"})})
 * @ORM\Entity
 */
class Commandeproduit
{
    /**
     * @var int
     *
     * @ORM\Column(name="cpID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cpid;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="sommePrix", type="integer", nullable=false)
     */
    private $sommeprix;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="productID", referencedColumnName="productID")
     * })
     */
    private $productid;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="orderID", referencedColumnName="orderID")
     * })
     */
    private $orderid;

    public function getCpid(): ?int
    {
        return $this->cpid;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getSommeprix(): ?int
    {
        return $this->sommeprix;
    }

    public function setSommeprix(int $sommeprix): self
    {
        $this->sommeprix = $sommeprix;

        return $this;
    }

    public function getProductid(): ?Produit
    {
        return $this->productid;
    }

    public function setProductid(?Produit $productid): self
    {
        $this->productid = $productid;

        return $this;
    }

    public function getOrderid(): ?Commande
    {
        return $this->orderid;
    }

    public function setOrderid(?Commande $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
    }


}
