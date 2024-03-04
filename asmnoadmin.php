<?php
/**
 * @package plugin ASM No Admin
 * @copyright (C) 2021 Ciro Artigot
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * More info https://algosemueve.es
 */


defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;

class plgSystemAsmNoAdmin extends CMSPlugin {
	
	public function onAfterInitialise() {
		// this is for Ajax petitions
		if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') return;		
		$app	= Factory::getApplication();	

		// if client is administrator && not guest OR site return
		if(($app->isClient('administrator') && !Factory::getUser()->guest) || $app->isClient('site')) {
			return;	
		}
		else {		
			
			if(filter_input(INPUT_GET, $this->params->get('key', 'asmlogin')) == $this->params->get('answer', 'yes')) {
				return;}
			else {
				// this is if we are on the POST login action
				if($app->input->getCmd('option', '')=='com_login') return;
				$app->redirect($this->params->get('redirect', '/'));
			}
		}
	}
	
}
