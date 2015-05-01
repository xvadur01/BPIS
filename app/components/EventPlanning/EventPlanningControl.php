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
			$Users[$term['user_id']] = $this->userManager->get($term['user_id']);
			$datetime = new \DateTime($term['time']);
			if(empty($this->userId) ||  $this->userId != $term['user_id'])
			{
				$data[$term['user_id']][$datetime->format('d.m.Y')][$datetime->format('H:i:s')][] = $term->toArray();
			}
			else
			{
				$data[$term['user_id']][$datetime->format('d.m.Y')][$datetime->format('H:i:s')][] = $term->toArray();
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
					if($this->presenter->user->getId() == $this->event->user_id)
					{
						$form['times'][$i]->setValues(array("pick" => ($this->event->date == $term['time'] ? TRUE:FALSE),"id" => $term['id'],"time" => $term['time']));
					}
					else
					{
						$form['times'][$i]->setValues(array("pick" => $term['confirm'],"id" => $term['id'],"time" => $term['time']));
					}
					$i++;
				}
			}
		}
		$form->setValues(array("id" => $this->getEventId(),"userId" => $this->eventManager->get($this->getEventId())->user_id));
		$this->template->formUserId = $this->userId;
		$this->template->users = $Users;
		$this->template->eventUserId = $this->event->user_id;
		$this->template->event = $this->event;
		$this->template->isForm = boolval($i);
		$this->template->data = $data;
		$this->template->render(__DIR__ . '/EventPlanningControl.latte');

    }

	protected function createComponentEventPlanningForm()
    {
        $form = new Nette\Application\UI\Form;
		$removeEvent = callback($this, 'EventFormRemoveElementClicked');
		$form->addHidden("id");
		$form->addHidden("userId");
		$dates = $form->addDynamic('times',
                    function (Container $time) use ($removeEvent) {
						$time->addHidden('id', null);
						$time->addHidden('time', null);
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
			if($this->presenter->user->getId() == $values['userId'])
			{
				if($time['pick'])
				{
				$item = array(
						"id" => $values['id'],
						"date" => $time['time'],
						);
				$this->eventManager->edit($item);
				}
			}
			else
			{
				$term = array(
						"id" => $time['id'],
						"confirm" => $time['pick'],
						);
				if($term['id'])
				{
					$this->termManager->edit($term);
				}
			}
		}
		$this->getPresenter()->flashMessage('Změny byly uloženy', 'success');
		$this->getPresenter()->redirect(':Admin:Event:detail',array( 'id' => $values['id']));
    }
}