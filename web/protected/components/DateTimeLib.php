<?php

/**
 * Date Time Library
 */
class DateTimeLib {

	/**
	 * Generates array for dropdown which using as timepicker
	 * @param	int		$step
	 * @return array
	 */
	public static function timePickerData($step = 15) {
		$arr = array();
		foreach (range(0,23) as $hour) {
			if ($hour < 10) $hour = '0' . $hour;
			foreach (range(0,59,$step) as $minute) {
				if ($minute < 10) $minute = '0' . $minute;
				$arr[$hour . ':' . $minute] = $hour . ':' . $minute;
			}
		}
		return $arr;
	}

	/**
	 * Generates array for dropdown which using as hourspicker
	 * @param	int		$step
	 * @return	array
	 */
	public static function hoursPickerData($step = 10) {
		$arr = array();
		foreach (range(0, 4) as $hour) {
			if ($hour < 10) $hour = '0' . $hour;
			foreach (range(0, 59, $step) as $minute) {
				if ($minute < 10) $minute = '0' . $minute;
				$arr[$hour . ':' . $minute] = $hour . ':' . $minute;
			}
		}
		return $arr;
	}

	/**
	 * Converts decimal to hours
	 * @param double	$decimal	Hours in a decimal format
	 * @param int		$divisible	Minutes must divide on this number
	 * @return string
	 */
	public static function decimalToHours($decimal, $divisible = 10) {
		$hours = (int)$decimal;
		$minutes = intval(round(($decimal - $hours) / 100 * 60, 2) * 100);
		$minutes = ($minutes - ($minutes % $divisible));
		if ($hours < 10) $hours = '0' . $hours;
		if ($minutes < 10) $minutes = '0' . $minutes;
		return "$hours:$minutes";
	}

	/**
	 * Converts hours to decimal
	 * @param string	$hours		Hours string in format 'hh:mm'
	 * @return double
	 */
	public static function hoursToDecimal($hours) {
		if (!preg_match('/^([0-9]{1,2}):([0-9]{1,2})$/', $hours, $matches)) {
			return 0;
		}
		$hours = $matches[1];
		$minutes = intval(round($matches[2] / 60 * 100, 2) * 100);
		return round(doubleval("$hours.$minutes"), 2);
	}

	/**
	 * Get current time which divide at $divisible param
	 * @param int		$divisible	Minutes must divide on this number
	 * @return string
	 */
	public static function getCurrTime($divisible = 15) {
		$hour = date('H');
		$minute = (int)date('i');
		$minute = ($minute - ($minute % $divisible));
		if ($minute < 10) $minute = '0' . $minute;
		return "$hour:$minute";
	}

}
