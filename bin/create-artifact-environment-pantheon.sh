#!/bin/bash

#
# Ensure a multidev environment exists for a branch.
#
set -e

usage() {
  echo "
Ensure a multidev environment exists for a branch.

Options:
  -h: Show help
  -b: Set the branch name (required)
  -i: Set the Pantheon site that will be used (defaults to TERMINUS_SITE).
  -s: Set the source environment (defaults to live)
  -n: Dry run (does not create environment).

Usage:
  Ensure a multidev site exists for the xyz branch:

  $0 -b xzy -i mysite
"
}

error_out() {
  echo $1 >&2
  exit $2
}

pattern=".*"
site="$TERMINUS_SITE"
source="live"
dryrun=0
while getopts "hb:i:s:n" opt; do
  case "$opt" in
    h) usage; exit 0;;
    b) branch=$OPTARG;;
    i) site=$OPTARG;;
    s) source=$OPTARG;;
    n) dryrun=1;;
  esac
done

test -n "$site" || error_out "Site must be set using the -s flag or the TERMINUS_SITE environment variable" 1
test -n "$source" || error_out "Source environment must be set."
test -n "$branch" || error_out "Branch name must be set using the -b flag."

if terminus env:info "$site.$branch" > /dev/null 2>&1; then
  echo "Multidev environment exists for $branch"
else
  echo "Creating environment for $branch"
  [[ $dryrun -eq 1 ]] || terminus multidev:create "$site.$source" "$branch"
fi
