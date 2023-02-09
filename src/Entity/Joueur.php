<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'JOUEUR')]
class Joueur
{
    #[Id, Column(type: 'integer'), GeneratedValue]
    private int|null $id = null;

    #[Column(type: 'string')]
    private string $nom;

    #[Column(type: 'string')]
    private string $prenom;

    #[Column(type: 'integer')]
    private int $maillot;


    #[ManyToOne(targetEntity: Equipe::class, inversedBy: 'joueurs'), Column(nullable: true)]
    private ?Equipe $equipe = null;

    public function __construct(string $nom, string $prenom, int $maillot, Equipe $equipe)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->maillot = $maillot;
        $this->equipe = $equipe;
        $equipe->addJoueur($this);
    }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }


    public function getMaillot(): int
    {
        return $this->maillot;
    }

    public function getEquipe(): Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(Equipe $equipe): void
    {
        $this->equipe->removeJoueur($this);
        $this->equipe = $equipe;
    }

    public function setMaillot(int $maillot): void
    {
        $this->maillot = $maillot;
    }


}