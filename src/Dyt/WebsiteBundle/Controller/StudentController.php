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

/**
 * Student controller.
 *
 * @Route("/student")
 */
class StudentController extends Controller
{
    /**
     * Lists all students.
     *
     * @Route("/", name="student")
     * @Template()
     */
    public function indexAction()
    {
        $entities = StudentQuery::create()->find();
        return array('entities' => $entities);
    }

    /**
     * Displays a form to edit an existing classroom.
     *
     * @Route("/edit", name="student_edit")
     * @Template()
     */
    public function editAction(Request $request)
    {
        $classroom = ClassroomQuery::create()->findPk(12);
        
        $form = $this->createForm(new ClassroomType(), $classroom);

        return array(
            'classroom' => $classroom,
            'form'      => $form->createView()
        );
    }
    
    /**
     * Edit an existing Student entity.
     *
     * @Route("/{id}/update", name="student_update")
     * @Method("post")
     * @Template("DytWebsiteBundle:Student:edit.html.twig")
     */
    public function updateAction($id, Request $request)
    {          
        $classroom = ClassroomQuery::create()->findPk($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find classroom entity.');
        }
        
        $form = $this->createForm(new ClassroomType(), $classroom);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $classroom->save();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('student', array()));
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to create a new Student entity.
     *
     * @Route("/new", name="student_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $classroom = new Classroom();

        $form = $this->createForm(new ClassroomType(), $classroom);

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * Create a new Student entity.
     *
     * @Route("/create", name="student_create")
     * @Method("post")
     * @Template("DytWebsiteBundle:Student:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $classroom = new Classroom();

        $form = $this->createForm(new ClassroomType(), $classroom);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $classroom->save();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('student', array()));
        }

        return array(
            'form' => $form->createView()
        );
    }
}
