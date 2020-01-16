<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $author_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $positive_rating;

    /**
     * @ORM\Column(type="integer")
     */
    private $negative_rating;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp_created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp_updated;

    /**
     * @ORM\Column(type="integer")
     */
    private $object_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthorId(): ?int
    {
        return $this->author_id;
    }

    public function setAuthorId(int $author_id): self
    {
        $this->author_id = $author_id;

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

    public function getTimestampCreated(): ?\DateTimeInterface
    {
        return $this->timestamp_created;
    }

    public function setTimestampCreated(\DateTimeInterface $timestamp_created): self
    {
        $this->timestamp_created = $timestamp_created;

        return $this;
    }

    public function getTimestampUpdated(): ?\DateTimeInterface
    {
        return $this->timestamp_updated;
    }

    public function setTimestampUpdated(\DateTimeInterface $timestamp_updated): self
    {
        $this->timestamp_updated = $timestamp_updated;

        return $this;
    }

    public function getObjectId(): ?int
    {
        return $this->object_id;
    }

    public function setObjectId(int $object_id): self
    {
        $this->object_id = $object_id;

        return $this;
    }
    public function getPositiveRating(): ?int
    {
        return $this->positive_rating;
    }

    public function setPositiveRating(int $positive_rating): self
    {
        $this->positive_rating = $positive_rating;

        return $this;
    }
    public function getNegativeRating(): ?int
    {
        return $this->negative_rating;
    }

    public function setNegativeRating(int $negative_rating): self
    {
        $this->negative_rating = $negative_rating;

        return $this;
    }
}
