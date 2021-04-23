<?php

namespace Eshop\Model;

class User
{
    private int $id;

    private string $email;

    /**
     * @var string Do not store in DB. This is plain password
     * Used only during processing
     */
    private string $password = '';

    /**
     * @var string To store in DB
     */
    private string $encryptedPassword;

    private string $firstName;

    private string $lastName;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        if ($password !== '') {
            $this->encryptPassword();
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getEncryptedPassword(): string
    {
        return $this->encryptedPassword;
    }

    /**
     * @param string $encryptedPassword
     * @return User
     */
    public function setEncryptedPassword(string $encryptedPassword): User
    {
        $this->encryptedPassword = $encryptedPassword;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    private function encryptPassword(): User
    {
        $this->encryptedPassword = password_hash($this->getPassword(), PASSWORD_BCRYPT);

        return $this;
    }

    public function verifyPassword($plainPassword): bool
    {
        return password_verify($plainPassword, $this->getEncryptedPassword());
    }
}
