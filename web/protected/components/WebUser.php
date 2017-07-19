<?php

/**
 * Overload of CWebUser to set some more methods.
 */
class WebUser extends CWebUser
{

	/**
	 * Gets a user item as variable
	 *
	 * (non-PHPdoc)
	 * @see CWebUser::__get()
	 */
	public function __get($name)
    {
        if ($this->hasState('__userInfo')) {
            $user=$this->getState('__userInfo',array());
            if (isset($user[$name])) {
                return $user[$name];
            }
        }
        return parent::__get($name);
    }

    /**
     * Logs a user in and sets required information on the user session
     * (non-PHPdoc)
     * @see CWebUser::login()
     */
    public function login($identity, $duration = 0)
    {
        $this->setState('__userInfo', $identity->getUser());
        parent::login($identity, $duration);
    }

    /*
    * Required to checkAccess function
    * Yii::app()->user->checkAccess('operation')
    */
    public function getId()
    {
        return $this->id;
    }

}
