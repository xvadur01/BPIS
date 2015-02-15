<?php

namespace FrontModule;
use \Nette,
	\App\Model;
use Smf\Menu;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Nette\Application\UI\Presenter
{
	/** @var Menu\Control\Factory */
    protected $menuFactory;
	public function injectMenuFactory(Menu\Control\Factory $factory)
    {
        $this->menuFactory = $factory;
    }

	/** @var \Todo\FrontpageManager */
	protected $frontpageManager;
	public function injectFrontpageManager(\App\Model\FrontpageManager $frontpageManager)
    {
        $this->frontpageManager = $frontpageManager;
    }

    function __construct(\App\Model\FrontpageManager $frontpageManager) {
		$this->frontpageManager = $frontpageManager;
    }


	public function beforeRender() {
        $this->setLayout('layout');
    }


	function startup() {
		parent::startup();
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

	protected function createComponentMenu()
    {
        $menu = $this->menuFactory->createControl();
        $root = $menu->getRoot();
		$root->setChildrenAttributes(array('class' => 'side-nav fixed','id' => 'nav-mobile'));

		$frontPage = $this->frontpageManager->getAtiveFronPage();

		foreach ($frontPage as $page)
		{
			$root->addChild($page->titulek, array(
				'label' => $page->titulek,
				'link'  => array('Homepage:default', array('id' => $page->id))
			));
		}
        return $menu;
    }


}
