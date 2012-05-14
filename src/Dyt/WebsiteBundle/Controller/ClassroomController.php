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
 * Classroom controller.
 *
 * @Route("/classroom")
 */
class ClassroomController extends Controller
{
    /**
     * List all classrooms
     *
     * @Route("/", name="classroom_list")
     * @Template()
     *
     * @return array
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
     * @Route("/{id}/show", name="classroom_show", requirements={"id" = "\d+"})
     * @Template()
     *
     * @param int $id
     * @return array
     */
    public function showAction($id)
    {
        $classroom = ClassroomQuery::create()
            ->joinWith('Student')
            ->findPk($id);

        if (!$classroom) {
            throw $this->createNotFoundException(sprintf('The classroom (id: "%d") does not exist!', $id));
        }

        return array(
            'classroom' => $classroom
        );
    }

    /**
     * Display a form to edit an existing classroom.
     *
     * @Route("/{id}/edit", name="classroom_edit", requirements={"id" = "\d+"})
     * @Template()
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param int $id The classroom id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request, $id)
    {
        $classroom = ClassroomQuery::create()->findPk($id);
        if (!$classroom) {
            throw $this->createNotFoundException(sprintf('The classroom (id: "%d") does not exist!', $id));
        }
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
     * Display a form to create a new classroom.
     *
     * @Route("/new", name="classroom_new")
     * @Template()
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
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

    /**
     * Remove classroom.
     *
     * @Route("/{id}/delete", name="classroom_delete", requirements={"id" = "\d+"})
     * @Template()
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param int $id The classroom id
     */
    public function deleteAction($id)
    {
        $classroom = ClassroomQuery::create()->findPk($id);
        if (!$classroom) {
            throw $this->createNotFoundException(sprintf('The classroom (id: "%d") does not exist!', $id));
        }
        $classroom->delete();
        $this->get('session')->setFlash('notice', sprintf('The classroom "%s" was deleted!', $classroom->getName()));
        return $this->redirect($this->generateUrl('classroom_list'));
    }

} //ClassroomController

