<?php
/**
 * Copyright (C) 2013 Pablo Sep�lveda P. <psep.pentauc@gmail.com>
 *
 * This file is part of apis-servicios.
 * apis-servicios is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * apis-servicios is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with apis-servicios.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * Clase abstracta que contiene load de cURL.
 * 
 * @author Pablo Sep�lveda P. <psep.pentauc@gmail.com>
 * @version 1.0
 * @package apis-servicios
 * @copyright Copyright (C) 2010-2013 Pablo Sep�lveda P.
 * @license GNU GPLv3 or later
 * @link http://www.psep.cl
 */
abstract class AbstractCURL {
	
	/**
	 * Objeto string est�tico que contiene 
	 * descripci�n para el browser.
	 */
	protected static $browser = "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)";
	/**
	 * Funci�n que realiza la conexi�n v�a cURL
	 * a la url objeto de tipo string retornando
	 * un string para consumir de nombre web.
	 * 
	 * @param $url
	 * @return $web
	 */
	protected function getCURL($url){
		$cookie = tempnam("/tmp", "cookie");
		$ch		= $this->initialCURL();
		$web	= $this->getOptionalCURL($ch, $cookie, $url);
		$this->closeCURL($ch);
		
		return $web;
	}
	
	/**
	 * Funci�n que retorna una nueva
	 * instancia de cURL.
	 * 
	 * @return curl
	 */
	protected function initialCURL(){
		return curl_init();
	}
	
	/**
	 * Funci�n que cierra una conexi�n
	 * cURL pasada como par�metro.
	 * 
	 * @param $cURL
	 */
	protected function closeCURL($cURL){
		curl_close($cURL);
	}
	
	/**
	 * Funci�n que realiza carga de conexi�n
	 * v�a cURL seg�n el objeto cURL entregado
	 * como par�metro, as� tambi�n las cookies
	 * y la url a consumir.
	 * 
	 * @param $cURL
	 * @param $cookie
	 * @param $url
	 * 
	 * @return curl_exec
	 */
	protected function getOptionalCURL($cURL, $cookie, $url){
		curl_setopt($cURL, CURLOPT_URL, $url);
		curl_setopt($cURL, CURLOPT_HEADER, 0);
		curl_setopt($cURL, CURLOPT_POST, 0);
		curl_setopt($cURL, CURLOPT_USERAGENT, static::$browser);
		curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($cURL, CURLOPT_COOKIEJAR, $cookie);
		curl_setopt($cURL, CURLOPT_COOKIEFILE, $cookie);
		
		return curl_exec($cURL);
	}
}