<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudyRepository")
 */
class Study
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Choice", mappedBy="study")
     */
    private $choice;

    public function __construct()
    {
        $this->choice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Choice[]
     */
    public function getChoice(): Collection
    {
        return $this->choice;
    }

    public function addChoice(Choice $choice): self
    {
        if (!$this->choice->contains($choice)) {
            $this->choice[] = $choice;
            $choice->setStudy($this);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): self
    {
        if ($this->choice->contains($choice)) {
            $this->choice->removeElement($choice);
            // set the owning side to null (unless already changed)
            if ($choice->getStudy() === $this) {
                $choice->setStudy(null);
            }
        }

        return $this;
    }
}
