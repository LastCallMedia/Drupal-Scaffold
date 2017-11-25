#!/bin/bash

#
# Build an artifact based off of the current working copy.
#
# This shell script should be run inside of a git repository.
# It mirrors the files in the working copy (the source repository)
# into another repository (the artifact repository).  The artifact
# repository can have entirely different .gitignore files -- any
# files named .artifact.gitignore will be used as the .gitignore
# in whatever directory they are found in.
#
set -e

usage() {
  echo "
Builds a git artifact from a source repository.

Options:
  -h: Show help
  -d: Set downstream URL (required)
  -b: Set downstream branch Defaults to current source repo branch.
  -m: Set commit message.  Defaults to last source repo commit message.
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

message=$(git show --quiet --format=%B)
author=$(git show --quiet --format='%aN <%ae>')
branch=$(git symbolic-ref --short HEAD 2>/dev/null || true)
commit=$(git show --quiet --format=%h)
srcbranch=master
agit="git --git-dir=.artifact"

while getopts "hd:b:m:n" opt; do
  case "$opt" in
    h) usage;;
    d) downstream=$OPTARG;;
    b) branch=$OPTARG;;
    m) message=$OPTARG;;
    n) skipcommit=true;;
  esac
done

test -n "$branch" || error_out "Branch must be set by using the -b flag." 1
git check-ref-format --branch "$branch" > /dev/null 2>&1 || error_out "Invalid branch name $branch" 1
test -n "$downstream" || error_out "Downstream must be set by using the -d flag." 1
test -n "$message" || error_out "Empty message is not allowed." 1
test ! -e ".artifact" || error_out "Artifact directory already exists at .artifact. Remove this directory before continuing." 1

# Hard ignore the .artifact directory.
grep -Fxq ".artifact" .git/info/exclude || {
  mkdir -p .git/info && echo ".artifact" >> .git/info/exclude
}

# Setup the .artifact repository:
git init --bare .artifact
grep -Fxq ".artifact" .artifact/info/exclude || echo ".artifact" >> .artifact/info/exclude
$agit config core.bare false
$agit remote add origin "$downstream" && echo "Setting artifact origin to $downstream"

echo "Fetching downstream.  This may take a moment..."
if $agit fetch --depth=1 -q origin "$branch" 2>/dev/null; then
  echo "Detected existing $branch branch. Starting from here."
  $agit branch "$branch" $($agit show-ref -s $branch)
  $agit symbolic-ref HEAD "refs/heads/$branch"

elif $agit fetch --depth=1 -q origin "$srcbranch" 2>/dev/null; then
  echo "The $branch branch doesn't exist yet. Starting from $srcbranch"
  $agit branch "$branch" $($agit show-ref -s $srcbranch)
  $agit symbolic-ref HEAD "refs/heads/$branch"

else
  error_out "Neither $branch or $srcbranch exist in the downstream. Cannot continue." 1
fi

# Rename .artifact.gitignore to .gitignore recursively.
find . -name .artifact.gitignore -exec sh -c 'mv {} $(dirname {})/.gitignore' \;

$agit add .
if [ $skipcommit ]; then
  $agit commit --dry-run -m "$message" --author "$author" -m "Built from upstream commit $commit"
  echo "Skipping final commit.  Changes are listed above."
else
  $agit commit -m "$message" --author "$author" -m "Built from upstream commit $commit"
  $agit push "$downstream" "$branch"
fi

# Reset .gitignore files and remove .artifact.
git checkout $(git ls-files *.gitignore)
rm -rf .artifact





