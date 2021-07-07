<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $text;

    /**
     * @ORM\Column(type="date")
     */
    private $datecreate;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idgroup;

    /**
     * @ORM\ManyToOne(targetEntity=member::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idmember;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDatecreate(): ?\DateTimeInterface
    {
        return $this->datecreate;
    }

    public function setDatecreate(\DateTimeInterface $datecreate): self
    {
        $this->datecreate = $datecreate;

        return $this;
    }

    public function getIdgroup(): ?Member
    {
        return $this->idgroup;
    }

    public function setIdgroup(?Member $idgroup): self
    {
        $this->idgroup = $idgroup;

        return $this;
    }

    public function getIdmember(): ?member
    {
        return $this->idmember;
    }

    public function setIdmember(?member $idmember): self
    {
        $this->idmember = $idmember;

        return $this;
    }
}
