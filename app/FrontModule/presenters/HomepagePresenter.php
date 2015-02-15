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

	public function renderSitemap() {
			$this->template->sitemap = $this->frontpageManager->getTable();
	}

	public function renderDefault($id = null)
	{
		if($id)
		{
			$this->template->page = $this->frontpageManager->get($id);

		}
		else {
			$this->template->page = $this->frontpageManager->getFirstAtiveFronPage()->fetch();

		}
		$this->template->test = $this->configManager->getTable();
	}
}
