<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dyt\WebsiteBundle\Model\StudentQuery;
use Dyt\WebsiteBundle\Form\Service\LabelTypeFactory;

use Dyt\WebsiteBundle\Model\ClassroomQuery;
use Dyt\WebsiteBundle\Model\LabelQuery;
use Dyt\WebsiteBundle\Model\ZoneQuery;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementFactory;
use Dyt\WebsiteBundle\Form\LabelCustomType;
use Dyt\WebsiteBundle\Lib\LabelElement\CustomElement;

use Dyt\WebsiteBundle\Model\Classroom;
use Dyt\WebsiteBundle\Model\Zone;
use Dyt\WebsiteBundle\Model\Label;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementBuilder;

/**
 * Label controller.
 *
 * @Route("/label")
 */
class LabelController extends Controller
{
    /**
     * List
     *
     * @Route    ("/list", name="label_list")
     * @Template ()
     *
     * @return array
     */
    public function listAction()
    {
        $labels = LabelQuery::create()->find();

        return array(
            'labels' => $labels
        );
    }

    /**
     * Label editor
     *
     * @param \Dyt\WebsiteBundle\Controller\Request $request
     * @param string                                $name
     *
     * @Route   ("/{name}/new", name="label_new")
     * @Template()
     *
     * @return array
     */
    public function newAction(Request $request, $name)
    {
        $data = array();
        $formClass = LabelTypeFactory::getLabelType($name);
        $form = $this->createForm($formClass);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $form = $form->getData();

                $classroom = ClassroomQuery::create()->findPk($form['classroom']);
                $this->generateData($form, $classroom);

                return $this->redirect($this->generateUrl('label_list'));
            }
        }

        return array(
            'name' => $name,
            'data' => $data,
            'form' => $form->createView()
        );
    }

    /**
     * Show label
     *
     * @param $id
     *
     * @Route    ("/{id}/show", name="label_show")
     * @Template ()
     *
     * @return array
     */
    public function showAction($id)
    {
        $label = LabelQuery::create()
            ->joinWith('Zone')
            ->findPk($id);

        $data = array();
        $labelElementBuilder = new LabelElementBuilder();

        foreach($label->getZones() as $zone) {
            $customElement = new CustomElement($label->getClassroom());
            $customElement->setTemplate($zone->getTemplate());
            $labelElementBuilder->setLabelElement($customElement);
            $data[$zone->getName()] = $labelElementBuilder->render();
        }

        return array(
            'name' => $label->getTemplate(),
            'data' => $data,
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
     * @todo refactor and rename, it's a process form method
     *
     * @param array                              $zones
     * @param \Dyt\WebsiteBundle\Model\Classroom $classroom
     *
     * @return array
     */
    private function generateData(array $zones = array(), Classroom $classroom)
    {
        $data = array();

        $label = new Label();
        $label->setName($zones['name']);
        $label->setClassroomId($zones['classroom']);
        $label->setTemplate('simple');
        $label->save();

        foreach($zones as $key => $zone) {
            if (strpos($key, 'zone') !== false) {
                $labelElement = LabelElementFactory::getLabelElement($zone, $classroom);

                $zone = ZoneQuery::create()
                    ->filterByLabel($label)
                    ->filterByName($key)
                    ->findOneOrCreate();

                $zone->setTemplate($labelElement->getTwigTemplate());
                $zone->save();
            }
        }

        return $data;
    }

    /**
     * Custom label editor
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param mixed                                     $zone
     *
     * @Route    ("/template/custom/{zone}", name="custom_label")
     * @Template ()
     *
     * @return array
     */
    public function customLabelAction(Request $request, $zone)
    {
        $data = array();
        $formClass = LabelTypeFactory::getLabelType('custom');
        $form = $this->createForm($formClass);

        $classroom = ClassroomQuery::create()->findOne();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $formData = $form->getData();
                $customElement = new CustomElement($classroom);
                $customElement->setTemplate($formData['template']);
                $data[$zone] = $customElement->renderElement();
            }
        }

        return array(
            'data' => $data,
            'zone' => $zone,
            'form' => $form->createView()
        );
    }

} //LabelController
