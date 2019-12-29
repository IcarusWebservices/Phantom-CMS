<?php
/**
 * The events class.
 * 
 * The events class gathers data in packets. A packet will be "released" when an corresponding event is called.
 * This is similair to hooks in JetStream.
 * @since 1.0.0
 */
class PH_Events {
    
    /**
     * Contains the packets corresponding with an event
     * :event_name => [function, function, etc...]
     * 
     * @since 1.0.0
     */
    protected $packets = [];

    /**
     * The events that have already been called.
     * 
     * @since 1.0.0
     */
    protected $called_events = [];

    /**
     * Adds a function to a packet, awaiting until the event is called.
     * Will immediately call the function if the event has already been called.
     * 
     * @param string    $event      The name of the event.
     * @param callback  $function   The function to add.
     * 
     * @return void
     */
    public function await($event, $function) {
        
        if(in_array($event, $this->called_events)){
            $function();
        } else {
            if(isset($this->packets[$event])) {
                if(is_array($this->packets[$event])) {
                    array_push($this->packets[$event], $function);
                } else {
                    $this->packets[$event] = [$function];
                }
            } else {
                $this->packets[$event] = [$function];
            }
        }

    }

    /**
     * Executes an event, and adds it to the called events
     * 
     * @param string $event_name The name of the event to execute
     * 
     * @return void
     */
    public function call_event($event_name) {
        if(isset($this->packets[$event_name]) && is_array($this->packets[$event_name])) {
            foreach ($this->packets[$event_name] as $event) {
                if(is_callable($event)) {
                    $event();
                }
            }
        }
    }

}