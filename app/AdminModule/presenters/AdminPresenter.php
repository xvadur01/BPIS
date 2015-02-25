<?php

namespace AdminModule;

class AdminPresenter extends BasePresenter {

	/** @var \Todo\EventManager */
	private $eventManager;
	/** @var \Todo\TermManager */
	private $termManager;
	/** @var \Todo\UserManager */
	private $userManager;
	/** @var \Todo\BorrowingManager */
	private $borrowingManager;
	/** @var \Todo\RecordManager */
	private $recordManager;
	/** @var \ITimeLineControlFactory @inject */
    public $timeLineControlFactory;

	protected $data;
	protected $type;

	function __construct(\App\Model\EventManager $eventManager,  \App\Model\TermManager $termManager, \App\Model\UserManager $userManager,
			 \App\Model\BorrowingManager $borrowingManager, \App\Model\RecordManager $recordManager)
	{
		parent::__construct();
		$this->eventManager = $eventManager;
		$this->termManager = $termManager;
		$this->userManager = $userManager;
		$this->borrowingManager = $borrowingManager;
		$this->recordManager = $recordManager;

    }

	function startup() {
		parent::startup();
	}

	 protected function createComponentTimeLine()
    {
		$timeLine = new \TimeLineControl();
		$timeLine->setType($this->type);
		$timeLine->setData($this->data);
        return $timeLine;
    }

	public function renderDefault() {
		$this->template->borrowing = $this->borrowingManager->getUserActiveBorrow($this->user->getId());
		$this->template->newestEvent = $this->eventManager->getNewestUserEvent($this->user->getId())->fetchAll();
		$this->template->closestEvent = $this->eventManager->getClosestUserEvent($this->user->getId())->fetchAll();

		$this->data = $this->recordManager->getUserRecord($this->user->getId());
		$this->type = "record";

		//dump($this->termManager->getTest($this->user->getId()));
		/*foreach ($this->termManager->getTest($this->user->getId()) as $value) {
			dump($value);
		*/
		//$this->template->event = $this->eventManager->get


	}
}