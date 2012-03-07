<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dyt\WebsiteBundle\Entity\Student;
use Dyt\WebsiteBundle\Form\StudentType;
use Dyt\WebsiteBundle\Entity\Classroom;
use Dyt\WebsiteBundle\Form\ClassroomType;

/**
 * Student controller.
 *
 * @Route("/student")
 */
class StudentController extends Controller
{
    /**
     * Lists all Student entities.
     *
     * @Route("/", name="student")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('DytWebsiteBundle:Student')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Student entity.
     *
     * @Route("/{id}/show", name="student_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('DytWebsiteBundle:Student')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()
         );
    }

    /**
     * Edits an existing Student entity.
     *
     * @Route("/{id}/update", name="student_update")
     * @Method("post")
     * @Template("DytWebsiteBundle:Student:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('DytWebsiteBundle:Student')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        $editForm   = $this->createForm(new StudentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('student_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Student entity.
     *
     * @Route("/{id}/delete", name="student_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('DytWebsiteBundle:Student')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Student entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('student'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing Student entity.
     *
     * @Route("/edit", name="student_edit")
     * @Template()
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $students = $em->getRepository('DytWebsiteBundle:Student')->findAll();

        $classroom = new Classroom();
        foreach($students as $student) {
            $classroom->addStudents($student);
        }

        $form = $this->createForm(new ClassroomType(), $classroom);

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
        $student = new Student();
        $classroom->addStudents($student);

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
        $classrooms = $request->request->get('classroom', array());
        if (isset($classrooms['students'])) {
            $students = $classrooms['students'];
            foreach($students as $student) {
                $student = new Student();
                $classroom->addStudents($student);
            }
        }

        $form = $this->createForm(new ClassroomType(), $classroom);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($classroom);
            foreach($classroom->getStudents() as $student) {
                $em->persist($student);
            }
            $em->flush();
            return $this->redirect($this->generateUrl('student', array()));
        }

        return array(
            'form' => $form->createView()
        );
    }
}
