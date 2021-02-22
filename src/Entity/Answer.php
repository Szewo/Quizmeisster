<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answers")
     */
    private $questionID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answerBody;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCorrect;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionID(): ?Question
    {
        return $this->questionID;
    }

    public function setQuestionID(?Question $questionID): self
    {
        $this->questionID = $questionID;

        return $this;
    }

    public function getAnswerBody(): ?string
    {
        return $this->answerBody;
    }

    public function setAnswerBody(string $answerBody): self
    {
        $this->answerBody = $answerBody;

        return $this;
    }

    public function getIsCorrect(): ?bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): self
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }
}
