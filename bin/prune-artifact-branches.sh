#!/bin/bash

#
# Deletes git branches found in the artifact repository that are not
# found in the source repository.
#
set -e

usage() {
  echo "
Delete git branches found in the artifact repository that are not found in the source repository.

Options:
  -h: Show help
  -a: Set artifact repository URL (required)
  -s: Set source repository URL (defaults to origin of current repo)
  -p: Set patterns for branches to consider for deletion (defaults to *)
  -n: Dry run - display changes instead of committing and pushing.

Usage:
  Build and push to an artifact repository on github:

  $0 -d git://github.com/example/artifact.git
"
}

error_out() {
  echo $1 >&2
  exit $2
}

test -d ".git" || error_out "Must be run from a git repository root." 1

src=origin
pattern="*"
dryrun=0
while getopts "hs:a:p:n" opt; do
  case "$opt" in
    h) usage; exit 0;;
    s) src=$OPTARG;;
    a) artifact=$OPTARG;;
    p) pattern=$OPTARG;;
    n) dryrun=1;;
  esac
done

test -n "$artifact" || error_out "Downstream must be set using the -d flag"

echo "Retrieving all branches matching $pattern from source and artifact"

srcbranches=$(git ls-remote -h "$src" "$pattern" | cut -d$'\t' -f 2)
artifactbranches=$(git ls-remote -h "$artifact" "$pattern" | cut -d$'\t' -f 2)

IFS=$'\n';
for artifactbranch in $artifactbranches; do
  exists=0
  for srcbranch in $srcbranches; do
    if [[ "$artifactbranch" == "$srcbranch" ]]; then
      exists=1
      break
    fi
  done
  if [[ $exists -eq 0 ]]; then
    echo "Deleting $artifactbranch from artifact repository"
    [[ $dryrun -eq 1 ]] || git push "$artifact" ":$artifactbranch"
  fi
done
