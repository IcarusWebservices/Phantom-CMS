<?php
/**
 * This class logs all problems/request info to a log.txt file.
 * 
 * PH_Logger will only log if RUN_DEV has been set to 1
 */
class PH_Logger {

    /**
     * The output file to log to
     * 
     * @since 2.0.0
     */
    public $output_file = ROOT . "log.txt";

    /**
     * Whether all logs should happen at the end of execution or that a log must happen every time a log was requested
     * 
     * @since 2.0.0
     */
    public $log_all = true;

    /**
     * An array containing all messages to be logged
     * 
     * @since 2.0.0
     */
    protected $logs = [];

    /**
     * Logs a string to log.txt
     * 
     * @param string $message The message to log
     * 
     * @since 2.0.0
     */
    public function log($message) {
        $timestamp = date('G:i:s:v');

        array_push($this->logs, [
            "timestamp" => $timestamp,
            "message" => $message
        ]);

        if(!$this->log_all) {
            $this->write_log();
        }
    }

    /**
     * Writes to the log.txt file
     * 
     * @since 2.0.0
     */
    public function write_log() {
        // var_dump($this->logs);
        $output = "";
        foreach ($this->logs as $log) {
            $fullstring = "[" . $log["timestamp"] . "] " . $log["message"] . "\n";
            $output .= $fullstring;
        }

        file_put_contents($this->output_file, $output, FILE_APPEND);

        $this->logs = [];
    }

}