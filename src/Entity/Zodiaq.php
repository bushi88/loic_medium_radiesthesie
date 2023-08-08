<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ZodiaqRepository;
use App\Entity\Traits\CreatedAtTrait;

#[ORM\Entity(repositoryClass: ZodiaqRepository::class)]
class Zodiaq
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sign = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $traits = null;

    #[ORM\Column(length: 3)]
    private ?string $lang = 'fr';

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSign(): ?string
    {
        return $this->sign;
    }

    public function setSign(string $sign): static
    {
        $this->sign = $sign;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTraits(): ?string
    {
        return $this->traits;
    }

    public function setTraits(string $traits): static
    {
        $this->traits = $traits;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): static
    {
        $this->lang = $lang;

        return $this;
    }
}