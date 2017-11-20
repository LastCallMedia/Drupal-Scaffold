#!/usr/bin/env bash
# Wraps curl to poll an HTTP server for a response.
# Retries 1x/second until a response is received.
#
timeout=5


while getopts ":t:h" opt; do
  case "${opt}" in
    t ) timeout=$OPTARG;;
    h )
      echo "Usage: $0 [-h|-t 10] http://127.0.0.1"
      exit 0;;
    \? ) echo "Invalid option: -$OPTARG" 1>&2; exit 1;;
  esac
done
shift $((OPTIND - 1))


address=$1

until curl "$address" > /dev/null 2>&1 || [ $timeout -eq 0 ]; do
  echo "Waiting for HTTP server, $((timeout--)) remaining attempts..."
  sleep 1
done

# Return curl's exit code.
curl "$address" > /dev/null 2>&1
exit $?

