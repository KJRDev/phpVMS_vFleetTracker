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
<?php
	if(!$flights)
	{
		echo '<div id="error">No Flights Flown with this aircraft!</div>';
		return;
	}
?>
<table id="tabledlist" class="tablesorter">
<thead>
<tr>
	<th>Flight #</th>
	<th>Departure</th>
	<th>Arrival</th>
	<th>Flight Time</th>
	<th>Flight Date</th>
    <th>Landing Rate</th>
    <th>View</th>
</tr>
</thead>
<tbody>
<?php
foreach($flights as $flight)
{	
?>
<tr>
	<td><?php echo $flight->code . $flight->flightnum; ?></td>
	<td><?php echo $flight->depicao; ?></td>
	<td><?php echo $flight->arricao; ?></td>
	<td><?php echo round($flight->flighttime); ?></td>
	<td><?php echo date(DATE_FORMAT, $flight->submitdate); ?></td>
    <td><?php echo $flight->landingrate; ?></td>
    <td><a href="<?php echo url('/pireps/view/'.$flight->pirepid);?>">View</a></td>
<?php
}
?>
</tbody>
</table>