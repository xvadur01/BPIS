<?php

namespace AdminModule;
use \Nette\Application\UI\Form as Form;
use \Nette\Forms\Container;
use \Nette\Forms\Controls\SubmitButton;
class EventPresenter extends BasePresenter {

	/** @var \Todo\EventManager */
	private $eventManager;


    function __construct(\App\Model\EventManager $eventManager) {
		$this->eventManager = $eventManager;
    }

	public function actionDelete($eventId)
    {
		$this->eventManager->delete($eventId);
		$this->flashMessage('stranka byla úspěšně smazána.', 'success');
        $this->redirect('Event:default');
    }

	public function actionGiveback($eventId)
    {
        $event = $this->eventManager->giveBack($eventId);
		$this->flashMessage('Vec byla navracena.', 'success');
        $this->redirect('Event:default');
    }

	public function actionEdit($eventId)
    {
        $event = $this->eventManager->get($eventId);
        if (!$event) {
            $this->error('Strana nebyla nalezena');
			$this->redirect('Event:default');
        }
		$event = $event->toArray();
		$date = new \DateTime($event['datum']);
		$event['datum'] = $date->format('d F, Y');

        $this['eventForm']->setDefaults($event);
    }

	public function renderDefault() {
		$this->template->events = $this->eventManager->getTable();
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
		$users = $button->parent->parent;
		$users->remove($button->parent, TRUE);
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
				$container->addText('datum', 'Datum:', 16, 16)->getControlPrototype()->setClass('datepicker');
				 $times = $container->addDynamic(
                    'times',
                    function (Container $time) use ($removeEvent) {
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
		dump($values['dates'][0]['times']);
		dump($button->form->values);
        /*$values = $form->getValues();
		   // jenom naplnění šablony, bez přesměrování
      $this->getSession('values')->users = $button->form->values;
      $this->redirect('this');
		$date = new \DateTime($values['datum']);
		$values['datum'] = $date->format('Y-m-d H:i:s');
		if ($values['id']) {
			$this->eventManager->edit($values);
        } else {
            $this->eventManager->add($values);
        }*/
      //  $this->flashMessage('Výpujdčka byla vlozena', 'success');
      //  $this->redirect('Event:default');
    }
}