<?php

namespace AdminModule;
use \Nette\Application\UI\Form as Form;
class RecordPresenter extends BasePresenter {

	/** @var \Todo\RecordManager */
	private $recordManager;
	/** @var \ITimeLineControlFactory @inject */
    public $timeLineControlFactory;

	protected $data;
	protected $type;

    function __construct(\App\Model\RecordManager $recordManager) {
		$this->recordManager = $recordManager;
    }


    protected function createComponentTimeLine()
    {
		$timeLine = new \TimeLineControl();
		$timeLine->setType($this->type);
		$timeLine->setData($this->data);
        return $timeLine;
    }

	public function actionDelete($recordId)
    {
		$this->recordManager->delete($recordId);
		$this->flashMessage('stranka byla úspěšně smazána.', 'success');
        $this->redirect('Record:list');
    }

	public function actionFinish($recordId)
    {
		$data = array('id' =>$recordId, 'splneno' => 1 );
		$this->recordManager->edit($data);
		$this->flashMessage('Úkol byl dokončen.', 'success');
        $this->redirect('Record:list');
    }

	public function actionEdit($recordId)
    {
        $record = $this->recordManager->get($recordId);
        if (!$record) {
            $this->error('Strana nebyla nalezena');
			$this->redirect('Record:default');
        }
		$record = $record->toArray();
		$date = new \DateTime($record['datum']);
		$record['datum'] = $date->format('d F, Y');
		$date = new \DateTime($record['datum_splneni']);
		$record['datum_splneni'] = $date->format('d F, Y');

        $this['recordForm']->setDefaults($record);
    }

	public function renderDefault($own = null) {
		if($this->user->isInRole('admin') && $own)
		{
			$this->template->records = $this->recordManager->getTable()->order(\App\Model\RecordManager::COLUMN_DATE.' DESC');
		}
		else
		{
			$this->template->records = $this->recordManager->getUserRecord($this->user->getId())->order(\App\Model\RecordManager::COLUMN_DATE.' DESC');
		}
	}

	public function renderList($own = null)
	{
		if($this->user->isInRole('admin') && $own)
		{
			$this->data = $this->recordManager->getTable()->order(\App\Model\RecordManager::COLUMN_DATE.' DESC');
		}
		else
		{
			$this->data = $this->recordManager->getUserRecord($this->user->getId())->order(\App\Model\RecordManager::COLUMN_DATE.' DESC');
		}
		$this->type = "record";
	}

	protected function createComponentRecordForm()
    {
        $form = $this->form();
		$form->addHidden('id', null);
		$form->addHidden('uzivatel_id', null);
        $form->addText('nazev', 'Název:')
            ->setRequired();

		$form->addTextArea('popis', 'Popis:')
            ->setRequired()
			->getControlPrototype()->setId('editor');

		$form->addText('datum', 'Datum:', 30, 30)->getControlPrototype()->setClass('datepicker');
		$form->addText('datum_splneni', 'Datum splnění:', 30, 30)->getControlPrototype()->setClass('datepicker');

        $form->addSubmit('send', 'Odeslat');
		$form->setDefaults(array("uzivatel_id" => $this->user->getId()));
        $form->onSuccess[] = $this->frontRecordSucceeded;
        return $form;
    }

    public function frontRecordSucceeded($form)
    {

        $values = $form->getValues();

		$date = new \DateTime($values['datum']);
		$values['datum'] = $date->format('Y-m-d H:i:s');
		$date = new \DateTime($values['datum_splneni']);
		$values['datum_splneni'] = $date->format('Y-m-d H:i:s');
		if ($values['id']) {
			$this->recordManager->edit($values);
        } else {
            $this->recordManager->add($values);
        }
        $this->flashMessage('Partner byl vlozen', 'success');
        $this->redirect('Record:list');
    }
}