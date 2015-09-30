<?php
/**
* required interface for all translatorXXXExtended classes
*/
require_once 'interface.I18NtranslatorInterfaceExtended.inc.php';
/**
* load base class which takes care of all the other includes via it's autoload function
*/
require_once 'class.I18Nbase.inc.php';

/**
* extended translator class with SQLite as a backend
* @author Michael Wimmer <flaimo@gmx.net>
* @category FLP
* @copyright Copyright © 2002-2006, Michael Wimmer
* @example  ../www_root/i18n_example_script.php  i18n example script
* @license Free for non-commercial use
* @link http://flp.sf.net/
* @package I18N
* @version 2.2
*/
class I18NtranslatorSQLiteExtended extends I18NtranslatorSQLite implements I18NtranslatorInterfaceExtended {

	/**
	* @param string $namespaces
	* @param object $locale I18Nlocale
	* @uses I18NtranslatorSQLite::__construct()
	* @return void
	*/
	public function __construct($namespaces = '', I18Nlocale &$locale = NULL) {
		parent::__construct($namespaces, $locale);
	} // end constructor

	/**
	* writes the last update timestamp to the session
	* @param string $namespace
	* @param int $timestamp
	* @uses I18NtranslatorBase::getLocales()
	* @return boolean
	*/
	protected function setLastUpdateSession($namespace = '', $timestamp = 0) {
		$locales =& $this->getLocales();
		foreach ($locales as $locale => &$object) {
			$_SESSION['i18n']['settings']['last_update'][$locale][$namespace] = (int) $timestamp;
		} // end if
		return (boolean) TRUE;
	} // end function

	/**
	* returns the timestamp when a given namespace was last updated
	* @param string $namespace
	* @return mixed int/boolean
	* @uses I18Nbase::isFilledString()
	* @uses I18NtranslatorBase::getLastUpdateSession()
	* @uses I18NtranslatorSQLite::$table
	* @uses I18NtranslatorSQLite::getConn()
	* @uses I18NtranslatorBase::setLastUpdateSession()
	* @return mixed
	*/
	public function getLastUpdateDateNamespace($namespace = '') {
		if (parent::isFilledString($namespace) == FALSE) {
			return (boolean) FALSE;
		} elseif (($tmp_namespace = parent::getLastUpdateSession($namespace)) != FALSE) {
			return (int) $tmp_namespace;
		} // end if

		$sql  = 'SELECT MAX(lastupdate)';
		$sql .= ' FROM ' . $this->table;
		$sql .= ' WHERE namespace = "' . addslashes($namespace) . '"';

		$result = @sqlite_query(parent::getConn(), $sql);
		if (!$result) {
			return (boolean) FALSE;
		} // end if

    	if (!is_bool($result) && sqlite_num_rows($result) > 0 &&
    		($lastchange = sqlite_fetch_single($result)) != NULL) {
			parent::setLastUpdateSession($namespace, $lastchange);
			return (int) $lastchange;
		} // end if
		return (boolean) FALSE;
	} // end function

	/**
	* checks if a string is in the database
	* @param string $string
	* @uses I18NtranslatorSQLite::$table
	* @uses I18NtranslatorSQLite::getConn()
	* @return boolean
	*/
	protected function stringInDatabase($string = '') {
		$query  = (string) 'SELECT COUNT(*)';
		$query .= (string) ' FROM ' .  $this->table;
		$query .= (string) ' WHERE string = "' . addslashes(trim($string)) . '"';
		$result = @sqlite_query(parent::getConn(), $query);
		return (boolean) (!$result || sqlite_fetch_single($result) < 1) ? FALSE : TRUE;
	} // end function


	/**#@+
	* @return boolean
	* @param string $string the stranslation string
	* @param string $namespace
	*/
	/**
	* deletes selected values from  the translation array
	* @uses I18Nbase::isFilledString()
	* @uses I18NtranslatorSQLite::$translation_table
	* @uses I18NtranslatorBase::$namespaces
	*/
	protected function stripTranslationTable($string = '', $namespace = 'lang_main') {
 		if (parent::isFilledString($string) == FALSE ||
 			parent::isFilledString($namespace) == FALSE) {
 			return (boolean) FALSE;
 		} // end if

 		if (isset($this->translation_table[trim($string)]) && in_array(trim($namespace), $this->namespaces)) {
 			unset($this->translation_table[trim($string)]);
 			return (boolean) TRUE;
 		} // end if
 		return (boolean) FALSE;
	} // end function

	/**
	* deletes a translation from the given namespace for a given locale
	* @param object $locale I18Nlocale
	* @uses I18NtranslatorSQLite::$table
	* @uses I18Nlocale::getI18Nlocale()
	* @uses I18NtranslatorSQLite::getConn()
	*/
	protected function deleteLocaleString($string = '', $namespace = 'lang_main', I18Nlocale &$locale) {
		$locale_s = str_replace('-', '_', $locale->getI18Nlocale());
		$sql  = 'UPDATE ' . $this->table;
		$sql .= ' SET ' . $locale_s . '=NULL, lastupdate=' . time();
		$sql .= ' WHERE string = "' . addslashes(trim($string)) . '" AND namespace = "' . addslashes(trim($namespace)) . '"';
		$result = @sqlite_query(parent::getConn(), $sql);

		if (!$result) {
			return (boolean) FALSE;
		} // end if
		return (boolean) TRUE;
	} // end function

	/**
	* deletes a translation string + translation from the given namespace for ALL locales
	* @uses I18NtranslatorSQLiteExtended::deleteLocaleString()
	* @uses I18NtranslatorSQLite::getTranslatorLocale()
	*/
	public function deleteTranslationString($string = '', $namespace = 'lang_main') {
		$this->deleteLocaleString($string, $namespace, parent::getTranslatorLocale());
	} // end function

	/**
	* deletes a translation string + translation from the given namespace for the current locale
	* @uses I18NtranslatorSQLite::$table
	* @uses I18NtranslatorSQLite::getConn()
	*/
	public function deleteTranslation($string = '', $namespace = 'lang_main') {
		$sql  = 'DELETE FROM ' . $this->table;
		$sql .= ' WHERE string = "' . addslashes(trim($string)) . '" AND namespace = "' . addslashes(trim($namespace)) . '"';
		$result = @sqlite_query(parent::getConn(), $sql);

		if (!$result) {
			return (boolean) FALSE;
		} // end if
		return (boolean) TRUE;
	} // end function

	/**
	* adds a translationstring + translation to the given namespace of the current locale
	* @param string $translation the stranslation itself
	* @uses I18NtranslatorSQLite::$table
	* @uses I18Nbase::validTranslationInput()
	* @uses I18NtranslatorSQLite::getConn()
	* @uses I18NtranslatorSQLite::$translation_table
	*/
	public function addTranslation($string = '', $translation = '', $namespace = 'lang_main') {
		if (parent::validTranslationInput($string, $translation, $namespace) === FALSE) {
			return (boolean) FALSE;
		} // end if

		$locale = str_replace('-', '_', parent::getTranslatorLocale()->getI18Nlocale());
		$sql  = 'REPLACE INTO ' . $this->table . ' (namespace, string, lastupdate, ' . $locale . ')';
		$sql .= ' VALUES ("' . addslashes(trim($namespace)) . '", "' . addslashes(trim($string)) . '", ' . time() . ', "' . addslashes(trim($translation)) . '")';
		$result = @sqlite_query(parent::getConn(), $query);

        if (!$result) {
			return (boolean) FALSE;
        } // end if

 		$this->translation_table[trim($string)] = (string) trim($translation);
		return (boolean) TRUE;
	} // end function

	/**
	* updates a translationstring or translation or namespace
	* @param string $translation the stranslation itself
	* @param int $position 2 = change namespace; 1 = change string; 0 = change translation
	* @uses I18NtranslatorSQLite::$table
	* @uses I18Nbase::validTranslationInput()
	* @uses I18NtranslatorBase::getTranslatorLocale()
	* @uses I18NtranslatorSQLite::getConn()
	* @uses I18NtranslatorSQLiteExtended::stripTranslationTable()
	*/
	public function updateTranslation($string = '', $translation = '', $namespace = 'lang_main', $position = 1) {
		if (parent::validTranslationInput($string, $translation, $namespace) === FALSE) {
			return (boolean) FALSE;
		} // end if

		$query  = (string) 'UPDATE ' . $this->table;
		$locale = str_replace('-', '_', parent::getTranslatorLocale()->getI18Nlocale());

		if ($position == 0) { // changes string field
			$query .= ' SET string="' . addslashes(trim($string)) . '", lastupdate=' . time();
			$query .= ' WHERE namespace="' . addslashes(trim($namespace)) . '" AND ' . $locale . '="' . addslashes(trim($translation)) . '"';
		} elseif ($position == 2) { // changes namespace
			$query .= ' SET namespace="' . addslashes(trim($namespace)) . '", lastupdate=' . time();
			$query .= ' WHERE string="' . addslashes(trim($string)) . '" AND ' . $locale . '="' . addslashes(trim($translation)) . '"';
		} else { // changes translation field (default)
			$query .= ' SET ' . $locale . '="' . addslashes(trim($translation)) . '", lastupdate=' . time();
			$query .= ' WHERE string="' . addslashes(trim($string)) . '" AND namespace="' . addslashes(trim($namespace)) . '"';
		} // end if
		$result = @sqlite_query(parent::getConn(), $query);

        if (!$result || sqlite_changes(parent::getConn()) < 1) {
			return (boolean) FALSE;
        } // end if

 		$this->stripTranslationTable($string, $namespace);
		return (boolean) TRUE;
	} // end function
	/**#@-*/
} // end I18NtranslatorSQLiteExtended
?>