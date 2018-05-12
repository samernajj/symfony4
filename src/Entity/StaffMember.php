<?php
/**
 * Created by PhpStorm.
 * User: snajjar
 * Date: 5/12/18
 * Time: 1:53 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class StaffMember
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $name;
    /**
     * @Assert\Regex(pattern="/^\(0\)[0-9]*$", message="number_only")
     * @ORM\Column(type="string", length=50)
     */
    protected $phone_number;
    /**
     * @ORM\Column(type="string")
     */
    protected $gender;
    /**
     * @ORM\Column(type="date")
     */
    protected $date_of_birth;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        if (!in_array($gender, array(self::GENDER_MALE, self::GENDER_FEMALE))) {
            throw new \InvalidArgumentException("Invalid gender");
        }
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    /**
     * @param mixed $date_of_birth
     */
    public function setDateOfBirth($date_of_birth): void
    {
        $this->date_of_birth = $date_of_birth;
    }

}