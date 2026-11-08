<?php

namespace Entity;

use DateTime;
use JsonSerializable;

final class User implements JsonSerializable
{
    private int $id;
    private string $name;
    private string $email;

    private string $message;
    private string $contactNumber;
    private bool $isDeleted;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function setIsDeleted(bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;

    }

    public function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        //hmmmm I think , We should enforce this as DB level though... We shall see
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getContactNumber(): string
    {
        return $this->contactNumber;
    }

    public function setContactNumber(string $contactNumber): void
    {
        $this->contactNumber = $contactNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'is_deleted' => $this->isDeleted,
            'contact_number' => $this->contactNumber,
            'message' => $this->message
        ];
    }
}