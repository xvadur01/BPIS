<?php

namespace FrontModule;

use \Nette\Application\UI;
use \Nette\Mail\Message;
use \Nette\Mail\SendmailMailer;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter {

	/** @var \Todo\EventManager */
	private $eventManager;

	/** @var \Todo\TermManager */
	private $termManager;

	/** @var \Todo\UserManager */
	private $userManager;

	/** @var \Todo\BorrowingManager */
	private $recordManager;

	function __construct(\App\Model\EventManager $eventManager, \App\Model\TermManager $termManager, \App\Model\UserManager $userManager, \App\Model\RecordManager $recordManager) {
		$this->eventManager = $eventManager;
		$this->termManager = $termManager;
		$this->userManager = $userManager;

		$this->recordManager = $recordManager;
	}

	public function actionDefault($id = null) {
		if ($id) {
			$page = $this->frontpageManager->get($id);
			if ($page->active || $this->user->isInRole('admin')) {
				$this->template->page = $page;
			} else {
				$this->redirect(':Front:Homepage:');
			}
		} else {
			$this->template->page = $this->frontpageManager->getFirstAtiveFronPage()->fetch();
		}
	}

	public function actionCron() {
		$mailer = new SendmailMailer;
		$latte = new \Latte\Engine;

		$events = $this->eventManager->getEventsInSevenDays();
		foreach ($events as $key => $event) {
			$params = array(
				'event' => $event,
				'eventUser' => $event->ref('user'),
			);
			$mail = new Message;
			$mail->setFrom('no-reply@bpis.cz')
					->setSubject('Upozornění na blížící se akci');
			$eventUsers = $this->termManager->getUsersOfEvent($event->id);
			$find = FALSE;
			foreach ($eventUsers as $user) {
				$find = TRUE;
				$mail->addTo((string) $user->ref('user', 'user_id')->email);
			}

			$mail->setHTMLBody($latte->renderToString(__DIR__ . '/../templates/Homepage/emailEventSevenday.latte', $params));
			if ($find) {
				$mailer->send($mail);
			}
			$this->eventManager->edit(array('id' => $event->id, 'number_alert' => $event->number_alert - 1));
		}
		$events = $this->eventManager->getEventsInOneDays();
		foreach ($events as $key => $event) {
			$params = array(
				'event' => $event,
				'eventUser' => $event->ref('user'),
			);
			$mail = new Message;
			$mail->setFrom('no-reply@bpis.cz')
					->setSubject('Upozornění na blížící se akci');

			$eventUsers = $this->termManager->getUsersOfEvent($event->id)->where(\App\Model\TermManager::COLUMN_ALLOW, 1);

			$find = FALSE;
			foreach ($eventUsers as $user) {
				$find = TRUE;
				$mail->addTo((string) $user->ref('user', 'user_id')->email);
			}
			$mail->setHTMLBody($latte->renderToString(__DIR__ . '/../templates/Homepage/emailEventOneday.latte', $params));
			if ($find) {
				$mailer->send($mail);
			}
			$this->eventManager->edit(array('id' => $event->id, 'number_alert' => 0));
		}
	}
	public function renderSitemap() {
		$this->template->sitemap = $this->frontpageManager->getAtiveFronPage();
	}
}
