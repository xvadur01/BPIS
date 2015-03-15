<?php

namespace FrontModule;
use \Nette\Application\UI;
use \Nette\Mail\Message;
use \Nette\Mail\SendmailMailer;
/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
	/** @var \Todo\EventManager */
	private $eventManager;
	/** @var \Todo\TermManager */
	private $termManager;
	/** @var \Todo\UserManager */
	private $userManager;
	/** @var \Todo\BorrowingManager */
	private $recordManager;


	function __construct(\App\Model\EventManager $eventManager,  \App\Model\TermManager $termManager, \App\Model\UserManager $userManager,
						 \App\Model\RecordManager $recordManager)
	{
		$this->eventManager = $eventManager;
		$this->termManager = $termManager;
		$this->userManager = $userManager;

		$this->recordManager = $recordManager;

    }

	public function actionCron()
	{
		$mailer = new SendmailMailer;
		$latte = new \Latte\Engine;

		$events = $this->eventManager->getEventsInSevenDays();
		foreach ($events as $key => $event) {
			$params = array(
				'event' => $event,
			);
			$mail = new Message;
			$mail->setFrom('Franta <franta@example.com>')
					->setSubject('Upozornění na blížící se akci');
			$eventUsers = $this->termManager->getUsersOfEvent($event->id);
			$find = FALSE;
			foreach ($eventUsers as $user) {
				$find = TRUE;
				$this->template->event = $event;
				$mail->addTo((string)$user->ref('uzivatel','uzivatel_id')->email);
			}

			$mail->setBody($latte->renderToString(__DIR__ . '/../templates/Homepage/emailEventSevenday.latte', $params));
			if($find)
			{
				$mailer->send($mail);
			}
			$this->eventManager->edit(array('id' => $event->id, 'pocet_upozorneni' => $event->pocet_upozorneni--));
		}

		$events = $this->eventManager->getEventsInOneDays();
		foreach ($events as $key => $event) {
			$params = array(
				'event' => $event,
			);
			$mail = new Message;
			$mail->setFrom('Franta <franta@example.com>')
					->setSubject('Upozornění na blížící se akci');
			$eventUsers = $this->termManager->getUsersOfEvent($event->id)->where(\App\Model\TermManager::COLUMN_ALLOW,1);
			$find = FALSE;
			foreach ($eventUsers as $user) {
				$find = TRUE;
				$mail->addTo((string)$user->ref('uzivatel','uzivatel_id')->email);
			}
			$mail->setBody($latte->renderToString(__DIR__ . '/../templates/Homepage/emailEventOneday.latte', $params));
			if($find)
			{
				$mailer->send($mail);
			}
			$this->eventManager->edit(array('id' => $event->id, 'pocet_upozorneni' => $event->pocet_upozorneni--));
		}

	}

	public function renderSitemap() {
			$this->template->sitemap = $this->frontpageManager->getTable();
	}

	public function renderDefault($id = null)
	{
		if($id)
		{
			$this->template->page = $this->frontpageManager->get($id);

		}
		else {
			$this->template->page = $this->frontpageManager->getFirstAtiveFronPage()->fetch();

		}

	}
}
