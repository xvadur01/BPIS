<?php
namespace AdminModule;
use \Nette\Application\UI\Form as Form;
use \Nette\Forms\Container;
use \Nette\Forms\Controls\SubmitButton;

/**
 * Front Page Presenter
 */
class EventPresenter extends BasePresenter {

	/** @var \Todo\EventManager */
	private $eventManager;
	/** @var \Todo\TermManager */
	private $termManager;
	/** @var \Todo\UserManager */
	private $userManager;
	/** @persistent */
	public $backlink = '';
	/**
	 * @var data
	 * @var type
	 * variable for time line
	 */
	protected $data;
	protected $type;
	protected $eventId;

	private $users;
	function __construct(\App\Model\EventManager $eventManager,  \App\Model\TermManager $termManager, \App\Model\UserManager $userManager)
	{
		$this->eventManager = $eventManager;
		$this->termManager = $termManager;
		$this->userManager = $userManager;
    }

	/**
	 * Create component event planing.
	 * @return \EventPlanningControl
	 */
	protected function createComponentEventPlaning()
    {
		$eventPlanning = new \EventPlanningControl($this->eventManager, $this->termManager, $this->userManager);
		$eventPlanning->setEventId($this->eventId);
		$eventPlanning->setUserId($this->user->getId());
        return $eventPlanning;
    }

	/**
	 * Create component event planing.
	 * @return \TimeLineControl
	 */
    protected function createComponentTimeLine()
    {
		$timeLine = new \TimeLineControl();
		$timeLine->setType($this->type);
		$timeLine->setData($this->data);
        return $timeLine;
    }

	/**
	 * Action delele event.
	 * @param type $eventId
	 */
	public function actionDelete($eventId)
    {
		$this->termManager->deleteByEvent($eventId);
		$this->eventManager->delete($eventId);
		$this->flashMessage('událost byla úspěšně smazána.', 'success');
		$this->restoreRequest($this->backlink);
        $this->redirect('Event:default');
    }

	/**
	 * Action invite users to event.
	 * @param type $idEvent
	 * @param type $user_id
	 */
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

	/**
	 * Render users. Load all users.
	 */
	public function renderUsers()
    {
		$this->template->users = $this->users;
    }

	/**
	 * Action edit event. Fill form to edit event.
	 * @param type $eventId
	 */
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
			$formDates[$datetime->format('Y-m-d')][$term->id] = array("id" => $term->id, "cas" => $datetime->format('H:i'),"pick" => $pick);
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
		$form->setValues(array("id" => $event['id'], "datum" => $event['datum'],"popis" => $event['popis'],
						"misto" =>$event['misto'],"nazev" => $event['nazev'],
						"pocet_upozorneni" => $event['pocet_upozorneni'],
						"zapis" => $event['zapis'],"uzivatel_id" => $event['uzivatel_id']));
		$this->template->form = $this->template->_form = $form;

    }
	/**
	 * Render default. Load users evet
	 */
	public function renderDefault() {
		if($this->user->isInRole('admin'))
		{
			$this->template->events = $this->eventManager->getTable()->order(\App\Model\EventManager::COLUMN_ID.' DESC');
		}
		else
		{
			$terms = $this->termManager->getUserEvents($this->user->getId())->order(\App\Model\EventManager::COLUMN_ID.' DESC');
			$events = array();
			foreach ($terms as $term)
			{
				$events[] = $term['udalost_id'];
			}
			$this->template->events = $this->eventManager->gets($events)->order(\App\Model\EventManager::COLUMN_ID.' DESC');
		}
	}

	/**
	 * Render list of event. Load users event / admin load all events to time line.
	 */
	public function renderList()
	{
		if($this->user->isInRole('admin'))
		{
			$this->data = $this->eventManager->getTable()->order(\App\Model\EventManager::COLUMN_ID.' DESC');
		}
		else
		{
			$terms = $this->termManager->getUserEvents($this->user->getId())->order(\App\Model\EventManager::COLUMN_ID.' DESC');
			$events = array();
			foreach ($terms as $term)
			{
				$events[] = $term['udalost_id'];
			}
			$this->data = $this->eventManager->gets($events)->order(\App\Model\EventManager::COLUMN_ID.' DESC');
		}
		$this->type = "event";
	}

	/**
	 * Render event detail.
	 * @param type $id
	 */
	public function renderDetail($id)
	{
		$this->eventId = $id;
		$event = $this->eventManager->get($id);
		$this->template->title = $event->nazev;
		$this->template->event = $event;
		$this->template->userRef = $event->ref('uzivatel');
		$this->template->terms = $this->termManager->getTermOfEvent($event->uzivatel_id,$id);
		$this->template->users = $this->termManager->getUsersOfEvent($id);
	}
	public function renderAdd()
	{
		$this->template->form = $this->template->_form = $this["eventForm"];
	}

	/**
	 * function add new element to form
	 * @param SubmitButton $button
	 */
	public function EventFormAddElementClicked(SubmitButton $button)
	{

		$button->parent->createOne();
		$this->template->form = $this->template->_form = $this['eventForm'];

		$this->redrawControl('itemsList');


		// $users = $button->parent;

		// count how many containers were filled
		//if ($users->isAllFilled()) {
			// add one container to replicator
		//	$button->parent->createOne();
		//}
	}



	/**
	 * function remove  element from form
	 * @param SubmitButton $button
	 */
	public function EventFormRemoveElementClicked(SubmitButton $button)
	{
		// first parent is container
		// second parent is it's replicator

		if(isset($button->parent->components['id']) && $button->parent->components['id']->value)
		{
			$this->termManager->delete($button->parent->components['id']->value);
		}
		$users = $button->parent->parent;

		$users->remove($button->parent, TRUE);
		$this->template->form = $this->template->_form = $this['eventForm'];
		$this->redrawControl('itemsList');
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
		$termsEvent = $this->termManager->getTermOfEvent($values['user_id'],$values['id']);

		foreach ($values['select'] as $userID => $allow)
		{
			if($allow === FALSE && $userID != $values['user_id'])
			{
				$this->termManager->deleteUserEvent($values['id'],$userID);
			}
			elseif($userID != $values['user_id'])
			{
				$termsUser = $this->termManager->getTermOfEvent($userID,$values['id'])->fetchAll();
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
        $this->flashMessage('Uživatelé byli pozváni na událost.', 'success');
        $this->redirect('Event:default');
    }

	protected function createComponentEventForm()
    {
        $form = $this->form();
		$removeEvent = callback($this, 'EventFormRemoveElementClicked');
		$form->addHidden('id', null);
		$form->addHidden('uzivatel_id', null);
		$form->addHidden('pocet_upozorneni', null);
        $form->addText('nazev', 'Název:')
            ->setRequired('Zadejte název.');
		//$form->addTextArea('popis', 'Popis:')->getControlPrototype()->setId('editor');
		$form->addTextArea('popis', 'Popis:')->getControlPrototype()->setClass('materialize-textarea');
		$form->addText('misto', 'Místo:')
            ->setRequired('Zadejte místo konání.');
		$form->addTextArea('zapis', 'Zápis:')->getControlPrototype()->setClass('materialize-textarea');


		$dates = $form->addDynamic('dates', function (Container $container) use ($removeEvent) {
				$container->addText('datum', 'Datum:', 20, 20)->getControlPrototype()->setClass('datepicker');
				 $times = $container->addDynamic(
                    'times',
                    function (Container $time) use ($removeEvent) {
						$time->addHidden('id', null);
                        $time->addText('cas', 'Čas')->getControlPrototype()->setClass('clockpicker');
						$time->addCheckbox('pick',"Finální čas");
                        $removeBtn = $time->addSubmit('remove', 'Odebrat čas')
                            ->setValidationScope(false)
							->onClick[] = $removeEvent;
                    },
                    0
                );
				$times->addSubmit('add', 'Přidat nový čas')
					->setValidationScope(FALSE)
					->onClick[] = callback($this, 'EventFormAddElementClicked');

			 $container->addSubmit('remove', 'Odebrat datum')
				->setValidationScope(FALSE) # disables validation
				->onClick[] = $removeEvent;
		},0);
        $form->addSubmit('send', 'Odeslat')
				->onClick[] = callback($this, 'eventSucceeded');

		$dates->addSubmit('add', 'Přidat další datum')
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
			$event['pocet_upozorneni'] = 2;
			$event = $this->eventManager->add($event);
			$event = $event->toArray();
			$this->flashMessage('Událost byla vložena', 'success');
		}


		$values = $button->form->values;
		$term = array('udalost_id' => $event['id'], 'uzivatel_id' => $event['uzivatel_id'], 'vyhovuje' => '1' );
		$termsId = array();
		foreach ($values['dates'] as $dateKey => $date)
		{
			foreach ($date['times'] as $timeKey => $time)
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
					if($time['pick'] || isset($_POST['dates'][$dateKey]['times'][$timeKey]['pick']))
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
		$this->redirect('Event:users',array( 'idEvent' => $event['id'],'user_id' => $event['uzivatel_id']));
    }
}