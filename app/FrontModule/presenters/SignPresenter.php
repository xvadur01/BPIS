<?php

namespace FrontModule;
use \Nette,
	\Nette\Utils\Strings,
	\Nette\Security\Passwords;
/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

	/** @persistent */
    public $backlink = '';
	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->form();
		$form->addText('username', 'Username:')
			->setRequired('Prosím zadejte přihlašovací jméno.');

		$form->addPassword('password', 'Password:')
			->setRequired('Prosím zadejte heslo.');

		$form->addCheckbox('remember', 'Zůstat přihlášen')->getControlPrototype()->class('checkbox');

		$form->addSubmit('send', 'Sign in')->getControlPrototype()->class="btn btn-default";

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form, $values)
	{
		if ($values->remember) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->restoreRequest($this->backlink);
			$this->redirect('Homepage:');

		} catch (\Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Odhlášení proběhlov  pořádku.');
		$this->redirect(':Front:Homepage:');
	}

}
