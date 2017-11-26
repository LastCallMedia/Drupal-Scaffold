#!/bin/bash

#
# Cleanup multidev environments.
#
set -e

usage() {
  echo "
Cleanup multidev environments for branches that no longer exist for the remote of the current repository.

Options:
  -h: Show help
  -p: Set a regex pattern branch names must match to consider for pruning.
  -s: Set the git repository that will be used as the source (defaults to origin).
  -i: Set the Pantheon site that will be used (defaults to TERMINUS_SITE).
  -n: Dry run (does not delete sites)

Usage:
  Delete all multidev sites built off of a p-* branch that no longer exist on the current origin:

  $0 -p 'p-.*' -i mysite
"
}

error_out() {
  echo $1 >&2
  exit $2
}

pattern=".*"
site="$TERMINUS_SITE"
source="origin"
dryrun=0
while getopts "hp:s:i:n" opt; do
  case "$opt" in
    h) usage; exit 0;;
    p) pattern=$OPTARG;;
    s) source=$OPTARG;;
    i) site=$OPTARG;;
    n) dryrun=1;;
  esac
done

test -n "$site" || error_out "Site must be set using the -s flag or the TERMINUS_SITE environment variable" 1

multidevs=$(terminus multidev:list --field=id "$site")

IFS=$'\n';
for multidev in $multidevs; do
  if [[ "$multidev" =~ $pattern ]]; then
    if ! git ls-remote --quiet --exit-code "$source" "$multidev" > /dev/null 2>&1; then
      echo "Deleting $multidev environment."
      [[ $dryrun -eq 1 ]] || terminus multidev:delete --delete-branch "$site.$multidev"
    fi
  fi
done


