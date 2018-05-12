<?php

namespace App\Controller;

use App\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * @Route("/company")
 */
class CompanyController extends Controller
{

    /**
     * company lists
     * @FOSRest\Get("/")
     * @return View
     */
    public function index(): View
    {
        $companies = $this->getDoctrine()
            ->getRepository(Company::class)
            ->findAll();

        return View::create($companies, Response::HTTP_OK, []);
    }


    /**
     * add new company
     * @FOSRest\Post("/new")
     * @param Request $request
     * @return View
     */
    public function new(Request $request): View
    {
        $company = new Company();
        $company->setName($request->get('name'));
        $company->setAddress($request->get('address'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($company);
        $em->flush();
        return View::create($company, Response::HTTP_CREATED, []);
    }


    /**
     * show company by id
     * @FOSRest\Get("/{id}")
     * @param Company $company
     * @return View
     */
    public function show(Company $company): View
    {
        return View::create($company, Response::HTTP_OK, []);
    }


    /**
     * edit company
     * @FOSRest\Post("/{id}/edit")
     * @param Request $request
     * @param Company $company
     * @return View
     */
    public function edit(Request $request, Company $company): View
    {
        $company->setName($request->get('name'));
        $company->setAddress($request->get('address'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($company);
        $em->flush();
        return View::create($company, Response::HTTP_ACCEPTED, []);
    }


    /**
     * delete company
     * @FOSRest\Delete("/{id}")
     * @param Company $company
     * @return View
     */
    public function delete(Company $company): View
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($company);
        $em->flush();

        return View::create("Deleted", Response::HTTP_NO_CONTENT, []);
    }
}
