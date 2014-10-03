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
?>
<h3><?php echo SITE_NAME?>'s Fleet Tracker</h3>

<?php
	if(!$allaircrafts)
	{
		echo '<div id="error">No Aircrafts!</div>';
		return;
	}
?>

<?php MainController::Run('vFleetTracker', 'viewallmap');?>

<table id="tabledlist" class="tablesorter">
<thead>
<tr>
	<th>ICAO</th>
	<th>Name</th>
	<th>Full Name</th>
	<th>Registration</th>
	<th>Last Flight</th>
    <th>Location</th>
    <th>Total Flights</th>
    <th>Total Hours</th>
    <th>Total Miles</th>
    <th>View</th>
</tr>
</thead>
<tbody>
<?php
foreach($allaircrafts as $aircraft)
{
	$lastflight = vFleetTrackData::getLastFlightAircraft($aircraft->id);
	if($lastflight)
	{		
		$last = '<a href="'.url('/pireps/view/'.$lastflight->pirepid).'">'.$lastflight->code.$lastflight->flightnum.' ('.$lastflight->depicao.' - '.$lastflight->arricao.')</a>';
	}
	else
	{
		$last = 'No Flights Yet!';	
	}
	
	$location = vFleetTrackData::getLastFlightAircraft($aircraft->id);
	if($location)
	{		
		$lastlocation = $location->arricao;
	}
	else
	{
		$lastlocation = 'N/A';	
	}
	
?>
<tr>
	<td><?php echo $aircraft->icao;?></td>
	<td><?php echo $aircraft->name;?></td>
	<td><?php echo $aircraft->fullname;?></td>
	<td><?php echo $aircraft->registration;?></td>
	<td><?php echo $last;?></td>
    <td><?php echo $lastlocation;?></td>
    <td><?php echo vFleetTrackData::countFlights($aircraft->id);?></td>
    <td><?php echo round(vFleetTrackData::countHours($aircraft->id));?></td>
    <td><?php echo round(vFleetTrackData::countMiles($aircraft->id));?></td>
    <td><a href="<?php echo url('/vFleetTracker/view/'.$aircraft->registration);?>">View Aircraft</a></td>
<?php
}
?>
</tbody>
</table>