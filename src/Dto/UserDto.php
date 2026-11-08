<?php

namespace Dto;

use JsonSerializable;

final readonly class UserDto implements JsonSerializable
{
    function __construct(
       public string $name,
       public string $email,
       public string $contact_number,
       public string $message,
        public bool $is_deleted
    )
    {
    }

    public static function fromArray(array $data): self
    {
      return new self(
            name: trim($data['name'] ?? ''),
            email: trim($data['email'] ?? '') ,
            contact_number: trim($data['contact_number'] ?? ''),
            message: trim($data['message'] ?? '',),
            is_deleted: $data['is_deleted'] ?? false,

      );

    }

    public function jsonSerialize(): array
    {
        return [
            'name'          => $this->name,
            'email'         => $this->email,
            'contact_number' => $this->contact_number,
            'message'       => $this->message,
            'is_deleted'    => $this->is_deleted,
        ];
    }
}