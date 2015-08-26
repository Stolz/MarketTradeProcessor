<?php

/**
 * Generate a form select input from an array.
 *
 * @param  string $name
 * @param  array  $items
 * @return string
 */
function dropdown($name, array $items)
{
	$old = old($name);
	$html = "<select name=\"$name\">";

	foreach($items as $key => $value)
	{
		$selected = ($key == $old) ? ' selected' : null;

		$html .= "<option value=\"$key\"$selected>$value</option>";
	}

	return $html . '</select>';
}

/**
 * Generate date for humans.
 *
 * @param  Carbon\Carbon
 * @return string
 */
function date_for_humans(Carbon\Carbon $date)
{
	return sprintf('<abbr title="%s">%s</abbr>', $date->diffForHumans(), $date);
}

/**
 * Generate currency for humans.
 *
 * @param  App\Currency
 * @param  number
 * @return string
 */
function currency(App\Currency $currency, $amount)
{
	return sprintf('<abbr title="%s">%s</abbr>', $currency, $currency->format($amount));
}
