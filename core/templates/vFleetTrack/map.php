<div class="mapcenter" align="center">
<div id="routemap" style="width: 960px; height: 520px;"></div>
</div>

<script type="text/javascript">
var options = {
	zoom: 4,
	center: new google.maps.LatLng(<?php echo Config::Get('MAP_CENTER_LAT'); ?>, <?php echo Config::Get('MAP_CENTER_LNG'); ?>),
	mapTypeId: google.maps.MapTypeId.ROADMAP,
}
var map = new google.maps.Map(document.getElementById("routemap"), options);
</script>

<?php
$count = 0;
foreach($data as $l)
{
?>
<script type="text/javascript">
var pointer_<?php echo $count;?> = new google.maps.LatLng(<?php echo $l->arrlat?>, <?php echo $l->arrlng?>);
var point_<?php echo $count;?> = new google.maps.Marker({
	position: pointer_<?php echo $count;?>,
	map: map,
	title: "<?php echo "$l->acregistration is at $l->arrname ($l->arricao)";?>",
});
var contentString = '<?php echo $l->acname;?> (<?php echo $l->acregistration;?>) is at <?php echo $l->arrname.'('.$l->arricao.')';?>';
var infowindow_<?php echo $count;?> = new google.maps.InfoWindow({
    content: contentString
});
google.maps.event.addListener(point_<?php echo $count;?>, 'click', function() {
	infowindow_<?php echo $count;?>.open(map,point_<?php echo $count;?>);
});
</script>
<?php
$count = 1 + $count;
}
?>