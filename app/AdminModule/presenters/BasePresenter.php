<?php
namespace AdminModule;

use \Nette,
	\App\Model;
use Smf\Menu;

/**
 * Base Presenter
 */
class BasePresenter extends \Nette\Application\UI\Presenter {

	/** @var Menu\Control\Factory */
	protected $menuFactory;

	/**
	 * function to inject instance Menu Factory
	 * @param \Smf\Menu\Control\Factory $factory
	 */
	public function injectMenuFactory(Menu\Control\Factory $factory) {
		$this->menuFactory = $factory;
	}

	/**
	 * Before render default set admin template.
	 */
	public function beforeRender() {
		$this->setLayout('layoutAdmin');
	}

	/**
	 * Startup check if user is login.
	 */
	public function startup() {
		parent::startup();
		if (!$this->user->isLoggedIn()) {
			if ($this->user->logoutReason === \Nette\Security\IUserStorage::INACTIVITY) {
				$this->flashMessage('Pro nečinost došlo k odhlášení. Prosím přihlašte se znovu.');
			}
			$this->redirect(':Front:Sign:in', array('backlink' => $this->storeRequest()));
		}
		$this->template->titleColor = "";
		$this->template->title = "";
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
		$renderer->wrappers['control']['.submit'] = 'btn btn-default blue white-text';
		// make form and controls compatible with Twitter Bootstrap
		$form->getElementPrototype()->class('col s12');
		foreach ($form->getControls() as $control) {
			if ($control instanceof Controls\Button) {
				$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
				$usedPrimary = TRUE;
			} elseif ($control instanceof \Controls\TextBase || $control instanceof \Controls\SelectBox || $control instanceof \Controls\MultiSelectBox) {
				$control->getControlPrototype()->addClass('form-control');
			} elseif ($control instanceof \Controls\Checkbox || $control instanceof \Controls\CheckboxList || $control instanceof \Controls\RadioList) {

				$control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
			}
		}

		return $form;
	}

	/**
	 * Hadle to log out.
	 */
	public function handleLogOut() {
		$this->user->logout();
		$this->flashMessage('Byl jste odhlášen', 'info');
		$this->redirect(':Front:Homepage:default');
	}

	/**
	 * Create navigate menu.
	 * @return  Smf\Menu
	 */
	protected function createComponentMenu() {
		$menu = $this->menuFactory->createControl();
		$root = $menu->getRoot();
		$root->setChildrenAttributes(array('class' => 'side-nav fixed', 'id' => 'nav-mobile'));

		$root->addChild('home', array(
			'label' => 'Home',
			'link' => 'Admin:default',
		));

		if ($this->user->isInRole('admin')) {
			$root->addChild('Frontpage', array(
				'label' => 'Veřejná část',
				'link' => 'Frontpage:default',
			));
		}
		if ($this->user->isInRole('admin')) {
			$root->addChild('Config', array(
				'label' => 'Nastavení systému',
				'link' => 'Config:default',
			));
		}

		$root->addChild('borrowing', array(
			'label' => 'Výpůjčky',
			'link' => 'Borrowing:default',
		));

		$root->addChild('records', array(
			'label' => 'Záznamy',
			'link' => 'Record:list',
		));

		$root->addChild('events', array(
			'label' => 'Události',
			'link' => 'Event:list',
		));


		$root->addChild('users', array(
			'label' => 'Uživatelé',
			'link' => 'User:default',
		));
		return $menu;
	}

}
