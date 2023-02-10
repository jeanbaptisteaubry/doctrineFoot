<?php
namespace App\Entity;
use App\Entity\Equipe;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'Coach')]
class Coach
{
    #[Id, Column(type: 'integer'), GeneratedValue]
    private int|null $id = null;

    #[Column(type: 'string')]
    private string $nom;

    #[Column(type: 'string')]
    private string $prenom;

    #[OneToOne(targetEntity: Equipe::class, inversedBy: 'coach'), JoinColumn(name: "equipe_id", referencedColumnName: "id", nullable: true)]
    private ?Equipe $equipe;

    public function __construct(string $nom, string $prenom, ?Equipe $equipe)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->equipe = $equipe;
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

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): void
    {
        $memoEquipe = $this->equipe;
        $this->equipe = $equipe;
        if($memoEquipe !== null){
            $memoEquipe->setCoach(null);
        }
        $this->equipe = $equipe;

    }

}