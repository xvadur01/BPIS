<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{
	/** @var \App\Model\FrontpageManager */
	private $fronpageManager;

	public function __construct(\App\Model\FrontpageManager $fronpageManager) {
		$this->fronpageManager = $fronpageManager;
	}

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		$router[] = new Route('sitemap.xml', 'Front:Homepage:sitemap');
		// Admin
		$router[] = new Route('admin/<presenter>/<action>/<id>', array(
			'module' => 'Admin',
			'presenter' => 'Admin',
			'action' => 'default',
			'id' => NULL,
		));
		// Front
		$router[] = new Route('<id>', array(
			'id' => array(
				Route::FILTER_IN => function ($id){
					if(is_numeric($id))
					{
						return $id;
					}
					else
					{
						if($id != 'admin')
						{
							return $this->fronpageManager->getByUrl($id)->fetch()->id;
						}

					}
				},
				Route::FILTER_OUT => function ($id){
					if(!is_numeric($id))
					{
						return $id;
					}
					else
					{
						return $this->fronpageManager->get($id)->url;
					}
				}
				),
				'module' => 'Front',
				'presenter' => 'Homepage',
				'action' => 'default'
			)
		);

		$router[] = new Route('<presenter>/<action>/<id>', array(
			'module' => 'Front',
			'presenter' => 'Homepage',
			'action' => 'default',
			'id' => NULL,
		));
		return $router;
	}

}
