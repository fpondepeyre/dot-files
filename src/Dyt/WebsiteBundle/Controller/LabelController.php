<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dyt\WebsiteBundle\Form\Service\LabelTypeFactory;

use Dyt\WebsiteBundle\Model\ClassroomQuery;
use Dyt\WebsiteBundle\Model\LabelQuery;
use Dyt\WebsiteBundle\Model\ZoneQuery;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementFactory;
use Dyt\WebsiteBundle\Lib\LabelElement\CustomElement;

use Dyt\WebsiteBundle\Model\Classroom;
use Dyt\WebsiteBundle\Model\Zone;
use Dyt\WebsiteBundle\Model\Label;

/**
 * Label controller.
 *
 * @Route("/label")
 */
class LabelController extends Controller
{
    /**
     * List labels
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
     * Create a new label
     *
     * @param \Dyt\WebsiteBundle\Controller\Request $request
     * @param string                                $name
     * @todo use a form handler
     *
     * @Route   ("/{name}/new", name="label_new")
     * @Template()
     *
     * @return array
     */
    public function newAction(Request $request, $name)
    {
        $form = $this->createForm(LabelTypeFactory::getLabelType($name), array(
            'template' => $name
        ));

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $this->processForm($form);

                return $this->redirect($this->generateUrl('label_list'));
            }
        }

        return array(
            'name' => $name,
            'data' => array(),
            'form' => $form->createView()
        );
    }

    /**
     * Edit a label
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param                                           $id
     * @todo use a form handler
     *
     * @Route    ("/{id}/edit", name="label_edit")
     * @Template ()
     *
     * @return array
     */
    public function editAction(Request $request, $id)
    {
        $label = LabelQuery::create()
            ->joinWith('Zone')
            ->findPk($id);

        $form = $this->createForm(LabelTypeFactory::getLabelType($label->getTemplate()), array(
            'name'      => $label->getName(),
            'classroom' => $label->getClassroom()->getId(),
            'template'  => $label->getTemplate()
        ));

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $this->processForm($form, $label);

                return $this->redirect($this->generateUrl('label_edit', array('id' => $label->getId())));
            }
        }

        return array(
            'label' => $label,
            'data'  => $label->getDataByZone(),
            'form'  => $form->createView()

        );
    }

    /**
     * Process label form
     *
     * @param $form
     * @param  \Dyt\WebsiteBundle\Model\Label                     $label
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function processForm($form, Label $label = null)
    {
        $data = $form->getData();
        $classroom = ClassroomQuery::create()->findPk($data['classroom']);

        if (!$label) {
            $label = new Label();
            $label->setClassroom($classroom);
            $label->setTemplate($data['template']);
        }
        $label->setName($data['name']);
        $label->save();

        foreach ($data as $key => $zone) {
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

        return array(
            'name' => $label->getTemplate(),
            'data' => $label->getDataByZone()
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
        $classType = LabelTypeFactory::getLabelType('custom');
        $form = $this->createForm($classType);

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
