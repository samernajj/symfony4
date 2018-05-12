<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Bundle\FrameworkBundle\Client;

class CompanyControllerTest extends WebTestCase
{


    /**
     * company lists
     */
    public function testIndex()
    {
        $client = static::createClient();
        $client->followRedirects();
        /** return list of companies  */
        $client->request('GET', '/company');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    /**
     * add new company
     */
    public function testNew()
    {
        $client = static::createClient();
        $client->followRedirects();

        /** create new company */
        $client->request('POST', '/company/new', array('name' => 'Test Company', 'address'=>'Amman'));
        $this->assertEquals(201, $client->getResponse()->getStatusCode());

        /** create new company with same name  */
        $client->request('POST', '/company/new', array('name' => 'Test Company', 'address'=>'Amman'));
        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }

    /** show company */
    public function testShow()
    {
        $client = static::createClient();
        $client->followRedirects();

        /** get valid company */
        $client->request('GET', '/company/3');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        /** get invalid company */
        $client->request('GET', '/company/100');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

    }


    /**
     * edit company
     */
    public function testEdit()
    {
        $client = static::createClient();
        $client->followRedirects();

        /** edit valid company */
        $client->request('post', '/company/3/edit', array('name' => 'Test Company Edited', 'address'=>'Amman'));
        $this->assertEquals(202, $client->getResponse()->getStatusCode());

        /** edit invalid company */
        $client->request('post', '/company/100/edit', array('name' => 'Test Company Edited', 'address'=>'Amman'));
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        return View::create("Deleted", Response::HTTP_NO_CONTENT, []);
    }

    public function testDelete(){
        $client = static::createClient();
        $client->followRedirects();

        /** delete valid company */
        $client->request('delete', '/company/3');
        $this->assertEquals(204, $client->getResponse()->getStatusCode());

        /** delete invalid company */
        $client->request('delete', '/company/100');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
