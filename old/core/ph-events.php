<?php
/**
 * This file contains functions related to events
 * 
 * @since 1.0.0
 */

/**
 * Awaits an event. If the event has already been called, will immediately execute.
 * Adds a function to the global events manager.
 * 
 * @since 1.0.0
 * 
 * @param string    $event      The name of the event.
 * @param callback  $function   The function to execute when the event is called.
 * @param array     $data       The data to be carried over to the function.
 * 
 * @return void
 */
function await($event, $function, $data = []) {
    global $events;

    $events->await($event, $function, $data);
}