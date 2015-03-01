<?php

use Nette\Application\UI;

/**
* The Time control
*/
class TimeLineControl extends UI\Control
{
	private $data = array();
	private $type = "";

	public function setData($data)
    {
        $this->data = $data;
    }
    public function getData()
    {
        return $this->data;
    }

	public function setType($type)
    {
        $this->type = $type;
    }
    public function getType()
    {
        return $this->type;
    }

	public function render()
    {
		$this->template->data = $this->data;
		$this->template->type = $this->type;
		switch($this->type)
		{
			case "event":
			case "eventUser":
				$this->template->render(__DIR__ . '/TimeLineEventControl.latte');
			break;
			case "record":
			default:
				$this->template->render(__DIR__ . '/TimeLineRecordControl.latte');
		}
    }
}