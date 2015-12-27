<?php
/**
 * Created by PhpStorm.
 * User: Ibnu
 * Date: 27/12/2015
 * Time: 15.30
 */

namespace Prajurit\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Prajurit\Model\Prajurit;
use Prajurit\Form\PrajuritForm;

class PrajuritController extends AbstractActionController
{
    protected $prajuritTable;

    public function getPrajuritTable()
    {
        if (!$this->prajuritTable){
            $sm = $this->getServiceLocator();
            $this->prajuritTable = $sm->get('Prajurit\Model\PrajuritTable');
        }
        return $this->prajuritTable;
    }
    public function indexAction()
    {
        return new ViewModel(array(
            'prajurit' => $this->getPrajuritTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new PrajuritForm();
        $form->get('submit')->setValue('Tambah');

        $request = $this->getRequest();
        if ($request->isPost()){
            $prajurit = new Prajurit();
            $form->setInputFilter($prajurit->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()){
                $prajurit->exchangeArray($form->getData());
                $this->getPrajuritTable()->savePrajurit($prajurit);

                return $this->redirect()->toRoute('prajurit');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('prajurit', array(
                'action' => 'add'
            ));
        }

        try {
            $prajurit = $this->getPrajuritTable()->getPrajurit($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('prajurit', array(
                'action' => 'index'
            ));
        }

        $form  = new PrajuritForm();
        $form->bind($prajurit);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($prajurit->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getPrajuritTable()->savePrajurit($prajurit);

                return $this->redirect()->toRoute('prajurit');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }
        
    public function deleteAction()
    {
        
    }
}