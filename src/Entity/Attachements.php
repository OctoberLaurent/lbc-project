<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttachementsRepository")
 */
class Attachements
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Media", inversedBy="attachements")
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads", inversedBy="attachements")
     */
    private $ad;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(?Media $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getAd(): ?Ads
    {
        return $this->ad;
    }

    public function setAd(?Ads $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
