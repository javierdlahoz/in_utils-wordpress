<?php

namespace INUtils\Helper;

use INUtils\Singleton\AbstractSingleton;

class DateHelper extends AbstractSingleton{

	/**
	 *
	 * @var number
	 */
	private $year;

	/**
	 *
	 * @var number
	 */
	private $month;

	/**
	 *
	 * @var number
	 */
	private $day;

	/**
	 *
	 * @param string $mysqlDate
	 */
	public function getFromMySQL($mysqlDate){
		$dateArray = explode("-", $mysqlDate);
		$this->year = $dateArray[0];
		$this->month = $dateArray[1];
		$this->day = $dateArray[2];
		return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function toMySQL(){
		return $this->getYear()."-".$this->getMonth()."-".$this->getDay();
	}

	/**
	 *
	 * @return string
	 */
	public function toString(){
		if(!empty($this->month) && !empty($this->day) && !empty($this->year)){
			return $this->getMonth()."-".$this->getDay()."-".$this->getYear();
		}
		else{
			return "";
		}
	}

	/**
	 *
	 * @return string
	 */
	public function getFormattedDate(){
		return $this->getMonth().".".$this->getDay().".".$this->getYear();
	}

	/**
	 *
	 * @return the number
	 */
	public function getYear() {
		return $this->year;
	}

	/**
	 *
	 * @param
	 *        	$year
	 */
	public function setYear($year) {
		$this->year = $year;
		return $this;
	}

	/**
	 *
	 * @return the number
	 */
	public function getMonth() {
		return $this->month;
	}

	/**
	 *
	 * @param
	 *        	$month
	 */


	/**
	 *
	 * @return the number
	 */
	public function getDay() {
		return $this->day;
	}

	/**
	 *
	 * @param
	 *        	$day
	 */
	public function setDay($day) {
		$this->day = $day;
		return $this;
	}

	/**
	 *
	 * @param string $wpDate
	 * @return string
	 */
	public static function fromWPtoMySQL($wpDate){
		$date = explode("-", $wpDate);
		return $date[2]."-".$date[0]."-".$date[1];
	}

	/**
	 *
	 * @param string $wpDate
	 * @return string
	 */
	public static function fromMySQLToWP($sqlDate){
		$date = explode("-", $sqlDate);
		return $date[1]."-".$date[2]."-".$date[0];
	}

	/**
	 *
	 * @param  string $sqlDate
	 * @return string
	 */
	public function fromMySQLToJS($sqlDate){
		$this->getFromMySQL($sqlDate);
		return $this->month."/".$this->day."/".$this->year;
	}

	/**
	 *
	 * @param  string $date
	 * @return string
	 */
	public static function fromJSToMySQL($date){
		$dateArray = explode("/", $date);
		if(isset($dateArray[1])){
			return $dateArray[2]."-".$dateArray[0]."-".$dateArray[1];
		}
		else{
			return null;
		}
	}

	/**
	 *
	 * @param string $date
	 * @return string|NULL
	 */
	public static function fromISGPToMySQL($date){
	    $dateArray = explode("-", $date);
	    if(isset($dateArray[1])){
	        return $dateArray[2]."-".$dateArray[0]."-".$dateArray[1];
	    }
	    else{
	        return null;
	    }
	}

	/**
	 *
	 * @param string $date
	 * @return string|NULL
	 */
	public static function fromMySQLToISGP($date){
	    $dateArray = explode("-", $date);
	    if(isset($dateArray[1])){
	        return $dateArray[1]."-".$dateArray[2]."-".$dateArray[0];
	    }
	    else{
	        return null;
	    }
	}
}