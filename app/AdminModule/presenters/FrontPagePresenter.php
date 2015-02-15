<?php

namespace AdminModule;

class FrontPagePresenter extends BasePresenter {

	/** @var \Todo\FrontpageManager */
	private $frontpageManager;


    function __construct(\App\Model\FrontpageManager $frontpageManager) {
		$this->frontpageManager = $frontpageManager;
    }

	public function actionDelete($pageId)
    {
		$this->frontpageManager->delete($pageId);
		$this->flashMessage('stranka byla úspěšně smazána.', 'success');
        $this->redirect('Frontpage:default');
    }

	public function actionEdit($pageId)
    {
        $page = $this->frontpageManager->get($pageId);
        if (!$page) {
            $this->error('Strana nebyla nalezena');
			$this->redirect('Frontpage:default');
        }
		$page = $page->toArray();
        $this['frontPageForm']->setDefaults($page);
    }

	public function renderDefault() {
		$this->template->pages = $this->frontpageManager->getTable();
	}

	protected function createComponentFrontPageForm()
    {
        $form = new \Nette\Application\UI\Form;
		$form->addHidden('id', null);

        $form->addText('titulek', 'Titulek:')
            ->setRequired();

		$form->addText('nadpis', 'Nadpis:')
            ->setRequired();

		$form->addTextArea('text', 'Text:')
            ->setRequired()
			->getControlPrototype()->setId('editor');

		$form->addCheckbox('aktivni', 'Aktivní:');

        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = $this->frontPageFormSucceeded;
        return $form;
    }

    public function frontPageFormSucceeded($form)
    {

        $values = $form->getValues();
		$values['url'] = \Nette\Utils\Strings::webalize($values['nadpis']);
		if ($values['id']) {
			$this->frontpageManager->edit($values);
        } else {
            $this->frontpageManager->add($values);
        }
        $this->flashMessage('Partner byl vlozen', 'success');
        $this->redirect('Frontpage:default');
    }
}