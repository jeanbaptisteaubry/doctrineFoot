<?php

namespace App\Entity;

use ClubSupporter;
use Coach;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use Stade;

#[Entity]
#[Table(name: 'EQUIPE')]
class Equipe
{
    #[Id, Column(type: 'integer'), GeneratedValue]
    private int|null $id = null;

    #[Column(type: 'string')]
    private string $denomination;

    /** @var Collection<int, Equipe> */
    #[OneToMany(targetEntity: Joueur::class, mappedBy: 'equipe', indexBy: 'id')]
    private Collection $joueurs;

    /** @var Collection<int, ClubSupporter> */
    #[OneToMany(targetEntity: ClubSupporter::class, mappedBy: 'equipe', indexBy: 'id')]
    private Collection $clubSupporters;

    #[ManyToOne(targetEntity: Stade::class, inversedBy: 'equipes')]
    private Stade $stade;

    #[OneToOne(targetEntity: Coach::class, inversedBy: 'equipe') ,Column(type: 'integer',nullable: true)]
    private ?Coach $coach= null;

    public function __construct(string $denomination, Stade $stade)
    {
        $this->denomination = $denomination;
        $this->stade = $stade;
        $this->joueurs = new ArrayCollection();
        $this->clubSupporters = new ArrayCollection();
    }
    public function getId(): int|null
    {
        return $this->id;
    }

    public function getDenomination(): string
    {
        return $this->denomination;
    }

    public function addJoueur(Joueur $joueur): void
    {
        $this->joueurs[] = $joueur;
    }

    /** @return array<int, Joueur> */
    public function getJoueurs(): array
    {
        return $this->joueurs->toArray();
    }

    public function getStade(): Stade
    {
        return $this->stade;
    }

    public function getCoach(): Coach|null
    {
        return $this->coach;
    }

    public function getClubSupporters(): Collection
    {
        return $this->clubSupporters;
    }

    public function removeJoueur(Joueur $joueur): void
    {
        $this->joueurs->removeElement($joueur);
    }

   public function setCoach(Coach $coach): void
    {
        $memoCoach = $this->coach;
        $this->coach = $coach;
        if($memoCoach !== null){
            $memoCoach->setEquipe(null);
        }
        $this->coach = $coach;

    }

    public function addClubSupporter(ClubSupporter $clubSupporter): void
    {
        $this->clubSupporters[] = $clubSupporter;
    }

    public function removeClubSupporter(ClubSupporter $clubSupporter): void
    {
        $this->clubSupporters->removeElement($clubSupporter);
    }

    public function setStade(Stade $stade): void
    {
        if($this->stade !== $stade) {
            if ($this->stade !== null) {
                $this->stade->supprimerEquipe($this);
            }
            $this->stade = $stade;

            if($stade !== null) {
                $stade->ajouterEquipe($this);
            }
        }
    }
}