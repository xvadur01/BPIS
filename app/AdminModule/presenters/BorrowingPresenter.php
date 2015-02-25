<?php

namespace AdminModule;
use \Nette\Application\UI\Form as Form;
class BorrowingPresenter extends BasePresenter {

	/** @var \Todo\BorrowingManager */
	private $borrowingManager;

	/** @persistent */
    public $backlink = '';

    function __construct(\App\Model\BorrowingManager $borrowingManager) {
		$this->borrowingManager = $borrowingManager;
    }

	public function actionDelete($borrowingId)
    {
		$this->borrowingManager->delete($borrowingId);
		$this->flashMessage('stranka byla úspěšně smazána.', 'success');
        $this->redirect('Borrowing:default');
    }

	public function actionGiveback($borrowingId)
    {
        $borrowing = $this->borrowingManager->giveBack($borrowingId);
		$this->flashMessage('Vec byla navracena.', 'success');
		$this->restoreRequest($this->backlink);
		$this->redirect('Borrowing:default');
    }

	public function actionEdit($borrowingId)
    {
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

	public function renderDefault() {
		if($this->user->isInRole('admin'))
		{
			$this->template->borrowings = $this->borrowingManager->getTable();
		}
		else
		{
			$this->template->borrowings = $this->borrowingManager->getUserBorrow($this->user->getId());
		}
	}


	protected function createComponentBorrowingForm()
    {
        $form = $this->form();
		$form->addHidden('id', null);
		$form->addHidden('uzivatel_id', null);
        $form->addText('nazev', 'Název:')
            ->setRequired();

		$form->addText('jmeno', 'Jméno:')
            ->setRequired();

		$form->addText('prijmeni', 'Příjmení:')
            ->setRequired();
		$form->addText('datum', 'Datum:', 20, 20)->getControlPrototype()->setClass('datepicker');

        $form->addSubmit('send', 'Odeslat');
		$form->setDefaults(array("uzivatel_id" => $this->user->getId()));
        $form->onSuccess[] = $this->borrowingSucceeded;
        return $form;
    }

    public function borrowingSucceeded($form)
    {

        $values = $form->getValues();

		$date = new \DateTime($values['datum']);
		$values['datum'] = $date->format('Y-m-d H:i:s');
		if ($values['id']) {
			$this->borrowingManager->edit($values);
        } else {
            $this->borrowingManager->add($values);
        }
        $this->flashMessage('Výpujdčka byla vlozena', 'success');
        $this->redirect('Borrowing:default');
    }
}