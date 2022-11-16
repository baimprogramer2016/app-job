<?php
//untuk detail role
function colorTag($angka)
{

	$color = ['primary', 'danger', 'success', 'info', 'secondary', 'warning', 'primary', 'danger', 'success', 'info', 'secondary', 'warning', 'primary', 'danger', 'success', 'info', 'secondary', 'warning'];
	return $color[rand(1, 9)];
}
//check akses untuk setting akses pada role
function checkAccess($data, $param)
{
	foreach ($data as $item) {
		if ($item->kodeakses == $param) {
			return 'checked';
			break;
		}
	}
}

//function untuk warna progress
function statusBar($value)
{
	if ($value >= 0 && $value <= 20) {
		$color = 'bg-danger';
	} elseif ($value > 20 && $value <= 40) {
		$color = 'bg-warning';
	} elseif ($value > 40 && $value <= 80) {
		$color = 'bg-success';
	} elseif ($value > 80 && $value <= 100) {
		$color = 'bg-primary';
	}
	return $color;
}
