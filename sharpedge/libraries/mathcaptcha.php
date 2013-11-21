<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *     Copyright (C) 2012  Dan Murfitt
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 * 
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Math CAPTCHA Library
 *
 * A math CAPTCHA library for CodeIgniter.
 *
 * @package		CodeIgniter
 * @subpackage          Libraries
 * @category            Security
 * @author		Dan Murfitt
 * @link		http://twitter.com/danmurf
 * @license             http://opensource.org/licenses/gpl-license.php GNU Public License (GPLv3)
 */

/**
 * This is the range of numbers that the mathcaptcha can convert to words. If
 * you are using a custom language file with a greater range then please modify
 * appropriately.
 */
define('MATHCAPTCHA_NUMERIC_TEXT_RANGE_LOW',        0);
define('MATHCAPTCHA_NUMERIC_TEXT_RANGE_HIGH',       100);

/**
 * The highest the numbers in the question can be. This is so that the answer
 * does not exceed the number of the text range high, specified above.
 */
define('MATHCAPTCHA_MAX_QUESTION_NUMBER_SIZE',      10);

/**
 * The number of phrases to randomly choose from. If you would like to add more,
 * simply adjust these numbers. If you would like to use only one phrase, change
 * the following number(s) to 1 and remove the unnecessary phrases from the
 * language file. The phrase will be randomly selected for each CAPTCHA question.
 */
define('MATHCAPTCHA_NUM_ADDITION_PHRASES',          5);
define('MATHCAPTCHA_NUM_SUBTRACTION_PHRASES',       5);
define('MATHCAPTCHA_NUM_MULTIPLICATION_PHRASES',    5);
define('MATHCAPTCHA_NUM_DIVISION_PHRASES',          5);

Class Mathcaptcha
{
    /**
     * Store the CodeIgniter super-object
     * @var object $ci 
     */
    private $ci;
    
    /**
     * Store the language the math captcha should be displayed in
     * @var string CodeIgniter language setting
     */
    private $language;
   
    /**
     * The type of operation that should be performed for the math captcha
     * @var string 'addition', 'multiplication' or 'random'
     */
    private $operation;
    
    /**
     * The format of the numbers in the question
     * @var string 'numeric', 'word' or 'random' 
     */
    private $question_format;
    
    /**
     * The maximum size for each of the numbers in the question
     * @var int
     */
    private $question_max_number_size;
    
    /**
     * The format of the number should be in the answer
     * @var string 'numeric', 'word' or 'either'
     */
    private $answer_format;
    
    public function __construct() 
    {    
        //Get the CodeIgniter super object
        $this->ci =& get_instance();
    }
    
    /**
     * Initialise the library, gather the config (if set) and start the process
     * of calculating the math captcha
     * @param array $config An array of config items
     * @return boolean
     */
    public function init($config = array())
    {
        //Load the appropriate language file
        if (isset($config['language']))
        {
            //Use the specified language
            $this->language = $config['language'];
        }
        else
        {
            //Go with the default application language
            $this->language = $this->ci->config->item('language');
        }
        $this->ci->lang->load('mathcaptcha', $this->language);

        //Which operation should the CAPTCHA use?
        if (isset($config['operation']))
        {
            //Multiple to choose? Get one from given array
            if (is_array($config['operation']))
            {
                //Get random key from operation array
                $random_key = array_rand($config['operation']);
                //Now pick operation name and use it
                $config['operation'] = $config['operation'][$random_key];
            }
            
            switch ($config['operation'])
            {
                case 'addition' :
                case 'subtraction' :
                case 'multiplication' :
                case 'division' :
                    $this->operation = $config['operation'];
                break;

                case 'random' :
                    switch (rand(1,4))
                    {
                        case 1 :
                            $this->operation = 'addition';
                        break;

                        case 2 :
                            $this->operation = 'subtraction';
                        break;

                        case 3 :
                            $this->operation = 'multiplication';
                        break;

                        case 4 :
                            $this->operation = 'division';
                        break;
                    }       
                break;
            
                default :
                    //Unrecognised operation
                    return FALSE;
                break;
            }
        }
        else
        {
            //No operation option was selected - go with addition
            $this->operation = 'addition';
        }
        
        //What question format should be used?
        if (isset($config['question_format']))
        {
            switch ($config['question_format'])
            {
                case 'numeric' :
                case 'word' :
                case 'random' :
                    $this->question_format = $config['question_format'];
                break;
            
                default :
                    //Unrecognised question format
                    return FALSE;
                break;
            }
        }
        else
        {
            //No question format was selected - go with words
            $this->question_format = 'word';
        }
        
        //What should the maximum size of the numbers in the quesiton be?
        if (isset($config['question_max_number_size']))
        {
            if ($config['question_max_number_size'] > 0 && $config['question_max_number_size'] <= MATHCAPTCHA_MAX_QUESTION_NUMBER_SIZE)
            {
                $this->question_max_number_size = $config['question_max_number_size'];
            }
            else
            {
                //Max question number size is out of range
                return FALSE;
            }
        }
        else
        {
            //The maxiumum number size wasn't specified - go with the maximum
            $this->question_max_number_size = MATHCAPTCHA_MAX_QUESTION_NUMBER_SIZE;
        }
        
        //What answer format to accept?
        if (isset($config['answer_format']))
        {
            switch ($config['answer_format'])
            {
                case 'numeric' :
                case 'word' :
                case 'either' :
                    $this->answer_format = $config['answer_format'];
                break;
            
                default :
                    //Unrecognised answer format
                    return FALSE;
                break;
            }
        }
        else
        {
            //No answer format was selected - go with either
            $this->answer_format = 'either';
        }
        
        //Done - go!
        return TRUE;
    }
    
    /**
     * Gets the question to ask for the math captcha question
     * @return string|boolean The question to ask the user or FALSE if there was a problem
     */
    public function get_question()
    {
        if (strlen($this->question_format) == 0)
        {
            //Library hasn't been properly initialised
            return FALSE;
        }
        
        //Check what type of operation is performed
        if ($this->operation != 'division')
        {
            //First, generate the two random numbers for the question
            $number1 = rand(1, $this->question_max_number_size);
            $number2 = rand(1, $this->question_max_number_size);
        }
        else
        {
            //Generate first random number for qustion 
            $number1 = rand(1, $this->question_max_number_size);
            $dividers = array();
            
            //Loop through all possible numbers
            for ($i = 1; $i <= $this->question_max_number_size; $i++)
            {
                //Pick numbers with modulo = 0 for division array
                if ($number1 % $i == 0)
                {
                    $dividers[] = $i;
                }               
            }
            //Get random key from dividers array
            $random_key = array_rand($dividers);
            //Now pick second number for question 
            $number2 = $dividers[$random_key];
        }
        
        //Perform the operation and get the question phrase reference
        switch($this->operation)
        {
            case 'addition' :
                $answer = $number1 + $number2;
                $phrase = 'mathcaptcha_addition_2_'.rand(1, MATHCAPTCHA_NUM_ADDITION_PHRASES);
            break;

            case 'subtraction' :
                $answer = ($number1 > $number2) ? $number1 - $number2 : $number2 - $number1;
                $phrase = 'mathcaptcha_subtraction_2_'.rand(1, MATHCAPTCHA_NUM_SUBTRACTION_PHRASES);
            break;
        
            case 'multiplication' :
                $answer = $number1 * $number2;
                $phrase = 'mathcaptcha_multiplication_2_'.rand(1, MATHCAPTCHA_NUM_MULTIPLICATION_PHRASES);
            break;

            case 'division' :           
                $answer = $number1 / $number2;
                $phrase = 'mathcaptcha_division_2_'.rand(1, MATHCAPTCHA_NUM_DIVISION_PHRASES);
            break;
        
            default :
                //Shouldn't end up here
                return FALSE;
            break;
        }
               
        //Store the answer in flashdata
        $this->ci->session->set_flashdata('mathcaptcha_answer', $answer);
        
        if (($this->operation == 'subtraction') && ($number1 > $number2))
        {       
            //Return the CAPTCHA question but with reversed numbers
            return $this->compile_question($phrase, array($number2, $number1));
        }
        else
        {
            //Return the CAPTCHA question
            return $this->compile_question($phrase, array($number1, $number2));
        }
    }
    
    /**
     * Gets the phrase from the language file and injects the numbers
     * @param string $phrase The phrase from the language file
     * @param array $numbers An array of numbers to inject into the phrase
     * @return string|boolean The fully formed CAPTCHA question or FALSE if there was a problem
     */
    private function compile_question($phrase, $numbers = array())
    {
        //Should the numbers be translated into words?
        switch($this->question_format)
        {
            case 'word':
                //Both numbers should be words
                $numbers[0] = $this->numeric_to_string($numbers[0]);
                $numbers[1] = $this->numeric_to_string($numbers[1]);
            break;
        
            case 'random' :
                //The numbers should be randomly number/word
                if (rand(1,2) == 1)
                {
                    $numbers[0] = $this->numeric_to_string($numbers[0]);
                }
                
                if (rand(1,2) == 1)
                {
                    $numbers[1] = $this->numeric_to_string($numbers[1]);
                }
            break;
        }

        $question_phrase = $this->ci->lang->line($phrase);
        
        //Replace the numbers
        $question_phrase = str_replace('!1', $numbers[0], $question_phrase);
        $question_phrase = str_replace('!2', $numbers[1], $question_phrase);
        
        return $question_phrase;
    }
    
    /**
     * Checks to see if the answer was correct against the captcha stored in flashdata memory
     * @param int $answer The answer to the captcha question
     * @return boolean TRUE if the answer was correct, FALSE if not or if there was a problem
     */
    public function check_answer($answer)
    {
        $mathcaptcha_answer = $this->ci->session->flashdata('mathcaptcha_answer');
        
        if ($mathcaptcha_answer !== FALSE)
        {
            switch ($this->answer_format)
            {
                case 'numeric' :
                    if ($answer === (string) $mathcaptcha_answer)
                    {
                        return TRUE;
                    }
                    else
                    {
                        return FALSE;
                    }
            
                case 'word' :
                    if (strcasecmp($answer, $this->numeric_to_string($mathcaptcha_answer)) == 0)
                    {
                        return TRUE;
                    }
                    else
                    {
                        return FALSE;
                    }
            
                case 'either' :
                    if ($answer === (string) $mathcaptcha_answer ||
                        strcasecmp($answer, $this->numeric_to_string($mathcaptcha_answer)) == 0)
                    {
                        return TRUE;
                    }
                    else
                    {
                        return FALSE;
                    }
            
                default :
                    //Shoudln't end up here
                    return FALSE;
            }
        }
        else
        {
            //Answer not present
            return FALSE;
        }
    }
    
    /**
     * Converts a number to a language specific word
     * @param int $number The numeric version of the number
     * @return string The language specific word for the number or FALSE if there was a problem
     */
    private function numeric_to_string($number)
    {
        if (is_numeric($number) && $number >= MATHCAPTCHA_NUMERIC_TEXT_RANGE_LOW && $number <= MATHCAPTCHA_NUMERIC_TEXT_RANGE_HIGH)
        {
            return $this->ci->lang->line('mathcaptcha_numeric_word_'.$number);
        }
        else
        {
            return FALSE;
        }
    }
}

/* End of file mathcaptcha.php */
/* Location: ./application/libraries/mathcaptcha.php */