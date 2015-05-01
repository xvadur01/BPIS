<?php

namespace AdminModule;

use \Nette\Application\UI\Form as Form;

class RecordPresenter extends BasePresenter {

	/** @var \Todo\RecordManager */
	private $recordManager;

	/** @var \ITimeLineControlFactory @inject */
	public $timeLineControlFactory;

	/** @persistent */
	public $backlink = '';
	protected $data;
	protected $type;

	function __construct(\App\Model\RecordManager $recordManager) {
		$this->recordManager = $recordManager;
	}

	protected function createComponentTimeLine() {
		$timeLine = new \TimeLineControl();
		$timeLine->setType($this->type);
		$timeLine->setData($this->data);
		return $timeLine;
	}

	public function actionDelete($recordId) {
		$record = $this->recordManager->get($recordId);
		if ($this->user->isInRole('admin') || $record->user_id == $this->user->getId()) {
			$this->recordManager->delete($recordId);
			$this->flashMessage('Záznam byl úspěšně smazán.', 'success');
			$this->restoreRequest($this->backlink);
			$this->redirect('Record:list');
		}
		$this->flashMessage('Na danou akci nemáte opřávnění.', 'error');
		$this->restoreRequest($this->backlink);
		$this->redirect('Record:list');
	}

	public function actionFinish($recordId) {
		$record = $this->recordManager->get($recordId);
		if ($this->user->isInRole('admin') || $record->user_id == $this->user->getId()) {
			$data = array('id' => $recordId, 'done' => 1);
			$this->recordManager->edit($data);
			$this->flashMessage('Úkol byl dokončen.', 'success');
			$this->restoreRequest($this->backlink);
			$this->redirect('Record:list');
		}
		$this->flashMessage('Na danou akci nemáte opřávnění.', 'error');
		$this->restoreRequest($this->backlink);
		$this->redirect('Record:list');
	}

	public function actionEdit($recordId) {
		$record = $this->recordManager->get($recordId);
		if (!$record) {
			$this->error('Záznam nebyl nalezen.');
			$this->redirect('Record:list');
		}
		if (!$this->user->isInRole('admin') && $record->user_id != $this->user->getId()) {
			$this->flashMessage('Na danou akci nemáte opřávnění.', 'error');
			$this->restoreRequest($this->backlink);
			$this->redirect('Record:list');
		}

		$record = $record->toArray();
		$date = new \DateTime($record['date']);
		$record['date'] = $date->format('d. m. Y');
		$date = new \DateTime($record['date_done']);
		$record['date_done'] = $date->format('d. m. Y');

		$this['recordForm']->setDefaults($record);
	}

	public function renderDefault($own = null) {
		if ($this->user->isInRole('admin') && $own) {
			$this->template->records = $this->recordManager->getTable()->order(\App\Model\RecordManager::COLUMN_DATE . ' DESC');
		} else {
			$this->template->records = $this->recordManager->getUserRecord($this->user->getId())->order(\App\Model\RecordManager::COLUMN_DATE . ' DESC');
		}
	}

	/**
	 * Render record detail.
	 * @param type $id
	 */
	public function renderDetail($id) {
		$record = $this->recordManager->get($id);
		$this->template->record = $record;
		$this->template->userRef = $record->ref('user');
	}

	public function renderList($own = null) {
		if ($this->user->isInRole('admin') && $own) {
			$this->data = $this->recordManager->getTable()->order(\App\Model\RecordManager::COLUMN_DATE . ' DESC');
		} else {
			$this->data = $this->recordManager->getUserRecord($this->user->getId())->order(\App\Model\RecordManager::COLUMN_DATE . ' DESC');
		}
		$this->type = "record";
	}

	protected function createComponentRecordForm() {
		$form = $this->form();
		$form->addHidden('id', null);
		$form->addHidden('user_id', null);
		$form->addText('name', 'Název:')
				->setRequired('Zadejte název.');

		$form->addTextArea('description', 'Popis:')
				->setRequired('Zadejte popis.')
				->getControlPrototype()->setId('editor');

		$form->addText('date', 'Datum:', 30, 30)->getControlPrototype()->setClass('datepicker');
		$form->addText('date_done', 'Datum splnění:', 30, 30)->getControlPrototype()->setClass('datepicker');

		$form->addSubmit('send', 'Odeslat');
		$form->setDefaults(array("user_id" => $this->user->getId()));
		$form->onSuccess[] = $this->frontRecordSucceeded;
		return $form;
	}

	public function frontRecordSucceeded($form) {

		$values = $form->getValues();

		$date = new \DateTime($_REQUEST['date_submit']);
		$values['date'] = $date->format('Y-m-d H:i:s');
		$date = new \DateTime($_REQUEST['date_done_submit']);

		if ($values['date_done']) {
			$values['date_done'] = $date->format('Y-m-d H:i:s');
		} else {
			unset($values['date_done']);
		}
		if ($values['id']) {
			$this->recordManager->edit($values);
		} else {
			$this->recordManager->add($values);
		}
		$this->flashMessage('Záznam byl vložen', 'success');
		$this->redirect('Record:list');
	}

}
