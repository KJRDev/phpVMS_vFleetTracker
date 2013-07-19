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
class vFleetTracker extends CodonModule
{
	public function index()
	{
		$this->set('allaircrafts', vFleetTrackData::getAllAircraft());
		$this->render('vFleetTrack/index.tpl');
	}
	
	public function view($registration)
	{
		$this->set('aircraft', vFleetTrackData::getAircraftInfo($registration));
		$this->render('vFleetTrack/view.tpl');
	}
	
	public function viewallmap()
	{
		$this->set('data', vFleetTrackData::getAllLastLocation());
		$this->render('vFleetTrack/map.tpl');
	}
	
	public function buildLastFlightTable($id, $count)
	{
		$this->set('flights', vFleetTrackData::getLastNumFlightsAircraft($id, $count));
		$this->render('vFleetTrack/flights.tpl');
	}
	
	public function buildFlightsAvbTable($id)
	{
		$this->set('flightsav', vFleetTrackData::buildFlightsAvbTable($id));
		$this->render('vFleetTrack/schedules.tpl');
	}
	
	
}