<?php

/**
 * @package plugin ASM No Admin
 * @copyright (C) 2020 Ciro Artigot
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */


defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;

class plgSystemAsmNoAdmin extends CMSPlugin {
	
	public function onAfterInitialise() {
		
		if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') return;
		$app	= JFactory::getApplication();	
		if(($app->isClient('administrator') && !JFactory::getUser()->guest) || $app->isClient('site')) return;	
		else {
			if(filter_input(INPUT_GET, $this->params->get('key', 'asmlogin')) == $this->params->get('answer', 'yes')) return;
			else $app->redirect($this->params->get('redirect', '/'));
		}
	}
	
}