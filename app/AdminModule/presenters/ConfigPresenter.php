<?php

namespace AdminModule;

/**
 * ConfigPresenter
 */
class ConfigPresenter extends BasePresenter {

	/** @var \Todo\ConfigManager */
	private $configManager;

	function __construct(\App\Model\ConfigManager $configManager) {
		$this->configManager = $configManager;
	}

	/**
	 * Render default. Load all pages to table.
	 */
	public function renderDefault() {
		$config = $this->configManager->getTable()->limit(1)->fetch();
		if($config)
		{
			$this['configForm']->setDefaults($config);
		}
	}

	/**
	 * Create form to add and edit page.
	 */
	protected function createComponentConfigForm() {
		$form = $this->form();
		$form->addHidden('id', null);

		$form->addText('title', 'Titulek:')
				->setRequired('Zadejte prosím titulek');

		$form->addTextArea('description', 'Popis:')
				->setRequired('Zadejte prosím popis')
				->getControlPrototype()->setClass('materialize-textarea');

		$form->addTextArea('metadata', 'Metadata:')
				->setRequired('Zadejte prosím metadata')
				->getControlPrototype()->setClass('materialize-textarea');

		$form->addSubmit('send', 'Odeslat');
		$form->onSuccess[] = $this->configFormSucceeded;
		return $form;
	}

	/**
	 * Function serve succeed congig form.
	 */
	public function configFormSucceeded($form) {
		$values = $form->getValues();
		if ($values['id']) {
			$this->configManager->edit($values);
		} else {
			$this->configManager->add($values);
		}
		$this->flashMessage('Nastavení bylo uloženo', 'success');
		$this->redirect('Config:default');
	}

}
