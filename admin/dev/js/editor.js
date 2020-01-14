var editor = ace.edit("editor");
editor.setTheme("ace/theme/twilight");
var PHPMode = ace.require("ace/mode/php").Mode;
editor.session.setMode(new PHPMode());