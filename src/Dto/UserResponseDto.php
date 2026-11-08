<?php

namespace Dto;

use JsonSerializable;
use stdClass;

class UserResponseDto implements JsonSerializable
{
    function __construct(
        public int $id,
        public string $name,
        public string     $email,
        public string     $contact_number,
        public string     $message,
        public ?bool     $is_deleted = false,
    )
    {

    }

    public static function fromEntity(int $id, UserDto $user): self
    {
        return new self(
            id: $id ?? throw new \LogicException('User does not exist'),
            name: $user->name ,
            email: $user->email ,
            contact_number: $user->contact_number ,
            message: $user->message,
            is_deleted: $user->is_deleted,
        );

    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'contactNumber' => $this->contact_number ,
            'message' => $this->message,
            'isDeleted' => $this->is_deleted,
        ];
    }
}