<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Dyt\WebsiteBundle\Form\ClassroomType;

use Dyt\WebsiteBundle\Model\ClassroomQuery;
use Dyt\WebsiteBundle\Model\Classroom;

use Dyt\WebsiteBundle\Form\ClassroomHandler;


/**
 * Student controller.
 *
 * @Route("/classroom")
 */
class StudentController extends Controller
{
    /**
     * List all classrooms
     *
     * @Route("/", name="classroom_list")
     * @Template()
     */
    public function listAction()
    {
        $classrooms = ClassroomQuery::create()->find();
        return array(
            'classrooms' => $classrooms
        );
    }

    /**
     * Lists students of a classroom.
     *
     * @Route("/{id}/show", name="classroom_show")
     * @Template()
     */
    public function showAction($id)
    {
        $classroom = ClassroomQuery::create()
            ->joinWith('Student')
            ->findPk($id);

        return array(
            'classroom' => $classroom
        );
    }

    /**
     * Displays a form to edit an existing classroom.
     *
     * @Route("/{id}/edit", name="classroom_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $classroom = ClassroomQuery::create()->findPk($id);
        $form = $this->createForm(new ClassroomType(), $classroom);
        $formHandler = new ClassroomHandler($form, $request);
        if ($formHandler->process()) {
            return $this->redirect($this->generateUrl('classroom_show', array('id' => $id)));
        }
        return array(
            'classroom' => $classroom,
            'form'      => $form->createView()
        );
    }

    /**
     * Displays a form to create a new classroom.
     *
     * @Route("/new", name="classroom_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $classroom = new Classroom();
        $form = $this->createForm(new ClassroomType(), $classroom);
        $formHandler = new ClassroomHandler($form, $request);
        if ($formHandler->process()) {
            return $this->redirect($this->generateUrl('classroom_show', array('id' => $classroom->getId())));
        }
        return array(
            'form' => $form->createView()
        );
    }

} //StudentController

