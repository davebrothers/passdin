<?php
	
class Passulator {
	
	private $phrase = '';
	private $pass_array = '';
	private $length = 8;
	
	function get_phrase() {
		return $this->phrase;
	}
	
	function set_phrase($provided) {
		try {
			if ($provided == '')
				throw new Exception("You haven't given me a phrase");
			$this->phrase = $provided;
		}
		catch(Exception $e) {
		  	return $e->getMessage();
		}
	}
	
	function get_length() {
		return $this->length;
	}
	
	function set_length($provided) {
		try {
			if ($length == '')
				throw new Exception("You haven't specified a password length");
			$this->length = $provided;
		}
		catch(Exception $e) {
			return $e->getMessage();
		}
	}
	
	function __construct($provided, $length){
		try {
			if (empty($provided))
				throw new Exception("You haven't given me a phrase");
			$this->set_phrase($provided);
			
			if (empty($length))
				throw new Exception("You haven't specified password length");
			$this->set_length($length);
			
		}
		catch(Exception $e) {
		  	return $e->getMessage();
		}

	}
	
	function char_swap($char_to_swap, $char_from_phrase, $frequency) {
		//frequency is an int 1 - 10 for likelihood of swap
		if ($frequency < 1 || $frequency > 10)
			throw new Exception("Frequency must be between 1 and 10");
		
		$r = rand(1,10);
		if (strcmp(strtoupper($char_to_swap), strtoupper($char_from_phrase)) == 0) {
			switch (strtoupper($char_to_swap)) {
				case "A":
					if ($r < $frequency)
						return "@";
					if ($r > $frequency)
						return "A";
					return "a";
				case "B":
					if ($r < $frequency)
						return "8";
					if ($r > $frequency)
						return "B";
					return "b";
				case "C":
					if ($r < $frequency)
						return "(";
					if ($r > $frequency)
						return "C";
					return "c";
				case "E":
					if ($r < $frequency)
						return "3";
					if ($r > $frequency)
						return "E";
					return "b"; 
				case "H":
					if ($r < $frequency)
						return "#";
					if ($r > $frequency)
						return "H";
					return "h";
				case "I":
					if ($r < $frequency)
						return "!";
					if ($r > $frequency)
						return "I";
					return "i"; 
				case "L":
					if ($r < $frequency)
						return "2";
					if ($r > $frequency)
						return "!";
					return "L";
				case "O":
					if ($r < $frequency)
						return "0";
					if ($r > $frequency)
						return "O";
					return "o";
				case "R":
					if ($r < $frequency)
						return "4";
					if ($r > $frequency)
						return "R";
					return "r";
				case "S":
					if ($r < $frequency)
						return "$";
					if ($r > $frequency)
						return "S";
					return "s";
				case "T":
					if ($r < $frequency)
						return "7";
					if ($r > $frequency)
						return "+";
					return "t";
				case "U":
					if ($r < $frequency)
						return "U";
					return "u";
				case " ":
					if ($r == 10)
						return "$";
					if ($r == 1)
						return "%";
					if ($r == $frequency)
						return "*";
					if ($r + 1 == $frequency || $r - 1 == $frequency)
						return "@";
					if ($r < $frequency)
						return "_";
					if ($r > $frequency)
						return "+";
					return "#";			
			}
		}		
		return $char_from_phrase;
	}
	
	function passulate() {
		try {
			if (empty($this->phrase))
				throw new Exception("You haven't given me a phrase");
			
			if (!is_numeric($this->length))
				throw new Exception("You haven't specified a max length");
	
			$pass_array = str_split($this->phrase);
			$control_array = array("a","b","c","e","h","i","l","o","r","s","t","u"," ");
			
			foreach ($pass_array as &$pass) {
				foreach ($control_array as $control)
					$pass = $this->char_swap($control, $pass, rand(1,10));
			}
			
		}
		catch(Exception $e) {
			return $e->getMessage();
		}
		
		$this->phrase = implode($pass_array);

		if (strlen($this->phrase) > $this->length) {
			$rand = rand(1, (strlen($this->phrase) - $this->length));
			$this->phrase = substr($this->phrase, $rand, $this->length);
		}
		
		return $this->phrase;
	}
	
}
	
?>