#!/bin/bash

artifactGit="git --git-dir=.artifact"

if [ -z "$BRANCH" ]; then
  echo "\$BRANCH not set - exiting"
  exit 1
fi
git check-ref-format --branch $BRANCH

if [ -z "$DOWNSTREAM" ]; then
  echo "\$DOWNSTREAM not set - exiting"
  exit 1
fi

if [ -f ".git" ]; then
  echo "Must be run from a git repository root."
  exit 1
fi

echo ".artifact" >> .git/info/exclude

git init --bare .artifact
echo ".artifact" >> .artifact/info/exclude
$artifactGit config core.bare false
$artifactGit remote add origin "$DOWNSTREAM"
$artifactGit fetch --depth=1 origin "$BRANCH" || $artifactGit fetch --depth=1 origin master
$artifactGit show-ref "refs/heads/${BRANCH}" && srcbranch=$BRANCH || srcbranch='master'

# Create a new branch and check out to it.
$artifactGit branch "$BRANCH" $($artifactGit show-ref -s $srcbranch)
$artifactGit symbolic-ref HEAD "refs/heads/$BRANCH"

# Prep the final artifact.
# Enact .artifact.gitignore.
mv .artifact.gitignore .gitignore
# Add new files
$artifactGit add .
# Remove newly excluded files.
$artifactGit ls-files -z --ignored --exclude-standard | xargs -0 $artifactGit rm -r --cached --ignore-unmatch
# Commit and push
$artifactGit commit -m "$MESSAGE"
$artifactGit push origin "$BRANCH"
# Cleanup .artifact repository.
rm -rf .artifact

