<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dyt\WebsiteBundle\Model\ClassroomQuery;
use Dyt\WebsiteBundle\Lib\ChartGenerator;

/**
 * Chart controller.
 *
 * @Route("/chart")
 */
class ChartController extends Controller
{
    /**
     * Index action
     *
     * @param int $id
     *
     * @Route("/{id}", name="chart", requirements={"id" = "\d+"})
     * @Template()
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return array
     */
    public function indexAction($id)
    {
        $classroom = ClassroomQuery::create()
            ->joinWith('Student')
            ->findPk($id);

        if (!$classroom) {
            throw $this->createNotFoundException(sprintf('The classroom (id: "%d") does not exist!', $id));
        }

        $chart = new ChartGenerator($classroom);

        return $chart->getData();
    }

}
