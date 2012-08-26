<?php
App::uses('AppController', 'Controller');
App::uses('CakeSession', 'Model/Datasource');
/**
 * Cafes Controller
 *
 * @property Cafe $Cafe
 */
class CafesController extends AppController {

	var $helpers = array('AssetCompress.AssetCompress');

	public $components = array (
		'RequestHandler',
		'Backbone.Backbone'
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cafe->recursive = 0;
		$this->set('cafes', $this->Cafe->find('all'));
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Cafe->id = $id;
		if (!$this->Cafe->exists()) {
			throw new NotFoundException(__('Invalid cafe'));
		}
		$this->set('cafe', $this->Cafe->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cafe->create();
			if ($result = $this->Cafe->save($this->request->data)) {
				if (!$this->RequestHandler->isAjax()) {
					$this->Session->setFlash(__('The cafe has been saved'));
					$this->redirect(array('action' => 'index'));
				}
				$this->set('cafe', $result);
			} else {
				$this->Session->setFlash(__('The cafe could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Cafe->id = $id;
		if (!$this->Cafe->exists()) {
			throw new NotFoundException(__('Invalid cafe'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($data = $this->Cafe->save($this->request->data)) {
				if (!$this->RequestHandler->isAjax()) {
					$this->Session->setFlash(__('The cafe has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->set('cafe', $data);
				}
			} else {
				$this->Session->setFlash(__('The cafe could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Cafe->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {

		if (!$this->request->is('post') && !$this->request->is('delete')) {
			throw new MethodNotAllowedException();
		}
		$this->Cafe->id = $id;
		if (!$this->Cafe->exists()) {
			throw new NotFoundException(__('Invalid cafe'));
		}
		if ($this->Cafe->delete()) {
			if (!$this->RequestHandler->isAjax()) {
				$this->Session->setFlash(__('Cafe deleted'));
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('Cafe was not deleted'));
		if (!$this->RequestHandler->isAjax()) {
			$this->redirect(array('action' => 'index'));
		}
	}
}
