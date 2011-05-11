<?php
class PricesController extends AppController {

	var $name = 'Prices';

	function index() {
        $url = $this->params['url'];
//        print_r($url);
        $query = $this->Parser->queryString('Price',$url);

        if ($url['ext']=="html"){
            $prices = $this->paginate('Price', $query);
            $this->set('prices', $prices);
//            $this->View = 'Webservice.Webservice';
        }
        else{
            $query = queryString($url);
            //$returndata= false;
            //$this->View = 'Webservice.Webservice';
            $data = $this->paginate('Farm',$query);
        }


		$this->Price->recursive = 0;
		$this->set('prices', $this->paginate('Price', $query));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid price', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('price', $this->Price->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Price->create();
			if ($this->Price->save($this->data)) {
				$this->Session->setFlash(__('The price has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid price', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Price->save($this->data)) {
				$this->Session->setFlash(__('The price has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Price->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for price', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Price->delete($id)) {
			$this->Session->setFlash(__('Price deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Price was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
