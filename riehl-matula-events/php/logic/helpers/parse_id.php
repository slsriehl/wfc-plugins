<?php

function parse_id($full_id, $extension) {
	//returns just the db id from the value of an id/option with a prefix
	return intval(str_replace($extension, '', $full_id));
}
