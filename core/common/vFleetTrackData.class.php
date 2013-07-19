<?php
/**
Module Created By Vansers

This module is only use for phpVMS (www.phpvms.net) - (A Virtual Airline Admin Software)

@Created By Vansers
@Copyrighted @ 2011
@Under CC 3.0
@http://creativecommons.org/licenses/by-nc-sa/3.0/

// Version 1.0 (September 7.12) - Module Created
**/
class vFleetTrackData extends CodonData
{
	public static function getAllAircraft()
	{
		return DB::get_results("SELECT * FROM ".TABLE_PREFIX."aircraft");
	}
	
	public static function CargoAircraft($id)
	{
		return DB::get_results("SELECT a.*, s.* 
								FROM ".TABLE_PREFIX."aircraft a
								LEFT JOIN ".TABLE_PREFIX."schedules s ON s.aircraft = a.id
								WHERE s.flighttype = 'C' AND a.id = {$id}");
	}
	
	public static function getAircraftInfo($reg)
	{
		return DB::get_row("SELECT * FROM ".TABLE_PREFIX."aircraft 
							WHERE `registration`= '{$reg}'");
	}
	
	public static function getLastFlightAircraft($id)
	{
		return DB::get_row("SELECT * FROM ".TABLE_PREFIX."pireps 
							WHERE aircraft = {$id} ORDER BY submitdate DESC LIMIT 1");
	}
	
	public static function getAllLastLocation()
	{
		return DB::get_results("SELECT flight.*, UNIX_TIMESTAMP(flight.submitdate) as submitdate,
					dep.name as depname, dep.lat AS deplat, dep.lng AS deplng,
					arr.name as arrname, arr.lat AS arrlat, arr.lng AS arrlng,
                                        ac.icao AS acicao, ac.name AS acname, ac.fullname AS acfullname,
                                        ac.registration AS acregistration
				FROM (SELECT * FROM phpvms_pireps ORDER BY submitdate DESC) AS flight
                                LEFT JOIN phpvms_aircraft AS ac ON ac.id = flight.aircraft
				LEFT JOIN phpvms_airports AS dep ON dep.icao = flight.depicao
				LEFT JOIN phpvms_airports AS arr ON arr.icao = flight.arricao
                                GROUP BY flight.aircraft
				ORDER BY submitdate DESC");	
	}
	
	public static function getLastNumFlightsAircraft($id, $count = "5")
	{
		return DB::get_results("SELECT p.*, UNIX_TIMESTAMP(p.submitdate) as submitdate,
					dep.name as depname, dep.lat AS deplat, dep.lng AS deplng,
					arr.name as arrname, arr.lat AS arrlat, arr.lng AS arrlng						
				FROM ".TABLE_PREFIX."pireps p
				LEFT JOIN ".TABLE_PREFIX."airports AS dep ON dep.icao = p.depicao
				LEFT JOIN ".TABLE_PREFIX."airports AS arr ON arr.icao = p.arricao
				WHERE p.aircraft = {$id}
				ORDER BY submitdate DESC LIMIT {$count}");
	}
	
	public static function buildFlightsAvbTable($id)
	{
		return DB::get_results("SELECT s.*,
					dep.name as depname, dep.lat AS deplat, dep.lng AS deplng,
					arr.name as arrname, arr.lat AS arrlat, arr.lng AS arrlng						
				FROM " . TABLE_PREFIX . "schedules AS s
				LEFT JOIN ".TABLE_PREFIX."airports AS dep ON dep.icao = s.depicao
				LEFT JOIN ".TABLE_PREFIX."airports AS arr ON arr.icao = s.arricao
				WHERE s.aircraft = {$id}");
	}
	
	public static function countFlights($id)
	{
		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE aircraft = {$id} AND accepted = 1";
		$results = DB::get_results($query);
		return DB::num_rows($results);
	}
	
	public static function countHours($id)
	{
		$query = "SELECT SUM(flighttime) as time FROM ".TABLE_PREFIX."pireps WHERE aircraft = {$id} AND accepted = 1";
		$result = DB::get_row($query);
		return $result->time;
	}
	
	public static function countMiles($id)
	{
		$query = "SELECT SUM(distance) as distance FROM ".TABLE_PREFIX."pireps WHERE aircraft = {$id} AND accepted = 1";
		$result = DB::get_row($query);
		return $result->distance;
	}
	
	public static function countPassengers($id)
	{
		$query = "SELECT SUM(`load`) as `load` FROM ".TABLE_PREFIX."pireps WHERE aircraft = {$id} AND accepted = 1";
		$result = DB::get_row($query);
		return $result->load;
	}
}
