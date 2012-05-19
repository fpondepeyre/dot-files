<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dyt\WebsiteBundle\Form\LabelType;
use Dyt\WebsiteBundle\Model\StudentQuery;


/**
 * Label controller.
 *
 * @Route("/label")
 */
class LabelController extends Controller
{
    /**
     * Index actio
     *
     * @param \Dyt\WebsiteBundle\Controller\Request $request
     * @todo refactor
     *
     * @Route   ("/", name="label")
     * @Template()
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $data = array('zone1' => 'zone 1', 'zone2' => 'zone 2');
        $form = $this->createForm(new LabelType());

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $data = $this->generateData($form->getData());
            }
        }

        return array(
            'data' => $data,
            'form' => $form->createView()
        );
    }

    /**
     * Genearate data
     * @todo refactor
     *
     * @param $zones
     * @return array
     */
    private function generateData($zones)
    {
        $this->getChoiceZones()
        $student = StudentQuery::create()->findOne();

        foreach($zones as $key => $zone) {
            switch($zone) {
                case 'name':
                    $data[$key] = $student->getLastName();
                    break;
                case 'initial':
                    $data[$key] = substr($student->getLastName(),0,1);
                    break;
            }
        }

        return $data;
    }

} //LabelController
