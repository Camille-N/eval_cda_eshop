<?php

namespace Eshop\Repository;

use Eshop\Model\User;
use Simplex\Service\Hydrator;

class UserManager
{
    private ?\PDO $db;

    public function __construct()
    {
        $this->db = (new DBA())->getPDO();
    }

    public function create(User $user)
    {
        try {
            $statement = $this->db->prepare(
                "INSERT INTO `user` (firstName, lastName, email, encryptedPassword) VALUES " .
                    " (:firstName, :lastName, :email, :encryptedPassword) "
            );
            $statement->bindValue('firstName', $user->getFirstName());
            $statement->bindValue('lastName', $user->getLastName());
            $statement->bindValue('email', $user->getEmail());
            $statement->bindValue('encryptedPassword', $user->getEncryptedPassword());

            $statement->execute();
        } catch (\PDOException $exception) {
            dd($exception);
        }
    }

    public function findByEmail(string $email)
    {
        $statement = $this->db->prepare(
            "SELECT * FROM user WHERE email=:email LIMIT 1"
        );
        $statement->bindValue('email', $email);
        $statement->execute();
        $userData = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$userData) return false;

        return Hydrator::hydrate(User::class, $userData);
    }

    public function updateProfile(User $profile)
    {
        $UP_PROFILE = $this->db->prepare('
        UPDATE user 
        SET firstName=:firstName, lastName=:lastName, email=:email, encryptedPassword=:encryptedPassword WHERE id=:id');
        $UP_PROFILE->bindValue(':firstName', $profile->getFirstName());
        $UP_PROFILE->bindValue(':lastName', $profile->getLastName());
        $UP_PROFILE->bindValue(':email', $profile->getEmail());
        $UP_PROFILE->bindValue(':encryptedPassword', $profile->getEncryptedPassword());
        $UP_PROFILE->bindValue(':id', $profile->getId());
        $UP_PROFILE->execute();
    }
}
