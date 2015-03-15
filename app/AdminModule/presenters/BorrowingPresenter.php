<?php

namespace AdminModule;

use \Nette\Application\UI\Form as Form;

/**
 * Borrowing Presenter
 */
class BorrowingPresenter extends BasePresenter {

	/** @var \Todo\BorrowingManager */
	private $borrowingManager;

	/** @persistent */
	public $backlink = '';

	/** @persistent */
	public $userId;


	function __construct(\App\Model\BorrowingManager $borrowingManager) {
		$this->borrowingManager = $borrowingManager;
	}

	public function actionAdd($userId = null)
	{
		if($userId)
		{
			$this->userId = $userId;
		}
		else
		{
			$this->userId = $this->user->getId();
		}
		$this['borrowingForm']->setDefaults(array("uzivatel_id" => $this->userId));
	}

	/**
	 *  Action delele borrow
	 * @param type $borrowingId
	 */
	public function actionDelete($borrowingId) {
		$this->borrowingManager->delete($borrowingId);
		$this->flashMessage('Výpůjčka byla úspěšně smazána.', 'success');
		$this->redirect('Borrowing:default');
	}

	/**
	 *  Action give back borrow.
	 * @param type $borrowingId
	 */
	public function actionGiveback($borrowingId) {
		$borrowing = $this->borrowingManager->giveBack($borrowingId);
		$this->flashMessage('Věc byla navrácena.', 'success');
		if($this->isAjax())
		{
			$this->redrawControl('flashMessage');
			$this->redrawControl('borrowTable');
		}
		else {
			$this->restoreRequest($this->backlink);
			$this->redirect('Borrowing:default');
		}

	}

	/**
	 *  Action edit borrow. Fill form to edit page.
	 * @param type $borrowingId
	 */
	public function actionEdit($borrowingId) {
		$borrowing = $this->borrowingManager->get($borrowingId);
		if (!$borrowing) {
			$this->error('Strana nebyla nalezena');
			$this->redirect('Borrowing:default');
		}
		$borrowing = $borrowing->toArray();
		$date = new \DateTime($borrowing['datum']);
		$borrowing['datum'] = $date->format('d F, Y');

        $this['borrowingForm']->setDefaults($borrowing);
	}

	/**
	 * Render default. Load user borrow / admin load all borrow.
	 */
	public function renderGiveback() {
		$this->setView('default');
		if ($this->user->isInRole('admin')) {
			$this->template->borrowings = $this->borrowingManager->getTable()->order(\App\Model\BorrowingManager::COLUMN_DATE . ' DESC');
		} else {
			$this->template->borrowings = $this->borrowingManager->getUserBorrow($this->user->getId())->order(\App\Model\BorrowingManager::COLUMN_DATE . ' DESC');
		}

	}

	/**
	 * Render user borrowing. Load user borrow.
	 */
	public function renderUserborrowing($userId) {
		$this->template->userId = $userId;
		$this->template->borrowings = $this->borrowingManager->getUserBorrow($userId)->order(\App\Model\BorrowingManager::COLUMN_DATE . ' DESC');
	}

	/**
	 * Render default. Load user borrow / admin load all borrow.
	 */
	public function renderDefault() {
		if ($this->user->isInRole('admin')) {
			$this->template->borrowings = $this->borrowingManager->getTable()->order(\App\Model\BorrowingManager::COLUMN_DATE . ' DESC');
		} else {
			$this->template->borrowings = $this->borrowingManager->getUserBorrow($this->user->getId())->order(\App\Model\BorrowingManager::COLUMN_DATE . ' DESC');
		}
	}

	/**
	 * Create form to add and edit borrow.
	 */
	protected function createComponentBorrowingForm() {
		$form = $this->form();
		$form->addHidden('id', null);
		$form->addHidden('uzivatel_id', null);
		$form->addText('nazev', 'Název:')
				->setRequired('Zadejte název.');

		$form->addText('jmeno', 'Jméno:')
				->setRequired('Zadejte jméno.');

		$form->addText('prijmeni', 'Příjmení:')
				->setRequired('Zadejte příjmení.');
		$form->addText('datum', 'Datum:', 20, 20)->getControlPrototype()->setClass('datepicker');

        $form->addSubmit('send', 'Odeslat');
		$form->setDefaults(array("uzivatel_id" => $this->user->getId()));
		$form->onSuccess[] = $this->borrowingSucceeded;
		return $form;
	}

	/**
	 * Function serve succeed borrowing form.
	 */
	public function borrowingSucceeded($form) {
		$values = $form->getValues();
		$date = new \DateTime($values['datum']);
		$values['datum'] = $date->format('Y-m-d H:i:s');
		if ($values['id']) {
			$this->borrowingManager->edit($values);
		} else {
			$this->borrowingManager->add($values);
		}
		$this->flashMessage('Výpůjčka byla vložena', 'success');
		$this->redirect('Borrowing:default');
	}

}
