<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Dyt\WebsiteBundle\Model\LabelQuery;
use Dyt\WebsiteBundle\Model\ZoneQuery;
use Dyt\WebsiteBundle\Lib\LabelElement\StandardElement;
use Dyt\WebsiteBundle\Model\Zone;
use Dyt\WebsiteBundle\Model\Classroom;
use Dyt\WebsiteBundle\Model\Label;
use Dyt\WebsiteBundle\Form\ZoneType;
use Dyt\WebsiteBundle\Form\LabelType;

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
     * @Route    ("/", name="label_list")
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
     * Choose the template to configure
     *
     * @param Classroom $classroom The current classroom
     *
     * @Route("/choices/{id}", name="choices_label", requirements={"id" = "\d+"})
     * @Template()
     *
     * @return array
     */
    public function choicesAction(Classroom $classroom)
    {
        $this->get('session')->set('classroom', $classroom);

        return array();
    }

    /**
     * Create a new label
     *
     * @param \Dyt\WebsiteBundle\Controller\Request $request
     * @param string                                $template
     *
     * @Route   ("/{template}/new", name="label_new")
     * @Template()
     *
     * @return array
     */
    public function newAction(Request $request, $template)
    {
        $classroom = $this->get('session')->get('classroom');

        $label = new Label();
        $label->setTemplate($template);
        $label->setClassroom($classroom);

        $form = $this->createForm(new LabelType, $label);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $form->getData()->save();
                $zones = $this->get('session')->get('zone', array());
                foreach($zones as $name => $zone ) {
                    Zone::upsert($label, $name, $zone->getTemplate());
                }

                return $this->redirect($this->generateUrl('label_list'));
            }
        }

        return array(
            'label' => $label,
            'form'  => $form->createView()
        );
    }

    /**
     * Edit a label
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param                                           $id
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Route    ("/{id}/edit", name="label_edit", requirements={"id" = "\d+"})
     * @Template ()
     *
     * @return array
     */
    public function editAction(Request $request, $id)
    {
        $label = LabelQuery::create()
            ->joinWith('Zone', \Criteria::LEFT_JOIN)
            ->findPk($id);

        if (!$label) {
            throw $this->createNotFoundException(sprintf('The label (id: "%d") does not exist!', $id));
        }

        $form = $this->createForm(new LabelType, $label);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $form->getData()->save();
                $zones = $this->get('session')->get('zone', array());
                foreach($zones as $name => $zone ) {
                    Zone::upsert($label, $name, $zone->getTemplate());
                }

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
     * Show label
     *
     * @param $id
     *
     * @Route    ("/{id}/show", name="label_show", requirements={"id" = "\d+"})
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
            'template' => $label->getTemplate(),
            'data' => $label->getDataByZone()
        );
    }

    /**
     * Edit zone in modal windows
     *
     * @param $name The zone name
     *
     * @Route("/template/zone/{name}", name="zone")
     * @Template()
     *
     * @return array
     */
    public function ZoneAction($name)
    {
        $zone = new Zone();
        $zone->setName($name);
        $form = $this->createForm(new ZoneType(), $zone);

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * Process zone edit
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route    ("/template/process/zone", name="process_zone")
     * @Template ()
     *
     * @return array
     */
    public function processZoneAction(Request $request)
    {
        $classroom = $this->get('session')->get('classroom');

        $form = $this->createForm(new ZoneType());
        if ($request->getMethod() == 'POST'){
            $form->bindRequest($request);
            if ($form->isValid()){
                $zone = $form->getData();
                $this->updateSessionZone($zone);
                $template = $this->renderTemplate($classroom, $zone);

                return new Response(json_encode(array(
                    'zone'     => $zone->getName(),
                    'template' => $template
                )));
            }
        }
    }

    /**
     * Update the session
     *
     * @param $zone
     */
    private function updateSessionZone(Zone $zone)
    {
        $sessionZone = $this->get('session')->get('zone', array());
        $sessionZone[$zone->getName()] = $zone;
        $this->get('session')->set('zone', $sessionZone);
    }

    /**
     * Generate zone content
     *
     * @param \Dyt\WebsiteBundle\Model\Classroom $classroom
     * @param \Dyt\WebsiteBundle\Model\Zone $zone
     *
     * @return mixed The template
     */
    private function renderTemplate(Classroom $classroom, Zone $zone)
    {
        $element = new StandardElement($classroom);
        $element->setTemplate($zone->getTemplate());

        return $element->renderElement();
    }

} //LabelController
