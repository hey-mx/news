<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \DateTime
     */
    private $createat;

    /**
     * @var \DateTime
     */
    private $verifiedat;

    /**
     * @var \DateTime
     */
    private $updateat;

    /**
     * @var boolean
     */
    private $status;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set createat
     *
     * @param \DateTime $createat
     * @return User
     */
    public function setCreateat($createat)
    {
        $this->createat = $createat;

        return $this;
    }

    /**
     * Get createat
     *
     * @return \DateTime 
     */
    public function getCreateat()
    {
        return $this->createat;
    }

    /**
     * Set verifiedat
     *
     * @param \DateTime $verifiedat
     * @return User
     */
    public function setVerifiedat($verifiedat)
    {
        $this->verifiedat = $verifiedat;

        return $this;
    }

    /**
     * Get verifiedat
     *
     * @return \DateTime 
     */
    public function getVerifiedat()
    {
        return $this->verifiedat;
    }

    /**
     * Set updateat
     *
     * @param \DateTime $updateat
     * @return User
     */
    public function setUpdateat($updateat)
    {
        $this->updateat = $updateat;

        return $this;
    }

    /**
     * Get updateat
     *
     * @return \DateTime 
     */
    public function getUpdateat()
    {
        return $this->updateat;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
