<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;
    private $_username;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {

        if (strpos($this->username, '@') !== false) {
            $user = User::model()->findByAttributes(array('email' => $this->username));
        } else {
            $user = User::model()->findByAttributes(array('username' => $this->username));
        }
        if ($user === null) { // No user was found!
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->password !== md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else { // User/pass match
            $this->errorCode = self::ERROR_NONE;
            $this->_username = $user->username;
            $this->_id = $user->id;
            $authorizer = Yii::app()->getModule("rights")->getAuthorizer();
            $authorizer->authManager->assign('Authenticated', $user->id);
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}