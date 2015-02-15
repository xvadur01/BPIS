<?php

namespace AdminModule;
use \Nette\Application\UI\Form as Form;
use \Nette\Forms\Container;
use \Nette\Forms\Controls\SubmitButton;
class EventPresenter extends BasePresenter {

	/** @var \Todo\EventManager */
	private $eventManager;
	/** @var \Todo\TermManager */
	private $termManager;
	/** @var \Todo\UserManager */
	private $userManager;

	protected $data;
	protected $type;

	private $users;
	function __construct(\App\Model\EventManager $eventManager,  \App\Model\TermManager $termManager, \App\Model\UserManager $userManager)
	{
		$this->eventManager = $eventManager;
		$this->termManager = $termManager;
		$this->userManager = $userManager;
    }

    protected function createComponentTimeLine()
    {
		$timeLine = new \TimeLineControl();
		$timeLine->setType($this->type);
		$timeLine->setData($this->data);
        return $timeLine;
    }

	public function actionDelete($eventId)
    {
		$this->termManager->deleteByEvent($eventId);
		$this->eventManager->delete($eventId);
		$this->flashMessage('událost byla úspěšně smazána.', 'success');
        $this->redirect('Event:default');
    }

	public function actionUsers($idEvent,$user_id)
    {
		$this->users = $this->userManager->getTable();
		$users = $this->termManager->getUsersOfEvent($idEvent);
		$defaultValues = array();
		$defaultValues['id'] = $idEvent;
		$defaultValues['user_id'] = $user_id;
		foreach ($users as $user)
		{
			$defaultValues["select"][$user->uzivatel_id] = TRUE;
		}
        $this['usersEventForm']->setDefaults($defaultValues);
    }

	public function renderUsers()
    {
		$this->template->users = $this->users;
    }

	public function actionGiveback($eventId)
    {
        $event = $this->eventManager->giveBack($eventId);
		$this->flashMessage('Vec byla navracena.', 'success');
        $this->redirect('Event:default');
    }

	public function actionEdit($eventId)
    {
		$form = $this['eventForm'];
        $event = $this->eventManager->get($eventId);
        if (!$event) {
            $this->error('Strana nebyla nalezena');
			$this->redirect('Event:default');
        }
		$event = $event->toArray();
		$date = new \DateTime($event['datum']);
		$event['datum'] = $date->format('d F, Y');
		$terms = $this->termManager->getTermOfEvent($event['uzivatel_id'],$event['id']);
		$formDates = array();
		foreach ($terms as $term) {
			$datetime = new \DateTime($term['cas']);
			$pick = ($date == $datetime ? TRUE : FALSE);
			$formDates[$datetime->format('Y-m-d')][] = array("id" => $term->id, "cas" => $datetime->format('H:i'),"pick" => $pick);
		}
		$i = 0;
		foreach ($formDates as $date => $times) {
			$datesValue = new \DateTime($date);
			$form['dates'][$i]->setValues(array("datum" => $datesValue->format('d F, Y')));

			foreach ($times as $time)
			{
				$form['dates'][$i]['times'][$time['id']]->setValues($time);
			}
			$i++;
		}
		$form->setValues(array("id" => $event['id'], "datum" => $event['datum'],
						"misto" =>$event['misto'],"nazev" => $event['nazev'],
						"pocet_upozorneni" => $event['pocet_upozorneni'],
						"zapis" => $event['zapis'],"uzivatel_id" => $event['uzivatel_id']));


    }

	public function renderDefault() {
		$this->template->events = $this->eventManager->getTable();
	}

	public function renderList()
	{
		$this->template->testr = "test";
		$this->data = $this->eventManager->getTable();
		$this->type = "event";
	}

	public function getTermOfEvent($idUser, $idEvent)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_USER,$idUser)->where(self::COLUMN_EVENT,$idEvent);
	}

	/**
	 * get active pages
	 * @return void
	 */
	public function getUsersOfEvent($idEvent)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_EVENT,$idEvent)->group(self::COLUMN_USER);
	}

	public function renderDetail($id)
	{
		$event = $this->eventManager->get($id);
		$this->template->title = $event->nazev;
		$this->template->event = $event;
		$this->template->terms = $this->termManager->getTermOfEvent($event->uzivatel_id,$id);
		$this->template->users = $this->termManager->getUsersOfEvent($id);
	}

	public function EventFormAddElementClicked(SubmitButton $button)
	{
		$button->parent->createOne();

		// $users = $button->parent;

		// count how many containers were filled
		//if ($users->isAllFilled()) {
			// add one container to replicator
		//	$button->parent->createOne();
		//}
	}

	public function EventFormRemoveElementClicked(SubmitButton $button)
	{
		// first parent is container
		// second parent is it's replicator

		if($button->parent->components['id']->value)
		{
			$this->termManager->delete($button->parent->components['id']->value);
		}
		$users = $button->parent->parent;

		$users->remove($button->parent, TRUE);
	}

	protected function createComponentUsersEventForm()
    {
        $form = $this->form();
		$form->addHidden('id', null);
		$form->addHidden('user_id', null);
		$select = $form->addContainer('select');
		foreach ($this->users as $user) {
			$select->addCheckbox($user->id,$user->prijmeni . " " .$user->jmeno);
		}
		$form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = $this->usersEventFormSucceeded;
        return $form;
    }
	public function usersEventFormSucceeded($form)
    {
		$values = $form->getValues();
		$termsEvent = $this->termManager->getTermOfEvent($values['id'],$values['user_id']);
		foreach ($values['select'] as $userID => $allow)
		{
			if($allow === FALSE && $userID != $values['user_id'])
			{
				$this->termManager->deleteUserEvent($values['id'],$userID);
			}
			else
			{
				$termsUser = $this->termManager->getTermOfEvent($values['id'],$userID);
				$allowTerm = array();
				foreach ($termsEvent as $termEvent)
				{
					$find = FALSE;
					foreach ($termsUser as $termUser)
					{
						if($termUser->cas == $termEvent->cas)
						{
							$allowTerm[] = $termUser->id;
							$find = TRUE;
							break;
						}
					}
					// add new term
					if(!$find)
					{
						$term = $termEvent->toArray();
						$term['uzivatel_id'] = $userID;
						unset($term['vyhovuje']);
						unset($term['id']);
						$this->termManager->add($term);
					}
				}
				// delete canceled term
				foreach ($termsUser as $termUser)
				{
					if(!in_array($termUser->id, $allowTerm))
					{
						$this->termManager->delete($termUser->id);
					}
				}
			}
		}

		dump($values);
       // $this->flashMessage('Partner byl vlozen', 'success');
        //$this->redirect('Frontpage:default');
    }

	protected function createComponentEventForm()
    {
        $form = $this->form();
		$removeEvent = callback($this, 'EventFormRemoveElementClicked');
		$form->addHidden('id', null);
		$form->addHidden('uzivatel_id', null);
        $form->addText('nazev', 'Název:')
            ->setRequired();

		$form->addText('misto', 'Místo:')
            ->setRequired();
		$form->addTextArea('zapis', 'Zápis:')->getControlPrototype()->setClass('materialize-textarea');
		$form->addText('pocet_upozorneni', 'Počet upozornění:');

		$dates = $form->addDynamic('dates', function (Container $container) use ($removeEvent) {
				$container->addText('datum', 'Datum:', 20, 20)->getControlPrototype()->setClass('datepicker');
				 $times = $container->addDynamic(
                    'times',
                    function (Container $time) use ($removeEvent) {
						$time->addHidden('id', null);
                        $time->addText('cas', 'Čas')->getControlPrototype()->setClass('clockpicker');
						$time->addCheckbox('pick',"Finální čas");
                        $removeBtn = $time->addSubmit('remove', 'Smazat čas')
                            ->setValidationScope(false);
                        $removeBtn->onClick[] = $removeEvent;
                    },
                    1
                );
				$times->addSubmit('add', 'Add next time')
					->setValidationScope(FALSE)
					->onClick[] = callback($this, 'EventFormAddElementClicked');

			 $container->addSubmit('remove', 'Remove date')
				->setValidationScope(FALSE) # disables validation
				->onClick[] = $removeEvent;
		},1);




        $form->addSubmit('send', 'Odeslat')
				->onClick[] = callback($this, 'eventSucceeded');


		$dates->addSubmit('add', 'Add next date')
        ->setValidationScope(FALSE)
        ->onClick[] = callback($this, 'EventFormAddElementClicked');
		$form->setDefaults(array("uzivatel_id" => $this->user->getId()));

        return $form;
    }

    public function eventSucceeded(SubmitButton $button)
    {
		$values = $button->form->values;
		$event = $values;
		unset($event['dates']);
		$event['datum'] = null;
		if($event['id'])
		{
			$this->eventManager->edit($event);
			$this->flashMessage('Událost byla upravena', 'success');
		}
		else
		{
			$event = $this->eventManager->add($event);
			$event = $event->toArray();
			$this->flashMessage('Událost byla vložena', 'success');
		}


		$values = $button->form->values;
		$term = array('udalost_id' => $event['id'], 'uzivatel_id' => $event['uzivatel_id']);
		$termsId = array();
		foreach ($values['dates'] as $date)
		{
			foreach ($date['times'] as $time)
			{
				if(isset($time['cas']) && !empty($time['cas']))
				{
					$datetime = new \DateTime( $time['cas'] . ", " . $date['datum']);
					$term['id'] = $time['id'];
					$term['cas'] = $datetime->format('Y-m-d H:i:s');
					if($term['id'])
					{
						$termsId[] = $term['id'];
						$this->termManager->edit($term);
					}
					else
					{
						$addedTerm = 0;
						$addedTerm = $this->termManager->add($term);
						$termsId[] = $addedTerm->id;
					}
					if($time['pick'])
					{
						$event['datum'] = $datetime->format('Y-m-d H:i:s');
						$this->eventManager->edit($event);
					}
				}
			}
		}

		//delete remove term
		$eventTerm = $this->termManager->getTermOfEvent($event['uzivatel_id'], $event['id']);
		foreach ($eventTerm as $term) {
			if(!in_array($term->id, $termsId))
			{
				$this->termManager->delete($term->id);
			}
		}
		//$this->redirect('Event:users',array( 'idEvent' => $event['id'],'user_id' => $event['uzivatel_id']));
    }
}