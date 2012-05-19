<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Label controller.
 *
 * @Route("/label")
 */
class LabelController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return array();
    }

} //LabelController
