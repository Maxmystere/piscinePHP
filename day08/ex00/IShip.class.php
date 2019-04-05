<?php
interface IShip {
	function getRotation();
	function setRotation($newrot);
	function moveForward($trust);
	function useEnergy($needpp);
	function getEnergy();
	function refuelEnergy();
}
?>
