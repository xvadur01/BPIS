<?php

namespace FrontModule;

use \Nette,
	\App\Model;
use Smf\Menu;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Nette\Application\UI\Presenter {

	/** @var Menu\Control\Factory */
	protected $menuFactory;

	public function injectMenuFactory(Menu\Control\Factory $factory) {
		$this->menuFactory = $factory;
	}

	/** @var \Todo\FrontpageManager */
	protected $frontpageManager;

	/** @var \App\Model\ConfigManager */
	private $configManager;

	/**
	 * function to inject instance frontpageManager and configManager
	 * @param \Smf\Menu\Control\Factory $factory
	 */
	public function injectFrontpageManager(\App\Model\FrontpageManager $frontpageManager, \App\Model\ConfigManager $configManager) {
		$this->frontpageManager = $frontpageManager;
		$this->configManager = $configManager;
	}

	/**
	 * Before render default set admin template.
	 */
	public function beforeRender() {
		$this->template->config = $this->configManager->getTable()->limit(1)->fetch();
		$this->setLayout('layout');
	}

	/**
	 * Startup check if user is login.
	 */
	function startup() {
		parent::startup();
	}

	/**
	 * Prepare form renderer for CSS framework.
	 * @return \Nette\Application\UI\Form
	 */
	protected function form() {
		$form = new \Nette\Application\UI\Form;

		// setup form rendering
		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = NULL;
		$renderer->wrappers['pair']['container'] = 'div class="row input-field col s12"';
		$renderer->wrappers['pair']['.error'] = 'has-error';
		$renderer->wrappers['control']['container'] = '';
		$renderer->wrappers['label']['container'] = '';
		$renderer->wrappers['control']['description'] = 'span class=help-block';
		$renderer->wrappers['control']['errorcontainer'] = 'span class=help-block';

		// make form and controls compatible with Twitter Bootstrap
		$form->getElementPrototype()->class('col s12');
		foreach ($form->getControls() as $control) {
			if ($control instanceof Controls\Button) {
				$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
				$usedPrimary = TRUE;
			} elseif ($control instanceof Controls\TextBase || $control instanceof Controls\SelectBox || $control instanceof Controls\MultiSelectBox) {
				$control->getControlPrototype()->addClass('form-control');
			} elseif ($control instanceof Controls\Checkbox || $control instanceof Controls\CheckboxList || $control instanceof Controls\RadioList) {
				$control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
			}
		}

		return $form;
	}

	/**
	 * Create navigate menu.
	 * @return  Smf\Menu
	 */
	protected function createComponentMenu() {
		$menu = $this->menuFactory->createControl();
		$root = $menu->getRoot();
		$root->setChildrenAttributes(array('class' => 'side-nav fixed', 'id' => 'nav-mobile'));

		$frontPage = $this->frontpageManager->getAtiveFronPage();

		$logo = $root->addChild('home', array(
			'label' => '',
			'link' => 'Homepage:default',
		));
		$logo->setAttribute('class', 'logo')->setLinkAttribute('class', 'brand-logo');
		//addAttribute('class','test');
		foreach ($frontPage as $page) {
			$root->addChild($page->title, array(
				'label' => $page->title,
				'link' => array('Homepage:default', array('id' => $page->id))
			));
		}
		return $menu;
	}

}
