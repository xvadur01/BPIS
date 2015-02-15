<?php

namespace AdminModule;
use \Nette,
	\App\Model;
use Smf\Menu;
class BasePresenter extends \Nette\Application\UI\Presenter {
	/** @var Menu\Control\Factory */
    protected $menuFactory;
	public function injectMenuFactory(Menu\Control\Factory $factory)
    {
        $this->menuFactory = $factory;
    }
    public function beforeRender() {
        $this->setLayout('layoutAdmin');
    }

	public function startup()
	{
		parent::startup();
        if (!$this->user->isLoggedIn()) {
            if ($this->user->logoutReason === \Nette\Security\IUserStorage::INACTIVITY) {
                $this->flashMessage('You have been signed out due to inactivity. Please sign in again.');
            }
            $this->redirect(':Front:Sign:in', array('backlink' => $this->storeRequest()));
        }
		$this->template->titleColor = "";
		$this->template->title = "";
	}
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

	public function handleLogOut() {
        $this->user->logout();
        $this->flashMessage('Byl jste odhlášen', 'info');
        $this->redirect(':Front:Homepage:default');

    }

	protected function createComponentMenu()
    {
        $menu = $this->menuFactory->createControl();
        $root = $menu->getRoot();
		$root->setChildrenAttributes(array('class' => 'side-nav fixed','id' => 'nav-mobile'));


		$root->addChild('home', array(
			'label' => 'Frontpage',
			'link'  => 'Frontpage:default',
        ));

		$root->addChild('home1', array(
			'label' => 'Borrowing',
			'link'  => 'Borrowing:default',
        ));

		$root->addChild('home2', array(
			'label' => 'Record',
			'link'  => 'Record:default',
        ));

		$root->addChild('home3', array(
			'label' => 'Event',
			'link'  => 'Event:default',
        ));

		$root->addChild('home4', array(
			'label' => 'User',
			'link'  => 'User:default',
        ));


        return $menu;
    }

}