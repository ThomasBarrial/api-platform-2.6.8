<?php
// api/src/Entity/Book.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A book. */
#[ORM\Entity]
#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'put', 'delete'],
)]
class Book
{
    /** The id of this book. */
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private int $id;

    /** The ISBN of this book (or null if doesn't have one). */
    #[ORM\Column(nullable: true)]
    #[Assert\Isbn]
    public ?string $isbn = null;

    /** The title of this book. */
    #[ORM\Column]
    #[Assert\NotBlank]
    public string $title = '';

    /** The description of this book. */
    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    public string $description = '';

    /** The author of this book. */
    #[ORM\Column]
    #[Assert\NotBlank]
    public string $author = '';

    /** The publication date of this book. */
    #[ORM\Column(type: "datetime")]
    #[Assert\NotNull]
    public ?\DateTimeInterface $publicationDate = null;

    /** @var Review[] Available reviews for this book. */
    #[ORM\OneToMany(mappedBy: 'book', targetEntity: 'Review', cascade: ['persist', 'remove'])]
    public iterable $reviews;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'books')]
    private $usersbook;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsersbook(): ?User
    {
        return $this->usersbook;
    }

    public function setUsersbook(?User $usersbook): self
    {
        $this->usersbook = $usersbook;

        return $this;
    }
}

?>