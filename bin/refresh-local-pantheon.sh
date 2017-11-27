#!/bin/bash

#
# Refresh your local environment from Pantheon.
#
set -e

usage() {
  echo "
Refresh your local environment from Pantheon.

Options:
  -h: Show help
  -i: Set the Pantheon site that will be used (defaults to TERMINUS_SITE).
  -s: Set the Pantheon environment that will be used (defaults to TERMINUS_SOURCE_ENVIRONMENT/live)
  -c: Set the cache directory to work from.
  -n: Dry run (does not create environment).

Usage:
  Refresh local site from a Pantheon site named 'mysite''s dev environment.

  $0 -i mysite -s dev -c /tmp/mysite
"
}

error_out() {
  echo $1 >&2
  exit $2
}

site="$TERMINUS_SITE"
source="${TERMINUS_SOURCE_ENVIRONMENT:-live}"
cache="/tmp/$(date +%s)"
dryrun=0
while getopts "hi:s:c:n" opt; do
  case "$opt" in
    h) usage; exit 0;;
    i) site=$OPTARG;;
    s) source=$OPTARG;;
    c) cache=$OPTARG;;
    n) dryrun=1;;
  esac
done

test -n "$site" || error_out "Site must be set using the -i flag or the TERMINUS_SITE environment variable" 1
test -n "$source" || error_out "Source environment must be set using the -s flag or the TERMINUS_SOURCE_ENVIRONMENT environment variable" 1


mkdir -p "$cache"

filename="$cache/db.sql.gz"

# Allow caching of the backup file by passing a cache directory.
if [[ ! -f "$filename" ]]; then
  echo "Retrieving backup of $source from Pantheon"
  terminus backup:get "$site.$source" --element=db --to="$filename"
  echo "Backup saved to $filename"
fi

pushd web > /dev/null
  ../vendor/bin/drush sql-drop -y
  zcat "$filename" | ../vendor/bin/drush sql-cli
  echo "Backup successfully imported"
popd > /dev/null
