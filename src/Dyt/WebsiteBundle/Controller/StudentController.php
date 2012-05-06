<?php

namespace Dyt\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Dyt\WebsiteBundle\Form\StudentType;
use Dyt\WebsiteBundle\Form\ClassroomType;

use Dyt\WebsiteBundle\Model\StudentQuery;
use Dyt\WebsiteBundle\Model\Student;
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
     * Lists all Student entities.
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
     * Finds and displays a Student entity.
     *
     * @Route("/{id}/show", name="student_show")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = StudentQuery::create()->findPk($id);

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
        $entity = StudentQuery::create()->findPk($id);

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
            $entity = StudentQuery::create()->findPk($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Student entity.');
            }

            $em->delete();
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
        $classroom = ClassroomQuery::create()
            ->joinWith('Student')
            ->findPk(1);

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
