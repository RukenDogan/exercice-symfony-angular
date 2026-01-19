<?php

namespace App\Service;

class UserService
{
    public function calculateAge(?\DateTimeInterface $birthDate): ?int
    {
        if ($birthDate === null) {
            return null;
        }

        return $birthDate->diff(new \DateTime())->y;
    }
}
