<?php

namespace App\Controller;

use App\Entity\Dependant;
use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * @Route("/dependant")
 */
class DependantController extends Controller
{
    /**
     * dependant list
     * @FOSRest\Get("/")
     * @return View
     */
    public function index(): View
    {
        $dependants = $this->getDoctrine()
            ->getRepository(Dependant::class)
            ->findAll();

        return View::create($dependants, Response::HTTP_OK, []);
    }

    /**
     * add new dependant
     * @FOSRest\Post("/new")
     * @param Request $request
     * @return View
     */
    public function new(Request $request): View
    {
        /** check if employee exist */
        $employee = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->find($request->get('employee_id'));

        if (!$employee) {
            return View::create("employee does not exist", Response::HTTP_BAD_REQUEST, []);
        }

        /** add Dependant */
        $dependant = new Dependant();
        $dependant->setName($request->get('name'));
        $dependant->setDateOfBirth(new \DateTime($request->get('date_of_birth')));
        $dependant->setGender($request->get('gender'));
        $dependant->setPhoneNumber($request->get('phone_number'));
        $dependant->setRelationToEmployee($request->get('relation_to_employee'));
        $dependant->setEmployee($employee);
        $em = $this->getDoctrine()->getManager();
        $em->persist($dependant);
        $em->flush();

        return View::create($dependant, Response::HTTP_CREATED, []);
    }

    /**
     * show dependant by id
     * @FOSRest\Get("/{id}")
     * @param Dependant $dependant
     * @return View
     */
    public function show(Dependant $dependant): View
    {
        return View::create($dependant, Response::HTTP_OK, []);
    }

    /**
     * edit dependant
     * @FOSRest\Post("/{id}/edit")
     * @param Request $request
     * @param Dependant $dependant
     * @return View
     */
    public function edit(Request $request, Dependant $dependant): View
    {
        /** check if employee exist */
        $employee = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->find($request->get('employee_id'));

        if (!$employee) {
            return View::create("employee does not exist", Response::HTTP_BAD_REQUEST, []);
        }

        /** edit Dependant */
        $dependant->setName($request->get('name'));
        $dependant->setDateOfBirth(new \DateTime($request->get('date_of_birth')));
        $dependant->setGender($request->get('gender'));
        $dependant->setPhoneNumber($request->get('phone_number'));
        $dependant->setRelationToEmployee($request->get('relation_to_employee'));
        $dependant->setEmployee($employee);
        $em = $this->getDoctrine()->getManager();
        $em->persist($dependant);
        $em->flush();

        return View::create($employee, Response::HTTP_ACCEPTED, []);
    }

    /**
     * delete dependant
     * @FOSRest\Delete("/{id}")
     * @param Dependant $dependant
     * @return View
     */
    public function delete(Dependant $dependant): View
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($dependant);
        $em->flush();

        return View::create("Deleted", Response::HTTP_NO_CONTENT, []);
    }
}
