<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dyt\WebsiteBundle\Model\StudentQuery;
use Dyt\WebsiteBundle\Form\Service\LabelTypeFactory;

use Dyt\WebsiteBundle\Model\ClassroomQuery;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementFactory;
use Dyt\WebsiteBundle\Model\Classroom;

/**
 * Label controller.
 *
 * @Route("/label")
 */
class LabelController extends Controller
{
    /**
     * Label editor
     *
     * @param \Dyt\WebsiteBundle\Controller\Request $request
     * @param string                                $name
     *
     * @Route   ("/{name}/template", name="label")
     * @Template()
     *
     * @return array
     */
    public function indexAction(Request $request, $name)
    {
        $classroom = ClassroomQuery::create()->findOne();

        // @todo refactor it
        $data = array(
            'zone1' => 'zone 1',
            'zone2' => 'zone 2',
            'zone3' => 'zone 3',
            'zone5' => 'zone 5'
        );

        $formClass = LabelTypeFactory::getLabelType($name);
        $form = $this->createForm($formClass);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $data = $this->generateData($form->getData(), $classroom);
            }
        }

        return array(
            'name' => $name,
            'data' => $data,
            'form' => $form->createView()
        );
    }

    /**
     * Choose the template to configure
     *
     * @param \Dyt\WebsiteBundle\Controller\Request $request
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
     * Genearate data for label
     *
     * @param array                              $zones
     * @param \Dyt\WebsiteBundle\Model\Classroom $classroom
     *
     * @return array
     */
    private function generateData(array $zones = array(), Classroom $classroom)
    {
        foreach($zones as $key => $zone) {
            $labelElement = LabelElementFactory::getLabelElement($zone, $classroom);
            $data[$key] = $labelElement->renderElement();
        }

        return $data;
    }

} //LabelController
