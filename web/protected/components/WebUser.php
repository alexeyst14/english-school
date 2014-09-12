<?php
class WebUser extends CWebUser {
    private $_model = null;

	/**
	 * Get user role
	 * @return int role
	 */
    function getRole() {
        if ($user = $this->getModel()) {
            return $user->person->personType->ROLE;
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Users::model()->findByPk($this->id, array('select' => 'person_ID'));
        }
        return $this->_model;
    }
}

