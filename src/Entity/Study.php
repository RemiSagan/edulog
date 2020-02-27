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
     * @ORM\Column(type="smallint")
     */
    private $duration;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Specialty", mappedBy="study")
     */
    private $specialty;

    public function __construct()
    {
        $this->specialty = new ArrayCollection();
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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection|Specialty[]
     */
    public function getSpecialty(): Collection
    {
        return $this->specialty;
    }

    public function addSpecialty(Specialty $specialty): self
    {
        if (!$this->specialty->contains($specialty)) {
            $this->specialty[] = $specialty;
            $specialty->setStudy($this);
        }

        return $this;
    }

    public function removeSpecialty(Specialty $specialty): self
    {
        if ($this->specialty->contains($specialty)) {
            $this->specialty->removeElement($specialty);
            // set the owning side to null (unless already changed)
            if ($specialty->getStudy() === $this) {
                $specialty->setStudy(null);
            }
        }

        return $this;
    }
}
