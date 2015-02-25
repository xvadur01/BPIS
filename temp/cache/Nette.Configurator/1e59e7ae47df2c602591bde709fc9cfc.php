<?php
// source: C:\xampp\htdocs\BPIS\app/config/config.neon 
// source: C:\xampp\htdocs\BPIS\app/config/config.local.neon 

/**
 * @property Nette\Application\Application $application
 * @property Nette\Caching\Storages\FileStorage $cacheStorage
 * @property Nette\DI\Container $container
 * @property Nette\Http\Request $httpRequest
 * @property Nette\Http\Response $httpResponse
 * @property Nette\Bridges\Framework\NetteAccessor $nette
 * @property Nette\Application\IRouter $router
 * @property Nette\Http\Session $session
 * @property Nette\Security\User $user
 */
class SystemContainer extends Nette\DI\Container
{

	protected $meta = array(
		'types' => array(
			'nette\\object' => array(
				'nette',
				'nette.cacheJournal',
				'cacheStorage',
				'nette.httpRequestFactory',
				'httpRequest',
				'httpResponse',
				'nette.httpContext',
				'session',
				'nette.userStorage',
				'user',
				'application',
				'nette.presenterFactory',
				'nette.mailer',
				'nette.templateFactory',
				'nette.database.default',
				'nette.database.default.context',
				'smfMenu.rendererManager',
				'30_App_Model_BorrowingManager',
				'31_App_Model_ConfigManager',
				'32_App_Model_EventManager',
				'33_App_Model_FrontpageManager',
				'34_App_Model_RecordManager',
				'35_App_Model_TermManager',
				'36_App_Model_UserManager',
				'container',
			),
			'nette\\bridges\\framework\\netteaccessor' => array('nette'),
			'nette\\caching\\storages\\ijournal' => array('nette.cacheJournal'),
			'nette\\caching\\storages\\filejournal' => array('nette.cacheJournal'),
			'nette\\caching\\istorage' => array('cacheStorage'),
			'nette\\caching\\storages\\filestorage' => array('cacheStorage'),
			'nette\\http\\requestfactory' => array('nette.httpRequestFactory'),
			'nette\\http\\irequest' => array('httpRequest'),
			'nette\\http\\request' => array('httpRequest'),
			'nette\\http\\iresponse' => array('httpResponse'),
			'nette\\http\\response' => array('httpResponse'),
			'nette\\http\\context' => array('nette.httpContext'),
			'nette\\http\\session' => array('session'),
			'nette\\security\\iuserstorage' => array('nette.userStorage'),
			'nette\\http\\userstorage' => array('nette.userStorage'),
			'nette\\security\\user' => array('user'),
			'nette\\application\\application' => array('application'),
			'nette\\application\\ipresenterfactory' => array('nette.presenterFactory'),
			'nette\\application\\presenterfactory' => array('nette.presenterFactory'),
			'nette\\application\\irouter' => array('router'),
			'nette\\mail\\imailer' => array('nette.mailer'),
			'nette\\mail\\sendmailmailer' => array('nette.mailer'),
			'nette\\bridges\\applicationlatte\\ilattefactory' => array('nette.latteFactory'),
			'nette\\application\\ui\\itemplatefactory' => array('nette.templateFactory'),
			'nette\\bridges\\applicationlatte\\templatefactory' => array('nette.templateFactory'),
			'nette\\database\\connection' => array('nette.database.default'),
			'nette\\database\\context' => array('nette.database.default.context'),
			'knp\\menu\\factory\\extensioninterface' => array('smfMenu.extension'),
			'smf\\menu\\menuextension' => array('smfMenu.extension'),
			'knp\\menu\\factoryinterface' => array('smfMenu.factory'),
			'knp\\menu\\menufactory' => array('smfMenu.factory'),
			'smf\\menu\\renderer\\imanager' => array('smfMenu.rendererManager'),
			'smf\\menu\\renderer\\manager' => array('smfMenu.rendererManager'),
			'smf\\menu\\control\\factory' => array('smfMenu.controlFactory'),
			'smf\\menu\\matcher\\imatcher' => array('smfMenu.matcher'),
			'knp\\menu\\matcher\\matcherinterface' => array('smfMenu.matcher'),
			'smf\\menu\\matcher\\matcher' => array('smfMenu.matcher'),
			'knp\\menu\\renderer\\renderer' => array(
				'smfMenu.renderer_list',
				'smfMenu.renderer_bootstrapNav',
			),
			'smf\\menu\\renderer\\irenderer' => array(
				'smfMenu.renderer_list',
				'smfMenu.renderer_bootstrapNav',
			),
			'knp\\menu\\renderer\\rendererinterface' => array(
				'smfMenu.renderer_list',
				'smfMenu.renderer_bootstrapNav',
			),
			'smf\\menu\\renderer\\listrenderer' => array(
				'smfMenu.renderer_list',
				'smfMenu.renderer_bootstrapNav',
			),
			'smf\\menu\\renderer\\bootstrapnavrenderer' => array('smfMenu.renderer_bootstrapNav'),
			'smf\\menu\\matcher\\voter\\ivoter' => array('smfMenu.presenterVoter'),
			'knp\\menu\\matcher\\voter\\voterinterface' => array('smfMenu.presenterVoter'),
			'smf\\menu\\matcher\\voter\\presentervoter' => array('smfMenu.presenterVoter'),
			'app\\model\\basemanager' => array(
				'30_App_Model_BorrowingManager',
				'31_App_Model_ConfigManager',
				'32_App_Model_EventManager',
				'33_App_Model_FrontpageManager',
				'34_App_Model_RecordManager',
				'35_App_Model_TermManager',
				'36_App_Model_UserManager',
			),
			'app\\model\\borrowingmanager' => array('30_App_Model_BorrowingManager'),
			'app\\model\\configmanager' => array('31_App_Model_ConfigManager'),
			'app\\model\\eventmanager' => array('32_App_Model_EventManager'),
			'app\\model\\frontpagemanager' => array('33_App_Model_FrontpageManager'),
			'app\\model\\recordmanager' => array('34_App_Model_RecordManager'),
			'app\\model\\termmanager' => array('35_App_Model_TermManager'),
			'nette\\security\\iauthenticator' => array('36_App_Model_UserManager'),
			'app\\model\\usermanager' => array('36_App_Model_UserManager'),
			'app\\routerfactory' => array('37_App_RouterFactory'),
			'ieventplanningcontrolfactory' => array('38_IEventPlanningControlFactory'),
			'itimelinecontrolfactory' => array('39_ITimeLineControlFactory'),
			'nette\\di\\container' => array('container'),
		),
		'tags' => array(
			'menuVoter' => array('smfMenu.presenterVoter' => TRUE),
			'menuRenderer' => array(
				'smfMenu.renderer_bootstrapNav' => 'bootstrapNav',
				'smfMenu.renderer_list' => 'list',
			),
		),
	);


	public function __construct()
	{
		parent::__construct(array(
			'appDir' => 'C:\\xampp\\htdocs\\BPIS\\app',
			'wwwDir' => 'C:\\xampp\\htdocs\\BPIS\\www',
			'debugMode' => TRUE,
			'productionMode' => FALSE,
			'environment' => 'development',
			'consoleMode' => FALSE,
			'container' => array(
				'class' => 'SystemContainer',
				'parent' => 'Nette\\DI\\Container',
				'accessors' => TRUE,
			),
			'tempDir' => 'C:\\xampp\\htdocs\\BPIS\\app/../temp',
		));
	}


	/**
	 * @return App\Model\BorrowingManager
	 */
	public function createService__30_App_Model_BorrowingManager()
	{
		$service = new App\Model\BorrowingManager($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return App\Model\ConfigManager
	 */
	public function createService__31_App_Model_ConfigManager()
	{
		$service = new App\Model\ConfigManager($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return App\Model\EventManager
	 */
	public function createService__32_App_Model_EventManager()
	{
		$service = new App\Model\EventManager($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return App\Model\FrontpageManager
	 */
	public function createService__33_App_Model_FrontpageManager()
	{
		$service = new App\Model\FrontpageManager($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return App\Model\RecordManager
	 */
	public function createService__34_App_Model_RecordManager()
	{
		$service = new App\Model\RecordManager($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return App\Model\TermManager
	 */
	public function createService__35_App_Model_TermManager()
	{
		$service = new App\Model\TermManager($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return App\Model\UserManager
	 */
	public function createService__36_App_Model_UserManager()
	{
		$service = new App\Model\UserManager($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return App\RouterFactory
	 */
	public function createService__37_App_RouterFactory()
	{
		$service = new App\RouterFactory($this->getService('33_App_Model_FrontpageManager'));
		return $service;
	}


	/**
	 * @return IEventPlanningControlFactory
	 */
	public function createService__38_IEventPlanningControlFactory()
	{
		return new SystemContainer_IEventPlanningControlFactoryImpl_38_IEventPlanningControlFactory($this);
	}


	/**
	 * @return ITimeLineControlFactory
	 */
	public function createService__39_ITimeLineControlFactory()
	{
		return new SystemContainer_ITimeLineControlFactoryImpl_39_ITimeLineControlFactory($this);
	}


	/**
	 * @return Nette\Application\Application
	 */
	public function createServiceApplication()
	{
		$service = new Nette\Application\Application($this->getService('nette.presenterFactory'), $this->getService('router'), $this->getService('httpRequest'), $this->getService('httpResponse'));
		$service->catchExceptions = FALSE;
		$service->errorPresenter = 'Error';
		Nette\Bridges\ApplicationTracy\RoutingPanel::initializePanel($service);
		Tracy\Debugger::getBar()->addPanel(new Nette\Bridges\ApplicationTracy\RoutingPanel($this->getService('router'), $this->getService('httpRequest'), $this->getService('nette.presenterFactory')));
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\FileStorage
	 */
	public function createServiceCacheStorage()
	{
		$service = new Nette\Caching\Storages\FileStorage('C:\\xampp\\htdocs\\BPIS\\app/../temp/cache', $this->getService('nette.cacheJournal'));
		return $service;
	}


	/**
	 * @return Nette\DI\Container
	 */
	public function createServiceContainer()
	{
		return $this;
	}


	/**
	 * @return Nette\Http\Request
	 */
	public function createServiceHttpRequest()
	{
		$service = $this->getService('nette.httpRequestFactory')->createHttpRequest();
		if (!$service instanceof Nette\Http\Request) {
			throw new Nette\UnexpectedValueException('Unable to create service \'httpRequest\', value returned by factory is not Nette\\Http\\Request type.');
		}
		return $service;
	}


	/**
	 * @return Nette\Http\Response
	 */
	public function createServiceHttpResponse()
	{
		$service = new Nette\Http\Response;
		return $service;
	}


	/**
	 * @return Nette\Bridges\Framework\NetteAccessor
	 */
	public function createServiceNette()
	{
		$service = new Nette\Bridges\Framework\NetteAccessor($this);
		return $service;
	}


	/**
	 * @return Nette\Caching\Cache
	 */
	public function createServiceNette__cache($namespace = NULL)
	{
		$service = new Nette\Caching\Cache($this->getService('cacheStorage'), $namespace);
		trigger_error('Service cache is deprecated.', 16384);
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\FileJournal
	 */
	public function createServiceNette__cacheJournal()
	{
		$service = new Nette\Caching\Storages\FileJournal('C:\\xampp\\htdocs\\BPIS\\app/../temp');
		return $service;
	}


	/**
	 * @return Nette\Database\Connection
	 */
	public function createServiceNette__database__default()
	{
		$service = new Nette\Database\Connection('mysql:host=localhost;dbname=bpis', 'root', NULL, array('lazy' => TRUE));
		Tracy\Debugger::getBlueScreen()->addPanel('Nette\\Bridges\\DatabaseTracy\\ConnectionPanel::renderException');
		Nette\Database\Helpers::createDebugPanel($service, TRUE, 'default');
		return $service;
	}


	/**
	 * @return Nette\Database\Context
	 */
	public function createServiceNette__database__default__context()
	{
		$service = new Nette\Database\Context($this->getService('nette.database.default'), new Nette\Database\Reflection\DiscoveredReflection($this->getService('nette.database.default'), $this->getService('cacheStorage')), $this->getService('cacheStorage'));
		return $service;
	}


	/**
	 * @return Nette\Http\Context
	 */
	public function createServiceNette__httpContext()
	{
		$service = new Nette\Http\Context($this->getService('httpRequest'), $this->getService('httpResponse'));
		return $service;
	}


	/**
	 * @return Nette\Http\RequestFactory
	 */
	public function createServiceNette__httpRequestFactory()
	{
		$service = new Nette\Http\RequestFactory;
		$service->setProxy(array());
		return $service;
	}


	/**
	 * @return Latte\Engine
	 */
	public function createServiceNette__latte()
	{
		$service = new Latte\Engine;
		$service->setTempDirectory('C:\\xampp\\htdocs\\BPIS\\app/../temp/cache/latte');
		$service->setAutoRefresh(TRUE);
		$service->setContentType('html');
		return $service;
	}


	/**
	 * @return Nette\Bridges\ApplicationLatte\ILatteFactory
	 */
	public function createServiceNette__latteFactory()
	{
		return new SystemContainer_Nette_Bridges_ApplicationLatte_ILatteFactoryImpl_nette_latteFactory($this);
	}


	/**
	 * @return Nette\Mail\SendmailMailer
	 */
	public function createServiceNette__mailer()
	{
		$service = new Nette\Mail\SendmailMailer;
		return $service;
	}


	/**
	 * @return Nette\Application\PresenterFactory
	 */
	public function createServiceNette__presenterFactory()
	{
		$service = new Nette\Application\PresenterFactory('C:\\xampp\\htdocs\\BPIS\\app', $this);
		return $service;
	}


	/**
	 * @return Nette\Templating\FileTemplate
	 */
	public function createServiceNette__template()
	{
		$service = new Nette\Templating\FileTemplate;
		$service->registerFilter($this->getService('nette.latteFactory')->create());
		$service->registerHelperLoader('Nette\\Templating\\Helpers::loader');
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\PhpFileStorage
	 */
	public function createServiceNette__templateCacheStorage()
	{
		$service = new Nette\Caching\Storages\PhpFileStorage('C:\\xampp\\htdocs\\BPIS\\app/../temp/cache', $this->getService('nette.cacheJournal'));
		trigger_error('Service templateCacheStorage is deprecated.', 16384);
		return $service;
	}


	/**
	 * @return Nette\Bridges\ApplicationLatte\TemplateFactory
	 */
	public function createServiceNette__templateFactory()
	{
		$service = new Nette\Bridges\ApplicationLatte\TemplateFactory($this->getService('nette.latteFactory'), $this->getService('httpRequest'), $this->getService('httpResponse'), $this->getService('user'), $this->getService('cacheStorage'));
		return $service;
	}


	/**
	 * @return Nette\Http\UserStorage
	 */
	public function createServiceNette__userStorage()
	{
		$service = new Nette\Http\UserStorage($this->getService('session'));
		return $service;
	}


	/**
	 * @return Nette\Application\IRouter
	 */
	public function createServiceRouter()
	{
		$service = $this->getService('37_App_RouterFactory')->createRouter();
		if (!$service instanceof Nette\Application\IRouter) {
			throw new Nette\UnexpectedValueException('Unable to create service \'router\', value returned by factory is not Nette\\Application\\IRouter type.');
		}
		return $service;
	}


	/**
	 * @return Nette\Http\Session
	 */
	public function createServiceSession()
	{
		$service = new Nette\Http\Session($this->getService('httpRequest'), $this->getService('httpResponse'));
		$service->setExpiration('14 days');
		return $service;
	}


	/**
	 * @return Smf\Menu\Control\Factory
	 */
	public function createServiceSmfMenu__controlFactory()
	{
		$service = new Smf\Menu\Control\Factory($this->getService('smfMenu.factory'), $this->getService('smfMenu.rendererManager'));
		return $service;
	}


	/**
	 * @return Smf\Menu\MenuExtension
	 */
	public function createServiceSmfMenu__extension()
	{
		$service = new Smf\Menu\MenuExtension;
		return $service;
	}


	/**
	 * @return Knp\Menu\MenuFactory
	 */
	public function createServiceSmfMenu__factory()
	{
		$service = new Knp\Menu\MenuFactory;
		$service->addExtension($this->getService('smfMenu.extension'));
		return $service;
	}


	/**
	 * @return Smf\Menu\Matcher\Matcher
	 */
	public function createServiceSmfMenu__matcher()
	{
		$service = new Smf\Menu\Matcher\Matcher;
		Smf\Menu\Config\Extension::setupVoters($service, $this);
		return $service;
	}


	/**
	 * @return Smf\Menu\Matcher\Voter\PresenterVoter
	 */
	public function createServiceSmfMenu__presenterVoter()
	{
		$service = new Smf\Menu\Matcher\Voter\PresenterVoter;
		return $service;
	}


	/**
	 * @return Smf\Menu\Renderer\Manager
	 */
	public function createServiceSmfMenu__rendererManager()
	{
		$service = new Smf\Menu\Renderer\Manager;
		Smf\Menu\Config\Extension::setupRenderers($service, $this);
		$service->setDefaultRenderer('bootstrapNav');
		return $service;
	}


	/**
	 * @return Smf\Menu\Renderer\BootstrapNavRenderer
	 */
	public function createServiceSmfMenu__renderer_bootstrapNav()
	{
		$service = new Smf\Menu\Renderer\BootstrapNavRenderer($this->getService('smfMenu.matcher'));
		return $service;
	}


	/**
	 * @return Smf\Menu\Renderer\ListRenderer
	 */
	public function createServiceSmfMenu__renderer_list()
	{
		$service = new Smf\Menu\Renderer\ListRenderer($this->getService('smfMenu.matcher'));
		return $service;
	}


	/**
	 * @return Nette\Security\User
	 */
	public function createServiceUser()
	{
		$service = new Nette\Security\User($this->getService('nette.userStorage'), $this->getService('36_App_Model_UserManager'));
		Tracy\Debugger::getBar()->addPanel(new Nette\Bridges\SecurityTracy\UserPanel($service));
		return $service;
	}


	public function initialize()
	{
		date_default_timezone_set('Europe/Prague');
		Nette\Caching\Storages\FileStorage::$useDirectories = TRUE;
		$this->getByType("Nette\Http\Session")->exists() && $this->getByType("Nette\Http\Session")->start();
		header('X-Frame-Options: SAMEORIGIN');
		header('X-Powered-By: Nette Framework');
		header('Content-Type: text/html; charset=utf-8');
		Nette\Utils\SafeStream::register();
		Nette\Reflection\AnnotationsParser::setCacheStorage($this->getByType("Nette\Caching\IStorage"));
		Nette\Reflection\AnnotationsParser::$autoRefresh = TRUE;
	}

}



final class SystemContainer_IEventPlanningControlFactoryImpl_38_IEventPlanningControlFactory implements IEventPlanningControlFactory
{

	private $container;


	public function __construct(Nette\DI\Container $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new EventPlanningControl($this->container->getService('32_App_Model_EventManager'), $this->container->getService('35_App_Model_TermManager'), $this->container->getService('36_App_Model_UserManager'));
		return $service;
	}

}



final class SystemContainer_ITimeLineControlFactoryImpl_39_ITimeLineControlFactory implements ITimeLineControlFactory
{

	private $container;


	public function __construct(Nette\DI\Container $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new TimeLineControl;
		return $service;
	}

}



final class SystemContainer_Nette_Bridges_ApplicationLatte_ILatteFactoryImpl_nette_latteFactory implements Nette\Bridges\ApplicationLatte\ILatteFactory
{

	private $container;


	public function __construct(Nette\DI\Container $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new Latte\Engine;
		$service->setTempDirectory('C:\\xampp\\htdocs\\BPIS\\app/../temp/cache/latte');
		$service->setAutoRefresh(TRUE);
		$service->setContentType('html');
		return $service;
	}

}
