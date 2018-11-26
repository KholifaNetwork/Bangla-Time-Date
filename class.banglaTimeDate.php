<?php

// by Faruk Hossain Surjo

	defined( 'ABSPATH' ) or die( 'Stop! You can not do this!' );

class BanglaDate
{
	private $timestamp;	//timestamp as input
	private $morning;	//when the date will change?
	
	private $engHour;	//Current hour of English Date
	private $engDate;	//Current date of English Date
	private $engMonth;	//Current month of English Date
	private $engYear;	//Current year of English Date
	
	private $bangDate;	//generated Bangla Date
	private $bangMonth;	//generated Bangla Month
	private $bangYear;	//generated Bangla	Year

	/*
	 * Set the initial date and time
	 *
	 * @param	int timestamp for any date
	 * @param	int, set the time when you want to change the date. if 0, then date will change instantly.
	 *			If it's 6, date will change at 6'0 clock at the morning. Default is 6'0 clock at the morning
	 */
	function __construct($timestamp, $hour = 6)
	{
		$this->BanglaDate($timestamp, $hour);
	}
	
	/*
	* PHP4 Legacy constructor
	*/
	function BanglaDate($timestamp, $hour = 6)
	{
		$bntd_options = get_option("bntd_options");
		if (!is_array($bntd_options)) {
			$bntd_options = array( 'bangla_tz' => '6' ); }
			
		$offset= $bntd_options['bangla_tz']*60*60;
			
		$this->engDate = gmdate('d', time()+$offset);
		$this->engMonth = gmdate('m', time()+$offset);
		$this->engYear = gmdate('Y', time()+$offset);
		$this->morning = $hour;
		$this->engHour = gmdate('G', time()+$offset);
		
		//calculate the bangla date
		$this->calculate_date();
		
		//now call calculate_year for setting the bangla year
		$this->calculate_year();
		
		//convert english numbers to Bangla
		$this->convert();
	}
	
	function set_time($timestamp, $hour = 6)
	{
		$this->BanglaDate($timestamp, $hour);
	}

	/*
	 * Calculate the Bangla date and month
	 */
	function calculate_date()
	{
		//when English month is January
		if($this->engMonth == 1)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "পৌষ";
				}
				else
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "পৌষ";
				}
			}
			else if($this->engDate < 14 && $this->engDate > 1) // Date 2-13
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "পৌষ";
				}
				else
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "পৌষ";
				}
			}

			else if($this->engDate == 14) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 13;
					$this->bnMonth = "মাঘ";
				}
				else
				{
					$this->bnDate = 30;
					$this->bnMonth = "পৌষ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 13;
					$this->bnMonth = "মাঘ";
				}
				else 
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "মাঘ";
				}
			}
		}

		
		//when English month is February		
		else if($this->engMonth == 2)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 18;
					$this->bnMonth = "মাঘ";
				}
				else
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "মাঘ";
				}
			}
			else if($this->engDate < 13 && $this->engDate > 1) // Date 2-12
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 18;
					$this->bnMonth = "মাঘ";
				}
				else
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "মাঘ";
				}
			}

			else if($this->engDate == 13) //Date 13
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 12;
					$this->bnMonth = "ফাল্গুন";
				}
				else
				{
					$this->bnDate = 30;
					$this->bnMonth = "মাঘ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 12;
					$this->bnMonth = "ফাল্গুন";
				}
				else 
				{
					$this->bnDate = $this->engDate - 13;
					$this->bnMonth = "ফাল্গুন";
				}
			}
		}
		
		//when English month is March		
		else if($this->engMonth == 3)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					if($this->is_leapyear())$this->bnDate = $this->engDate + 17;
					else $this->bnDate = $this->engDate + 16;
					$this->bnMonth = "ফাল্গুন";
				}
				else
				{
					if($this->is_leapyear()) $this->bnDate = $this->engDate + 16;
					else $this->bnDate = $this->engDate + 15;
					$this->bnMonth = "ফাল্গুন";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-13
			{
				if($this->engHour >=$this->morning)
				{
					if($this->is_leapyear()) $this->bnDate = $this->engDate + 17;
					else $this->bnDate = $this->engDate + 16;
					$this->bnMonth = "ফাল্গুন";
				}
				else
				{
					if($this->is_leapyear()) $this->bnDate = $this->engDate + 16;
					else $this->bnDate = $this->engDate + 15;
					$this->bnMonth = "ফাল্গুন";
				}
			}

			else if($this->engDate == 15) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "চৈত্র";
				}
				else
				{
					$this->bnDate = 30;
					$this->bnMonth = "ফাল্গুন";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "চৈত্র";
				}
				else 
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "চৈত্র";
				}
			}
		}
		
		//when English month is April		
		else if($this->engMonth == 4)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "চৈত্র";
				}
				else
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "চৈত্র";
				}
			}
			else if($this->engDate < 14 && $this->engDate > 1) // Date 2-13
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "চৈত্র";
				}
				else
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "চৈত্র";
				}
			}

			else if($this->engDate == 14) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 13;
					$this->bnMonth = "বৈশাখ";
				}
				else
				{
					$this->bnDate = 30;
					$this->bnMonth = "চৈত্র";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 13;
					$this->bnMonth = "বৈশাখ";
				}
				else 
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "বৈশাখ";
				}
			}
		}

		
		//when English month is May
		else if($this->engMonth == 5)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "বৈশাখ";
				}
				else
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "বৈশাখ";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "বৈশাখ";
				}
				else
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "বৈশাখ";
				}
			}

			else if($this->engDate == 15) //Date 14
			{
				if($this->engHour >= $this->morning)
					{
						$this->bnDate = $this->engDate - 14;
						$this->bnMonth = "জ্যৈষ্ঠ";
					}
				else
					{
						$this->bnDate = 31;
						$this->bnMonth = "চৈত্র";
					}
			}
			else //Date 16-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "জ্যৈষ্ঠ";
				}
				else 
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "জ্যৈষ্ঠ";
				}
			}
		}

		
		//when English month is June
		else if($this->engMonth == 6)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "জ্যৈষ্ঠ";
				}
				else
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "জ্যৈষ্ঠ";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 17;
					$this->bnMonth = "জ্যৈষ্ঠ";
				}
				else
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "জ্যৈষ্ঠ";
				}
			}

			else if($this->engDate == 15) //Date 15
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "আষাঢ়";
				}
				else
				{
					$this->bnDate = 31;
					$this->bnMonth = "জ্যৈষ্ঠ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "আষাঢ়";
				}
				else 
				{
					$this->bnDate = $this->engDate - 13;
					$this->bnMonth = "আষাঢ়";
				}
			}
		}

		
		//when English month is July		
		else if($this->engMonth == 7)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "আষাঢ়";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "আষাঢ়";
				}
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "আষাঢ়";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "আষাঢ়";
				}
			}

			else if($this->engDate == 16) //Date 16
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "শ্রাবণ";
				}
				else
				{
					$this->bnDate = 31;
					$this->bnMonth = "আষাঢ়";
				}
			}
			else //Date 17-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "শ্রাবণ";
				}
				else 
				{
					$this->bnDate = $this->engDate - 16;
					$this->bnMonth = "শ্রাবণ";
				}
			}
		}

		
		//when English month is August
		else if($this->engMonth == 8)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "শ্রাবণ";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "শ্রাবণ";
				}
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "শ্রাবণ";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "শ্রাবণ";
				}
			}

			else if($this->engDate == 16) //Date 16
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "ভাদ্র";
				}
				else
				{
					$this->bnDate = 31;
					$this->bnMonth = "শ্রাবণ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "ভাদ্র";
				}
				else 
				{
					$this->bnDate = $this->engDate - 16;
					$this->bnMonth = "ভাদ্র";
				}
			}
		}

		
		//when English month is September
		else if($this->engMonth == 9)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "ভাদ্র";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "ভাদ্র";
				}
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "ভাদ্র";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "ভাদ্র";
				}
			}

			else if($this->engDate == 16) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "আশ্বিন";
				}
				else
				{
					$this->bnDate = 31;
					$this->bnMonth = "ভাদ্র";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "আশ্বিন";
				}
				else 
				{
					$this->bnDate = $this->engDate - 16;
					$this->bnMonth = "আশ্বিন";
				}
			}
		}

		
		//when English month is October
		else if($this->engMonth == 10)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "আশ্বিন";
				}
				else
				{
					$this->bnDate = $this->engDate + 14;
					$this->bnMonth = "আশ্বিন";
				}
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "আশ্বিন";
				}
				else
				{
					$this->bnDate = $this->engDate + 14;
					$this->bnMonth = "আশ্বিন";
				}
			}

			else if($this->engDate == 16) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "কার্তিক";
				}
				else
				{
					$this->bnDate = 30;
					$this->bnMonth = "আশ্বিন";
				}
			}
			else //Date 17-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "কার্তিক";
				}
				else 
				{
					$this->bnDate = $this->engDate - 16;
					$this->bnMonth = "কার্তিক";
				}
			}
		}

		
		//when English month is November
		else if($this->engMonth == 11)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "কার্তিক";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "কার্তিক";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "কার্তিক";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "কার্তিক";
				}
			}

			else if($this->engDate == 15) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "অগ্রহায়ণ";
				}
				else
				{
					$this->bnDate = 30;
					$this->bnMonth = "কার্তিক";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "অগ্রহায়ণ";
				}
				else 
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "অগ্রহায়ণ";
				}
			}
		}

		
		//when English month is December
		else if($this->engMonth == 12)
		{
			if($this->engDate == 1) //Date 1
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "অগ্রহায়ণ";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "অগ্রহায়ণ";
				}
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				if($this->engHour >=$this->morning)
				{
					$this->bnDate = $this->engDate + 16;
					$this->bnMonth = "অগ্রহায়ণ";
				}
				else
				{
					$this->bnDate = $this->engDate + 15;
					$this->bnMonth = "অগ্রহায়ণ";
				}
			}

			else if($this->engDate == 15) //Date 14
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "পৌষ";
				}
				else
				{
					$this->bnDate = 30;
					$this->bnMonth = "অগ্রহায়ণ";
				}
			}
			else //Date 15-31
			{
				if($this->engHour >= $this->morning)
				{
					$this->bnDate = $this->engDate - 14;
					$this->bnMonth = "পৌষ";
				}
				else 
				{
					$this->bnDate = $this->engDate - 15;
					$this->bnMonth = "পৌষ";
				}
			}
		}
	}

	/*
	 * Checks, if the date is leapyear or not
	 *
	 * @return boolen. True if it's leap year or returns false
	 */
	function is_leapyear()
	{
		if($this->engYear%400 ==0 || ($this->engYear%100 != 0 && $this->engYear%4 == 0))
			return true;
		else
			return false;
	}

	/*
	 * Calculate the Bangla Year
	 */
	function calculate_year()
	{
		if($this->engMonth >= 4)
		{
			if($this->engMonth == 4 && $this->engDate < 14) //1-13 on april when hour is greater than 6
				{
					$this->bnYear = $this->engYear - 594;
				}
			else if($this->engMonth == 4 && $this->engDate == 14 && $this->engHour <=5)
				{
					$this->bnYear = $this->engYear - 594;
				}
			else if($this->engMonth == 4 && $this->engDate == 14 && $this->engHour >=6)
				{
					$this->bnYear = $this->engYear - 593;
				}	
			/*else if($this->engMonth == 4 && ($this->engDate == 14 && $this->engDate) && $this->engHour <=5) //1-13 on april when hour is greater than 6
				{
					$this->bnYear = $this->engYear - 593;
				}
				*/
			else
				$this->bnYear = $this->engYear - 593;
		}
		else $this->bnYear = $this->engYear - 594;
	}

	/*
	 * Convert the English character to Bangla
	 *
	 * @param int any integer number
	 * @return string as converted number to bangla
	 */
	function bangla_number($int)
	{
		$engNumber = array(1,2,3,4,5,6,7,8,9,0);
		$bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
		
		$converted = str_replace($engNumber, $bangNumber, $int);
		return $converted;
	}

	/*
	 * Calls the converter to convert numbers to equivalent Bangla number
	 */
	function convert()
	{
		$this->bnDate = $this->bangla_number($this->bnDate);
		$this->bnYear = $this->bangla_number($this->bnYear);
	}

	/*
	 * Returns the calculated Bangla Date
	 *
	 * @return array of converted Bangla Date
	 */
	function get_day() { return array($this->bnDate); }
	function get_month_year() { return array($this->bnMonth, $this->bnYear); }
	function get_month() { return array($this->bnMonth); }
}

?>
