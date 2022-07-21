<?php

namespace App\Entity;

use App\DBAL\Types\TechnoType;
use App\Repository\TechnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;

#[ORM\Entity(repositoryClass: TechnoRepository::class)]
class Techno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'TechnoType')]
    #[DoctrineAssert\EnumType(entity: TechnoType::class)]
    private string $front_back;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\ManyToMany(targetEntity: Realisation::class, mappedBy: 'technos')]
    private Collection $realisations;

    public function __construct()
    {
        $this->realisations = new ArrayCollection();
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

    public function getFrontBack(): ?string
    {
        return $this->front_back;
    }

    public function setFrontBack(string $front_back): self
    {
        TechnoType::assertValidChoice($front_back);
        $this->front_back = $front_back;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    /**
     * @return Collection<int, Realisation>
     */
    public function getRealisations(): Collection
    {
        return $this->realisations;
    }

    public function addRealisation(Realisation $realisation): self
    {
        if (!$this->realisations->contains($realisation)) {
            $this->realisations[] = $realisation;
            $realisation->addTechno($this);
        }

        return $this;
    }

    public function removeRealisation(Realisation $realisation): self
    {
        if ($this->realisations->removeElement($realisation)) {
            $realisation->removeTechno($this);
        }

        return $this;
    }
}
