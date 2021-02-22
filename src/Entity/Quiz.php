<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizRepository::class)
 */
class Quiz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="quizzes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ownerID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quizTitle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="quizzes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryID;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPending;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="quiz", orphanRemoval=true)
     */
    private $question;


    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->question = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwnerID(): ?User
    {
        return $this->ownerID;
    }

    public function setOwnerID(?User $ownerID): self
    {
        $this->ownerID = $ownerID;

        return $this;
    }

    public function getQuizTitle(): ?string
    {
        return $this->quizTitle;
    }

    public function setQuizTitle(string $quizTitle): self
    {
        $this->quizTitle = $quizTitle;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCategoryID(): ?Category
    {
        return $this->categoryID;
    }

    public function setCategoryID(?Category $categoryID): self
    {
        $this->categoryID = $categoryID;

        return $this;
    }

    public function getIsPending(): ?bool
    {
        return $this->isPending;
    }

    public function setIsPending(bool $isPending): self
    {
        $this->isPending = $isPending;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->question->contains($question)) {
            $this->question[] = $question;
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->question->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }

}
