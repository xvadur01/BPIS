<?php

use \Nette\Application\UI;
use \Nette\Forms\Container;
/**
* The Time control
*/
class EventPlanningControl extends UI\Control
{
	private $eventId = "";
	private $userId = "";

	private $event;
	/** @var \Todo\EventManager */
	private $eventManager;
	/** @var \Todo\TermManager */
	private $termManager;
	/** @var \Todo\UserManager */
	private $userManager;


    function __construct(\App\Model\EventManager $eventManager,  \App\Model\TermManager $termManager,  \App\Model\UserManager $userManager)
    {
        parent::__construct();
		$this->eventManager = $eventManager;
		$this->termManager = $termManager;
		$this->userManager = $userManager;
    }

	public function setEventId($id)
    {
        $this->eventId = $id;
		$this->event = $this->eventManager->get($id);
    }
    public function getEventId()
    {
        return $this->eventId;
    }

	public function setUserId($id)
    {
        $this->userId = $id;
    }
    public function getUserId()
    {
        return $this->userId;
    }

	public function render()
    {
		$terms = $this->termManager->getTermsOfEvent($this->getEventId());
		$data = array();
		$dataUser = array();
		$Users = array();
		foreach ($terms as $term)
		{
				$Users[$term['uzivatel_id']] = $this->userManager->get($term['uzivatel_id']);
				$datetime = new \DateTime($term['cas']);
				if(empty($this->userId) ||  $this->userId != $term['uzivatel_id'])
				{
					$data[$term['uzivatel_id']][$datetime->format('d.m.Y')][$datetime->format('H:i:s')][] = $term->toArray();
				}
				else
				{
					$data[$term['uzivatel_id']][$datetime->format('d.m.Y')][$datetime->format('H:i:s')][] = $term->toArray();
					$dataUser[$datetime->format('d.m.Y')][$datetime->format('H:i:s')][] = $term->toArray();
				}
		}
		$i = 0;
		$form = $this['eventPlanningForm'];
		foreach ($dataUser as $termsUser)
		{
			foreach ($termsUser as $terms)
			{
				foreach ($terms as $term)
				{
					$form['times'][$i]->setValues(array("pick" => $term['vyhovuje'],"id" => $term['id']));
					$i++;
				}
			}
		}
		$form->setValues(array("id" => $this->getEventId()));
		$this->template->formUserId = $this->userId;
		$this->template->users = $Users;
		$this->template->eventUserId = $this->event->uzivatel_id;
		$this->template->isForm = boolval($i);
		$this->template->data = $data;
		$this->template->render(__DIR__ . '/EventPlanningControl.latte');

    }

	protected function createComponentEventPlanningForm()
    {
        $form = new Nette\Application\UI\Form;
		$removeEvent = callback($this, 'EventFormRemoveElementClicked');
		$form->addHidden("id");
		$dates = $form->addDynamic('times',
                    function (Container $time) use ($removeEvent) {
						$time->addHidden('id', null);
						$time->addCheckbox('pick',"");
						$time->addSubmit('remove', 'Remove date')
						->setValidationScope(FALSE) # disables validation
						->onClick[] = $removeEvent;
                    },1);

		$form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = $this->eventPlanningSucceeded;
        return $form;
    }

    public function eventPlanningSucceeded($form)
    {
        $values = $form->getValues();
		foreach ($values['times'] as $time)
		{
			$term = array(
					"id" => $time['id'],
					"vyhovuje" => $time['pick'],
					);
			if($term['id'])
			{
				$this->termManager->edit($term);
			}
		}

		$this->getPresenter()->redirect(':Admin:Event:detail',array( 'id' => $values['id']));
		 $this->flashMessage('Změny byly uloženy', 'success');
    }
}