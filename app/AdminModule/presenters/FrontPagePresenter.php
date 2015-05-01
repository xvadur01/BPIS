<?php

namespace AdminModule;

/**
 * Front Page Presenter
 */
class FrontPagePresenter extends BasePresenter {

	/** @var \Todo\FrontpageManager */
	private $frontpageManager;

	function __construct(\App\Model\FrontpageManager $frontpageManager) {
		$this->frontpageManager = $frontpageManager;
	}

	/**
	 * Action delele page
	 */
	public function actionDelete($pageId) {
		$this->frontpageManager->delete($pageId);
		$this->flashMessage('stranka byla úspěšně smazána.', 'success');
		$this->redirect('Frontpage:default');
	}

	/**
	 * Action edit page. Fill form to edit page.
	 */
	public function actionEdit($pageId) {
		$page = $this->frontpageManager->get($pageId);
		if (!$page) {
			$this->error('Strana nebyla nalezena');
			$this->redirect('Frontpage:default');
		}
		$page = $page->toArray();
		$this['frontPageForm']->setDefaults($page);
	}

	/**
	 * Render default. Load all pages to table.
	 */
	public function renderDefault() {
		$this->template->pages = $this->frontpageManager->getTable();
	}

	/**
	 * Create form to add and edit page.
	 */
	protected function createComponentFrontPageForm() {
		$form = $this->form();
		$form->addHidden('id', null);

		$form->addText('title', 'Titulek:')
				->setRequired('Zadejte titulek.');

		$form->addText('topic', 'Nadpis:')
				->setRequired('Zadejte nadpis.');

		$form->addTextArea('text', 'Text:')
				->setRequired('Zadejte obsah stránky.')
				->getControlPrototype()->setId('editor');

		$form->addText('weight', 'Vaha:')
				->setRequired('Zadejte vahu.');

		$form->addCheckbox('active', 'Zobrazovat:')->getControlPrototype()->class('checkbox');

		$form->addSubmit('send', 'Odeslat');
		$form->onSuccess[] = $this->frontPageFormSucceeded;
		return $form;
	}

	/**
	 * Function serve succeed page form.
	 */
	public function frontPageFormSucceeded($form) {

		$values = $form->getValues();
		$values['url'] = \Nette\Utils\Strings::webalize($values['topic']);
		if ($values['id']) {
			$this->frontpageManager->edit($values);
		} else {
			$this->frontpageManager->add($values);
		}
		$this->flashMessage('Stránka byla uložena', 'success');
		$this->redirect('Frontpage:default');
	}

}
