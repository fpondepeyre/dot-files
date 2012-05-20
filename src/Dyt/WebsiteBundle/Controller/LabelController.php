<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dyt\WebsiteBundle\Model\StudentQuery;


/**
 * Label controller.
 *
 * @Route("/label")
 */
class LabelController extends Controller
{
    /**
     * Index action
     *
     * @param \Dyt\WebsiteBundle\Controller\Request $request
     * @param                                       $name
     *
     * @todo    refactor
     *
     * @Route   ("/{name}/template", name="label")
     * @Template()
     *
     * @return array
     */
    public function indexAction(Request $request, $name)
    {
        $data = array('zone1' => 'zone 1', 'zone2' => 'zone 2');

        $formClass = '\Dyt\WebsiteBundle\Form\Label'.ucfirst($name).'Type';
        $form = $this->createForm(new $formClass());

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $data = $this->generateData($form->getData());
            }
        }

        return array(
            'name' => $name,
            'data' => $data,
            'form' => $form->createView()
        );
    }

    /**
     * Choice action
     *
     * @param \Dyt\WebsiteBundle\Controller\Request $request
     * @todo refactor
     *
     * @Route   ("/choices", name="choices_label")
     * @Template()
     *
     * @return array
     */
    public function choicesAction(Request $request)
    {
        return array();
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
        $data = array();
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
