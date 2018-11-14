<?php
// ////////////////////////////////////////////////////////////////////////
//
// Project: HMRWeb - HMR project new website
// Package:  HMRAdministration manage permissions
// Title: Functions for manage permissions
// File: managePermissions.php
// Path: Administration/Assets/PHP
// Type: php
// Started: 2018.11.03
// Author(s): Nicolò Pratelli
// State: in use
//
// Version history.
// - 2018.11.13 Nicolò
// First version
//
// ////////////////////////////////////////////////////////////////////////
//
// This file is part of software developed by the HMR Project
// Further information at: http://progettohmr.it
// Copyright (C) 2017 HMR Project, Nicolò Pratelli
//
// This is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published
// by the Free Software Foundation; either version 3.0 of the License,
// or (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty
// of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program; if not, see <http://www.gnu.org/licenses/>.
//
// ////////////////////////////////////////////////////////////////////////

class Permission {
	/**
	 * Bitmasks as decimal values
     * HMR permissions
	 * 1 =      00000000 00000001 HMR Admin
	 * 2 =      00000000 00000010 HMR Web editor
	 * 4 =      00000000 00000100
	 * 8 =      00000000 00001000
	 * 16 =     00000000 00010000
	 * 32 =     00000000 00100000
	 * 64 =     00000000 01000000
	 * 128 =    00000000 10000000
     * OggiSTI permissions
     * 256 =    00000001 00000000 OggiSTI editor
	 * 512 =    00000010 00000000 OggiSTI reviser
	 * 1024 =   00000100 00000000
	 * 2048 =   00001000 00000000
	 * 4096 =   00010000 00000000
	 * 8192 =   00100000 00000000
	 * 16384 =  01000000 00000000
	 * 32768 =  10000000 00000000
	 */
    const ADMIN = 1;
    const WEBEDITOR = 2; 
    const OGGISTIEDITOR = 256;
    const OGGISTIREVISER = 512;
	
    private $permissions;

	/**
	 * @param integer $userPermission
	 *
	 * @return void
	 */
	public function __construct($userPermission) {
		$this->permissions = $userPermission;
	}
	
	/**
	 *
	 * @return integer $permission
	 */
	public function getPermissions(){
		return $this->permissions;
	}
    
  
	/**
	 * @return Permission $this
	 */
	public function grantAdmin() {
		$this->addPermission(self::ADMIN);
		return $this;
	}
	/**
	 * @return Permission $this
	 */
	public function denyAdmin() {
		$this->removePermission(self::ADMIN);
		return $this;
    }
     /**
	 * @return Permission $this
	 */
	public function checkAdmin() {
        if(($this->permissions & self::ADMIN) == self::ADMIN){
            return true;
        }else{
            return false;
        }
	}
	/**
	 * @return Permission $this
	 */
	public function grantWebEditor() {
		$this->addPermission(self::WEBEDITOR);
		return $this;
	}
	/**
	 * @return Permission $this
	 */
	public function denyWebEditor() {
		$this->removePermission(self::WEBEDITOR);
		return $this;
    }
    /**
	 * @return Permission $this
	 */
	public function checkWebEditor() {
        if(($this->permissions & self::WEBEDITOR) == self::WEBEDITOR){
            return true;
        }else{
            return false;
        }
	}
	/**
	 * @return Permission $this
	 */
	public function grantOggiSTIEditor() {
		$this->addPermission(self::OGGISTIEDITOR);
		return $this;
	}
	/**
	 * @return Permission $this
	 */
	public function denyOggiSTIEditor() {
		$this->removePermission(self::OGGISTIEDITOR);
		return $this;
    }
    /**
	 * @return Permission $this
	 */
	public function checkOggiSTIEditor() {
        if(($this->permissions & self::OGGISTIEDITOR) == self::OGGISTIEDITOR){
            return true;
        }else{
            return false;
        }
	}
	/**
	 * @return Permission $this
	 */
	public function grantOggiSTIReviser() {
		$this->addPermission(self::OGGISTIREVISER);
		return $this;
	}
	/**
	 * @return Permission $this
	 */
	public function denyOggiSTIReviser() {
		$this->removePermission(self::OGGISTIREVISER);
		return $this;
    }
    /**
	 * @return Permission $this
	 */
	public function checkOggiSTIReviser() {
        if(($this->permissions & self::OGGISTIREVISER) == self::OGGISTIREVISER){
            return true;
        }else{
            return false;
        }
	}
    
    
	/**
	 * Adding a Permission
	 *
	 * @see http://php.net/manual/de/language.operators.bitwise.php
	 * @example The permission is actualy set to ADMIN permission wich is representated by decimalvalue: 1 (see constants of BitMaskPermission::ADMIN)
	 * and we want also want to add WEBEDITOR permission wich is a decimalvalue 2
	 * 1 is in Binary 00000001
	 * 2 is in Binary 00000010
	 * What happens here is that we merge them together to the decimalvalue 3 by simply enable the 7th + 8th bit to:
	 * 3 is in Binary 00000011 wich is our for read+write access
	 * @param integer $bitmask
	 */
	private function addPermission($bitMaskAsDecimal) {
		$this->permissions |= $bitMaskAsDecimal;
	}
	/**
	 * Removing a Permission
	 *
	 * @see http://php.net/manual/de/language.operators.bitwise.php
	 * @example The permission is actualy set to ADMIN + WEBEDITOR permission wich is the decimalvalue 3 (BitMaskPermission::ADMIN + BitMaskPermission::WEBEDITOR) (1 + 2)
	 * and we want also want to remove WEBEDITOR permission wich is a decimalvalue 2
	 * 3 is in Binary 00000001
	 * 2 is in Binary 00000010
	 * What happens here is that we disable the 7th digit of decimalvalue 2 in our permissions:
	 * 1 is in Binary 00000001 wich is our bitmask for read access
	 * @param integer $bitmask
	 */
	private function removePermission($bitMaskAsDecimal) {
		$this->permissions &= ~$bitMaskAsDecimal;
	}
}

// $permission = new Permission(0);
// print_r($permission->checkAdmin());
// print_r($permission->grantOggiSTIReviser());
// echo "<br/>";
// print_r($permission->checkWebEditor());
// print_r($permission->grantAdmin());
// echo "<br/>";
// print_r($permission->checkOggiSTIEditor());
// print_r($permission->grantWebEditor());
// echo "<br/>";
// print_r($permission->checkOggiSTIReviser());
// print_r($permission->denyOggiSTIEditor());
// echo "<br/>";
// print_r($permission->denyAdmin());
// echo "<br/>";
// print_r($permission->grantOggiSTIEditor());
// echo "<br/>";
// print_r($permission);
?>

