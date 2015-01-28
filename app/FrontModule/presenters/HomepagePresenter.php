<?php

namespace FrontModule;
use \Nette\Application\UI;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
	/** @var \App\Model\ConfigManager */
	private $configManager;

	public function __construct(\App\Model\ConfigManager $configManager) {
		$this->configManager = $configManager;
	}

	public function renderDefault()
	{
		$this->template->test = $this->configManager->getTable();
		$this->template->anyVariable = 'any value';
	}

	 protected function createComponentTestForm()
    {
         $form = $this->form();

        $form->addText('name', 'Jméno:')
            ->setRequired();

        $form->addTextArea('body', 'Komentář:')
            ->setRequired();

        $form->addSubmit('send', 'Publikovat komentář');
        return $form;
    }

}
