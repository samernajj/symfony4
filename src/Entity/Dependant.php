<?php
/**
 * Created by PhpStorm.
 * User: snajjar
 * Date: 5/11/18
 * Time: 11:17 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity
 * @ORM\Table(name="dependant")
 * @UniqueEntity("name")
 */
class Dependant extends StaffMember
{
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $relation_to_employee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="dependants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    /**
     * @return mixed
     */
    public function getRelationToEmployee()
    {
        return $this->relation_to_employee;
    }

    /**
     * @param mixed $relation_to_employee
     */
    public function setRelationToEmployee($relation_to_employee): void
    {
        $this->relation_to_employee = $relation_to_employee;
    }


    /**
     * @return Employee|null
     */
    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }


    /**
     * @param Employee|null $employee
     * @return Dependant
     */
    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }


}