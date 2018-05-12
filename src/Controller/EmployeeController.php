<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Employee;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * @Route("/employee")
 */
class EmployeeController extends Controller
{
    /**
     * employee list
     * @FOSRest\Get("/")
     * @return View
     */
    public function index(): View
    {
        $employees = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findAll();

        return View::create($employees, Response::HTTP_OK, []);
    }

    /**
     * add new employee
     * @FOSRest\Post("/new")
     * @param Request $request
     * @return View
     */
    public function new(Request $request): View
    {
        /** check if company exist */
        $company = NULL;
        if ($request->get('company_name')) {
            $company = $this->getDoctrine()
                ->getRepository(Company::class)
                ->findOneByName($request->get('company_name'));
        }
        /** add new company */
        if (!$company) {
            $company = new Company();
            $company->setName($request->get('company_name'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();
        }

        /** add employee */
        $employee = new Employee();
        $employee->setName($request->get('name'));
        $employee->setDateOfBirth(new \DateTime($request->get('date_of_birth')));
        $employee->setGender($request->get('gender'));
        $employee->setPhoneNumber($request->get('phone_number'));
        $employee->setSalary($request->get('salary'));
        $employee->setCompany($company);

        $em = $this->getDoctrine()->getManager();
        $em->persist($employee);
        $em->flush();

        return View::create($employee, Response::HTTP_CREATED, []);
    }

    /**
     * get employee by id
     * @FOSRest\Get("/{id}")
     * @param Employee $employee
     * @return View
     */
    public function show(Employee $employee): View
    {
        return View::create($employee, Response::HTTP_OK, []);
    }


    /**
     * edit employee
     * @FOSRest\Post("/{id}/edit")
     * @param Request $request
     * @param Employee $employee
     * @return View
     */
    public function edit(Request $request, Employee $employee): View
    {
        /** check if company exist */
        $company = NULL;
        if ($request->get('company_name')) {
            $company = $this->getDoctrine()
                ->getRepository(Company::class)
                ->findOneByName($request->get('company_name'));
        }
        /** add new company */
        if (!$company) {
            $company = new Company();
            $company->setName($request->get('company_name'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();
        }

        /** edit employee */
        $employee->setName($request->get('name'));
        $employee->setDateOfBirth(new \DateTime($request->get('date_of_birth')));
        $employee->setGender($request->get('gender'));
        $employee->setPhoneNumber($request->get('phone_number'));
        $employee->setSalary($request->get('salary'));
        $employee->setCompany($company);

        $em = $this->getDoctrine()->getManager();
        $em->persist($employee);
        $em->flush();
        return View::create($employee, Response::HTTP_ACCEPTED, []);
    }

    /**
     * delete employee
     * @FOSRest\Delete("/{id}")
     * @param Employee $employee
     * @return View
     */
    public function delete(Employee $employee): View
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($employee);
        $em->flush();

        return View::create("Deleted", Response::HTTP_NO_CONTENT, []);
    }
}
