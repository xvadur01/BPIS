<?php

namespace AdminModule;

class ConfigPresenter extends BasePresenter {

	/** @var \Todo\ConfigManager */
	private $configManager;


    function __construct(\App\Model\ConfigManager $configManager) {
		$this->configManager = $configManager;
    }

	public function renderDefault() {
		$this->template->config = $this->configManager->getTable();
	}

	protected function createComponentConfigForm()
    {
        $form = $this->form();
		$form->addHidden('id', null);

        $form->addText('titulek', 'Titulek:')
            ->setRequired('Zadejte prosím titulek');

		$form->addTextArea('popis', 'Popis:')
            ->setRequired('Zadejte prosím popis')
			->getControlPrototype()->setId('editor');
		
		$form->addTextArea('metadata', 'Metadata:')
            ->setRequired('Zadejte prosím metadata')
				->getControlPrototype()->setClass('materialize-textarea');;

        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = $this->configFormSucceeded;
        return $form;
    }

    public function configFormSucceeded($form)
    {

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