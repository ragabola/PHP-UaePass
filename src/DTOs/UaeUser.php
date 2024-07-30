<?php

namespace Ragab\DTOs;

readonly class UaeUser
{
    public function __construct(
        public string $sub,
        public string $fullnameAR,
        public string $gender,
        public string $mobile,
        public string $lastnameEN,
        public string $fullnameEN,
        public ?string $uuid,
        public string $lastnameAR,
        public ?string $idn,
        public string $nationalityEN,
        public string $firstnameEN,
        public string $userType,
        public string $nationalityAR,
        public string $firstnameAR,
        public string $email
    )
    {
    }

    public static function fromUser(array $user)
    {
        return new self(
            $user['sub'],
            $user['fullnameAR'],
            $user['gender'],
            $user['mobile'],
            $user['lastnameEN'],
            $user['fullnameEN'],
            $user['uuid'],
            $user['lastnameAR'],
            $user['idn'],
            $user['nationalityEN'],
            $user['firstnameEN'],
            $user['userType'],
            $user['nationalityAR'],
            $user['firstnameAR'],
            $user['email']
        );
    }
}