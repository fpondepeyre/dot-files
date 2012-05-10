<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Dyt\WebsiteBundle\Form\ClassroomType;

use Dyt\WebsiteBundle\Model\StudentQuery;
use Dyt\WebsiteBundle\Model\ClassroomQuery;
use Dyt\WebsiteBundle\Model\Classroom;

use Dyt\WebsiteBundle\Form\ClassroomHandler;


/**
 * Student controller.
 *
 * @Route("/student")
 */
class StudentController extends Controller
{
    /**
     * Lists students of a classroom.
     *
     * @Route("/classroom", name="classroom")
     * @Template()
     */
    public function classroomAction()
    {
        $classrooms = ClassroomQuery::create()->find();
        return array(
            'classrooms' => $classrooms
        );
    }

    /**
     * Lists students of a classroom.
     *
     * @Route("/{id}/classroom", name="student")
     * @Template()
     */
    public function indexAction($id)
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
     * @Route("/{id}/edit", name="student_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $classroom = ClassroomQuery::create()->findPk($id);
        $form = $this->createForm(new ClassroomType(), $classroom);
        $formHandler = new ClassroomHandler($form, $request);
        if($formHandler->process()) {
            return $this->redirect($this->generateUrl('classroom', array()));
        }
        return array(
            'classroom' => $classroom,
            'form'      => $form->createView()
        );
    }

    /**
     * Displays a form to create a new classroom.
     *
     * @Route("/new", name="student_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $classroom = new Classroom();
        $form = $this->createForm(new ClassroomType(), $classroom);
        $formHandler = new ClassroomHandler($form, $request);
        if($formHandler->process()) {
            return $this->redirect($this->generateUrl('classroom', array()));
        }
        return array(
            'form' => $form->createView()
        );
    }

} //StudentController

