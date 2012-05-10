<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Dyt\WebsiteBundle\Model\Classroom;

/**
 * Classroom handler
 * This class process form
 *
 */
class ClassroomHandler
{
    protected $form;
    protected $request;

    /**
     * __construct method
     *
     * @param Form $form
     * @param Request $request
     */
    public function __construct(Form $form, Request $request)
    {
        $this->form = $form;
        $this->request = $request;
    }

    /**
     * Process form
     *
     * @return bool
     */
    public function process()
    {
        if ($this->request->getMethod() == 'POST') {
            $this->form->bindRequest($this->request);
            if ($this->form->isValid()) {
                $this->onSuccess($this->form->getData());
                return true;
            }
        }

        return false;
    }

    /**
     * Save the form
     *
     * @param Classroom $classroom
     */
    public function onSuccess(Classroom $classroom)
    {
        $classroom->save();
    }
}
