<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'comments')]
    private Collection $author;

    #[ORM\ManyToMany(targetEntity: Episode::class, inversedBy: 'comments')]
    private Collection $episode_id;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?int $rate = null;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->episode_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(User $author): self
    {
        if (!$this->author->contains($author)) {
            $this->author->add($author);
        }

        return $this;
    }

    public function removeAuthor(User $author): self
    {
        $this->author->removeElement($author);

        return $this;
    }

    /**
     * @return Collection<int, Episode>
     */
    public function getEpisodeId(): Collection
    {
        return $this->episode_id;
    }

    public function addEpisodeId(Episode $episodeId): self
    {
        if (!$this->episode_id->contains($episodeId)) {
            $this->episode_id->add($episodeId);
        }

        return $this;
    }

    public function removeEpisodeId(Episode $episodeId): self
    {
        $this->episode_id->removeElement($episodeId);

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
