<?php

namespace Validator;

class UserDetailsValidator
{

    private array $data;
    function __construct(array $data)
    {
        $this->data = $data;

    }
public function validate(): array
{
    $validationErrors = [];
    foreach($this->data as $key => $value)
    {
        switch ($key)
        {
            case 'name':
                $trimmedName = is_string($value) ? trim($value): '';
                   if ($trimmedName === '') {
                       $validationErrors[$key][] =  "Name cannot be empty";
                   }
                    else if (mb_strlen($trimmedName) < 3) {
                        $validationErrors[$key][] = "Name must be at least 3 characters long";
                    }
                    else if (mb_strlen($trimmedName) > 20) {
                        $validationErrors[$key][] = "Name must be at most 20 characters long";
                    }
                break;

            case 'email':
                $trimmedEmail = is_string($value) ? trim($value): '';
                if ($trimmedEmail === '') {
                    $validationErrors[$key][] =  "Email cannot be empty";
                }
                else if (!filter_var($trimmedEmail, FILTER_VALIDATE_EMAIL)) {
                    $validationErrors[$key][] = "Email is not valid";
                }
                break;
            case 'contactNumber':
                $trimmedPhone = is_string($value) ? trim($value): '';
                if ($trimmedPhone === '') {
                    $validationErrors[$key][] =  "Contact number cannot be empty";
                } else if (!preg_match('/^(?:\+27|0)[6-8][0-9]{8}$/',$trimmedPhone)){
                    $validationErrors[$key][] = "Contact number must be a valid South African number";
                }
                break;
            case 'message':
                $trimmedMessage = is_string($value) ? trim($value): '';
                if ($trimmedMessage === '') {
                    $validationErrors[$key][] =  "Message cannot be empty";
                }else if(mb_strlen($trimmedMessage) > 255){
                    $validationErrors[$key][] = "Message must be less than 255 characters";
                }else if(mb_strlen($trimmedMessage) < 10){
                    $validationErrors[$key][] = "Message must be at least 10 characters";
                }
                break;
        }


    }
    return $validationErrors;
}

}