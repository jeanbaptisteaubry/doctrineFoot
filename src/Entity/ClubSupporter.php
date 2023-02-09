<?php

use App\Entity\Equipe;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'ClubSupporter')]
class ClubSupporter
{
    #[Id, Column(type: 'integer'), GeneratedValue]
    private int|null $id = null;

    #[Column(type: 'string')]
    private string $titre;

    #[Column(type: 'date')]
    private DateTime $dateCreation;

    #[ManyToOne(targetEntity: Equipe::class, inversedBy: 'clubSupporters')]
    private Equipe $equipe;

    public function __construct(string $titre, DateTime $dateCreation, Equipe $equipe)
    {
        $this->titre = $titre;
        $this->dateCreation = $dateCreation;
        $this->equipe = $equipe;
        $equipe->addClubSupporter($this);
    }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getDateCreation(): DateTime
    {
        return $this->dateCreation;
    }

    public function getEquipe(): Equipe
    {
        return $this->equipe;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

}