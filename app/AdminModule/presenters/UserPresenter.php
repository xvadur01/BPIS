<?php

namespace AdminModule;
use \Nette\Application\UI\Form as Form;
use \Nette\Forms\Container,
	\Nette\Security\Passwords;
class UserPresenter extends BasePresenter {

	/** @var \Todo\UserManager */
	private $userManager;
	/** @var \Todo\EventManager */
	private $eventManager;
	/** @var \Todo\TermManager */
	private $termManager;


    function __construct(\App\Model\UserManager $userManager,\App\Model\EventManager $eventManager,\App\Model\TermManager $termManager) {
		$this->userManager = $userManager;
		$this->eventManager = $eventManager;
		$this->termManager = $termManager;
    }

	public function actionDelete($userId)
    {
		$this->userManager->delete($userId);
		$this->flashMessage('stranka byla úspěšně smazána.', 'success');
        $this->redirect('Frontuser:default');
    }

	public function actionEdit($userId)
    {
        $user = $this->userManager->get($userId);
        if (!$user) {
            $this->error('Strana nebyla nalezena');
			$this->redirect('User:default');
        }
		$user = $user->toArray();

        $this['editUserForm']->setDefaults($user);
    }

	public function renderDefault() {
		$this->template->users = $this->userManager->getTable();
	}

	protected function createComponentUserForm()
    {
        $form = $this->form();
		$model = $this->userManager;
		$form->addHidden('id', null);
		$form->addText('login', 'Login:')
            ->addRule(Form::FILLED, 'Zadejte login.');

		$form->addPassword('heslo', 'Heslo:')
            ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 6)
			->addRule(Form::PATTERN, 'Musí obsahovat číslici', '.*[0-9].*');

		$form->addPassword('2ndpass', 'Heslo pro kontrolu')
                ->addRule(Form::FILLED, 'Zadejte heslo ještě jednou pro kontrolu')
				->addRule(Form::EQUAL, 'Zadané hesla se neshodují', $form['heslo']); ;

        $form->addText('jmeno', 'Jmeno:')
            ->setRequired();

		$form->addText('prijmeni', 'Přijmení:')
            ->setRequired();

		$form->addText('telefon', 'telefon:')
            ->setRequired();

		$form->addText('email', 'Email:')
			->addRule(Form::EMAIL, 'Musí obsahovat email')
            ->setRequired();

		$roles = array(
			'admin' => 'Adminstrátor',
			'user' => 'Běžný uživatel',
		);
		$form->addSelect('role', 'Role:', $roles)
			->getControlPrototype()->setClass('labelNoabsolute')
			->setPrompt('Zvolte roli');
		$form->addText('pracovna', 'Pracovna:');

        $form->addSubmit('send', 'Odeslat');
		$form->onValidate[] = callback($this, 'validateLogin');
        $form->onSuccess[] = $this->userFormSucceeded;
        return $form;
    }
	public function validateLogin($form){
        $values = $form->getValues();
		if($this->userManager->getByLogin($values['login'])->fetch()){
			$form->addError('Zadaný login se již vyskytuje.');
		}

    }
    public function userFormSucceeded($form)
    {

        $values = $form->getValues();
		$values['heslo'] = Passwords::hash($values['heslo']);
		unset($values['2ndpass']);

		if($values['id'])
		{
			$id = $values['id'];
			$this->userManager->edit($values);
		}
		else
		{
			$user = $this->userManager->add($values);
			$id = $user['id'];
		}
        $this->flashMessage('Uzivatel byl vlozen', 'success');
        $this->redirect('User:newUserEvents',array('id' => $id));
    }

	protected function createComponentEditUserForm()
    {
        $form = $this->form();
		$form->addHidden('id', null);
		if(in_array('admin',$this->user->getRoles()))
		{
			$form->addText('login', 'Login:')
            ->addRule(Form::FILLED, 'Zadejte login.');
		}
		else
		{
			$form->addText('login', 'Login:')->setDisabled();
		}

        $form->addText('jmeno', 'Jmeno:')
            ->setRequired();

		$form->addText('prijmeni', 'Přijmení:')
            ->setRequired();

		$form->addText('telefon', 'telefon:')
            ->setRequired();

		$form->addText('email', 'Email:')
			->addRule(Form::EMAIL, 'Musí obsahovat email')
            ->setRequired();

		$roles = array(
			'admin' => 'Adminstrátor',
			'user' => 'Běžný uživatel',
		);
		$form->addSelect('role', 'Role:', $roles)
			->getControlPrototype()->setClass('labelNoabsolute')
			->setPrompt('Zvolte roli');
		$form->addText('pracovna', 'Pracovna:');

        $form->addSubmit('send', 'Odeslat');
		$form->onValidate[] = callback($this, 'validateEditUser');
        $form->onSuccess[] = $this->editUserFormSucceeded;
        return $form;
    }
	public function validateEditUser($form){
		if(in_array('admin',$this->user->getRoles()))
		{
			$values = $form->getValues();
			$user = $this->userManager->getByLogin($values['login'])->fetch();
			if($user && $user['id'] != $values['id']){
				$form->addError('Zadaný login se již vyskytuje.');
			}
		}
		return;
    }
    public function editUserFormSucceeded($form)
    {

        $values = $form->getValues();
		if($values['id'])
		{
			$this->userManager->edit($values);
		}
		else
		{
			$this->userManager->add($values);
		}
        $this->flashMessage('Uzivatel byl vlozen', 'success');
        $this->redirect('User:default');
    }

	public function actionNewUserEvents($id)
	{
		$events = $this->eventManager->getFutureEvents();
		$form = $this['newUserEventsForm'];
		foreach ($events as $event)
		{
			$form['events'][$event['id']]->setValues(array("event_id" => $event['id'],"event_user_id" => $event['uzivatel_id']));
			$form['events'][$event['id']]['pick']->caption = $event['nazev'];
		}

		$form->setValues(array("user_id" => $id));
	}

	protected function createComponentNewUserEventsForm()
    {
        $form = $this->form();
		$removeEvent = callback($this, 'EventFormRemoveElementClicked');
		$form->addHidden("user_id");
		$dates = $form->addDynamic('events',
                    function (Container $time) use ($removeEvent) {
						$time->addHidden('event_id', null);
						$time->addHidden('event_user_id', null);
						$time->addCheckbox('pick',"")->getControlPrototype()->class('checkbox');;
						$time->addSubmit('remove', 'Remove date')
						->setValidationScope(FALSE) # disables validation
						->onClick[] = $removeEvent;
                    },0);

		$form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = $this->newUserEventsSucceeded;
        return $form;
    }

    public function newUserEventsSucceeded($form)
    {
        $values = $form->getValues();
		foreach ($values['events'] as $event)
		{
			if($event['pick'] == TRUE)
			{
				$terms = $this->termManager->getTermOfEvent($event['event_user_id'], $event['event_id']);
				foreach ($terms as $key => $term) {
					$term = $term->toArray();
					$term['uzivatel_id'] = $values['user_id'];
					$term['vyhovuje'] = null;
					unset($term['id']);
					$this->termManager->add($term);
				}
			}
		}
		$this->flashMessage('Změny byly uloženy', 'success');
		$this->redirect('User:default');
    }
}