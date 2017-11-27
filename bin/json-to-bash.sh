#! /usr/bin/env php
<?php
/**
 * This script converts JSON from stdin to BASH environment variable exports.
 *
 */
$obj = json_decode(file_get_contents('php://stdin'));
if(json_last_error()) {
  throw new Exception(sprintf('JSON failed to decode: %s', json_last_error_msg()), json_last_error());
}
if(!$obj) {
  exit(1);
}
foreach($obj as $k => $v) {
  if(!is_scalar($v)) {
    throw new \Exception(sprintf('Invalid non-scalar value for %s', $k));
  }
  if(!preg_match('/[A-Z1-9_]/', strtoupper($k))) {
    throw new \Exception(sprintf('Invalid key: %s', $k));
  }
  print sprintf("export %s=%s\n", strtoupper($k), escapeshellarg($v));
}
