<?php
/**
 * Created by PhpStorm.
 * User: snajjar
 * Date: 5/11/18
 * Time: 10:26 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="employee")
 * @UniqueEntity("name")
 */
class Employee extends StaffMember
{

    /**
     * @ORM\Column(type="float")
     */
    private $salary;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dependant", mappedBy="employee")
     */
    private $dependants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="employees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * Employee constructor.
     */
    public function __construct()
    {
        $this->dependants = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return Collection|Dependant[]
     */
    public function getDependants(): Collection
    {
        return $this->dependants;
    }

    /**
     * @param Dependant $dependant
     * @return Employee
     */
    public function addDependant(Dependant $dependant): self
    {
        if (!$this->dependants->contains($dependant)) {
            $this->dependants[] = $dependant;
            $dependant->setEmployee($this);
        }

        return $this;
    }

    /**
     * @param Dependant $dependant
     * @return Employee
     */
    public function removeDependant(Dependant $dependant): self
    {
        if ($this->dependants->contains($dependant)) {
            $this->dependants->removeElement($dependant);
            // set the owning side to null (unless already changed)
            if ($dependant->getEmployee() === $this) {
                $dependant->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Company|null
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Company|null $company
     * @return Employee
     */
    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}