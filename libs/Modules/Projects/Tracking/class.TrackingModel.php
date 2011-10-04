<?php
class Modules_Projects_Tracking_TrackingModel {
	
	protected $id										= null;
	protected $projectId							= null;
	protected $categoryId							= null;
	protected $userId								= null;
	protected $moment								= null;
	protected $hoursUsed							= null;
	protected $hoursOB							= null;
	protected $hoursKV								= null;
	protected $notice								= null;
	protected $hoursCheckedUserId			= null;
	protected $hoursCheckedDateTime	= null;
	
	/**
	 * @return int $id
	 */
	public function getId() {
	    return $this->id;
	}

	/**
	 * @return int $projectId
	 */
	public function getProjectId() {
	    return $this->projectId;
	}

	/**
	 * @param int $projectId
	 */
	public function setProjectId($projectId) {
	    $this->projectId = $projectId;
	}

	/**
	 * @return int categoryId
	 */
	public function getCategoryId() {
	    return $this->categoryId;
	}

	/**
	 * @param int $categoryId
	 */
	public function setCategoryId(int $categoryId) {
	    $this->categoryId = $categoryId;
	}

	/**
	 * @return int userId
	 */
	public function getUserId() {
	    return $this->userId;
	}

	/**
	 * @param int $userId
	 */
	public function setUserId(int $userId) {
	    $this->userId = $userId;
	}

	/**
	 * @return DateTime moment
	 */
	public function getMoment() {
	    return $this->moment;
	}

	/**
	 * @param DateTime $moment
	 */
	public function setMoment(DateTime $moment) {
	    $this->moment = $moment;
	}

	/**
	 * @return float hoursUsed
	 */
	public function getHoursUsed() {
	    return $this->hoursUsed;
	}

	/**
	 * @param $hoursUsed
	 */
	public function setHoursUsed($hoursUsed) {
	    $this->hoursUsed = $hoursUsed;
	}

	/**
	 * @return  float hoursOB
	 */
	public function getHoursOB() {
	    return $this->hoursOB;
	}

	/**
	 * @param $hoursOB
	 */
	public function setHoursOB($hoursOB) {
	    $this->hoursOB = $hoursOB;
	}

	/**
	 * @return float hoursKV
	 */
	public function getHoursKV() {
	    return $this->hoursKV;
	}

	/**
	 * @param float $hoursKV
	 */
	public function setHoursKV($hoursKV) {
	    $this->hoursKV = $hoursKV;
	}

	/**
	 * @return string $notice
	 */
	public function getNotice() {
	    return $this->notice;
	}

	/**
	 * @param string $notice
	 */
	public function setNotice(string $notice) {
	    $this->notice = $notice;
	}

	/**
	 * @return int UserId
	 */
	public function getHoursCheckedUserId() {
	    return $this->hoursCheckedUserId;
	}

	/**
	 * @param int $hoursCheckedUserId
	 */
	public function setHoursCheckedUserId(int $hoursCheckedUserId) {
	    $this->hoursCheckedUserId = $hoursCheckedUserId;
	}

	/**
	 * @return DateTime hoursCheckedDateTime
	 */
	public function getHoursCheckedDateTime() {
	    return $this->hoursCheckedDateTime;
	}

	/**
	 * @param DateTime $hoursCheckedDateTime
	 */
	public function setHoursCheckedDateTime(DateTime $hoursCheckedDateTime) {
	    $this->hoursCheckedDateTime = $hoursCheckedDateTime;
	}
	
	public function assignTO() {
		
	}
	
}