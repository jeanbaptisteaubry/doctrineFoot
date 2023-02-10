<?php
namespace App\Entity;

use App\Entity\Equipe;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'Stade')]
class Stade
{
    #[Id, Column(type: 'integer'), GeneratedValue]
    private int|null $id = null;

    #[Column(type: 'string')]
    private string $libelle;

    #[OneToMany(targetEntity: Equipe::class, mappedBy: 'stade', indexBy: 'id')]
    private Collection $equipes;

    public function __construct(string $libelle)
    {
        $this->libelle = $libelle;
        $this->equipes = new ArrayCollection();
    }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function ajouterEquipe(Equipe $equipe): void
    {
        $this->equipes->add($equipe);
    }

    public function supprimerEquipe(Equipe $equipe): void
    {
        $this->equipes->removeElement($equipe);
        $equipe->setStade(null);
    }


}