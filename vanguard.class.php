<?php
/*	Project:	EQdkp-Plus
 *	Package:	Vanguard game package
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

if(!class_exists('vanguard')) {
	class vanguard extends game_generic {
		protected static $apiLevel	= 20;
		public $version				= '2.2.0';
		protected $this_game		= 'vanguard';
		protected $types			= array('classes', 'races', 'filters', 'roles');
		protected $classes			= array();
		protected $races			= array();
		protected $factions			= array();
		protected $filters			= array();
		public $langs				= array('english');

		protected $class_dependencies = array(
			array(
				'name'		=> 'race',
				'type'		=> 'races',
				'admin'		=> false,
				'decorate'	=> true,
				'parent'	=> false
			),
			array(
				'name'		=> 'class',
				'type'		=> 'classes',
				'admin'		=> false,
				'decorate'	=> true,
				'primary'	=> true,
				'colorize'	=> true,
				'roster'	=> true,
				'recruitment' => true,
				'parent'	=> array(
					'race' => array(
						// dependancy missing: http://vanguard.wikia.com/wiki/Races
						0 	=> 'all',		// Unknown
						1 	=> 'all',		// Dark Elf
						2 	=> 'all',		// Dwarf
						3 	=> 'all',		// Gnome
						4 	=> 'all',		// Goblin
						5 	=> 'all',		// Half Elf
						6 	=> 'all',		// Halfling
						7 	=> 'all',		// High Elf
						8 	=> 'all',		// Kojani
						9 	=> 'all',		// Kurashasa
						10 	=> 'all',		// Lesser Giant
						11 	=> 'all',		// Mordebi
						12 	=> 'all',		// Orc
						13 	=> 'all',		// Qaliathari
						14 	=> 'all',		// Raki
						15 	=> 'all',		// Thestran
						16 	=> 'all',		// Varanjar
						17 	=> 'all',		// Varanthari
						18 	=> 'all',		// Vulmane
						19 	=> 'all',		// Wood Elf
					),
				),
			),
		);
		
		public $default_roles = array(
			1	=> array(3,4,5,15),
			2	=> array(6,11,17),
			3	=> array(7,8,10,12,13,16),
			4	=> array(1,2,6,9,11,14,17)
		);

		protected $glang		= array();
		protected $lang_file	= array();
		protected $path			= '';
		public $lang			= false;

		protected function load_filters($langs){
			if(!$this->classes) {
				$this->load_type('classes', $langs);
			}
			foreach($langs as $lang) {
				$names = $this->classes[$this->lang];
				$this->filters[$lang][] = array('name' => '-----------', 'value' => false);
				foreach($names as $id => $name) {
					$this->filters[$lang][] = array('name' => $name, 'value' => 'class:'.$id);
				}
				$this->filters[$lang] = array_merge($this->filters[$lang], array(
					array('name' => '-----------', 'value' => false),
					array('name' => $this->glang('unknown', true, $lang), 'value' => 'class:0,1,4,7,8'),
					array('name' => $this->glang('cloth', true, $lang), 'value' => 'class:5,9,13,14,17,21'),
					array('name' => $this->glang('leather', true, $lang), 'value' => 'class:2,3,11'),
					array('name' => $this->glang('chain', true, $lang), 'value' => 'class:18,19,20'),
					array('name' => $this->glang('plate', true, $lang), 'value' => 'class:6,10,12,16,22'),
				));
			}
		}

		public function install($install=false){
		}
	}
}
?>