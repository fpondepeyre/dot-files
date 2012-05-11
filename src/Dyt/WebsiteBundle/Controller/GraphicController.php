<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Student controller.
 *
 * @Route("/graphic")
 */
class GraphicController extends Controller
{
    /**
     * Display graphic.
     *
     * @Route("/", name="graphic")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

} //GraphicController
