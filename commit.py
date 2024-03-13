#!/usr/bin/python3
import os
from datetime import datetime
import argparse

parser = argparse.ArgumentParser(description='this is a git commit script')
parser.add_argument('-m', type=str, help='git commit message', nargs='?', default=None)
args = parser.parse_args()
message = args.m

if args.m is not None:
    commit_msg = args.m
else:
    current_time = datetime.now()
    formatted_time = current_time.strftime("%Y-%m-%d %H:%M:%S")
    commit_msg = "python auto commit at:" + formatted_time

os.system("git pull origin main");
os.system("git add .");
os.system("git commit -m \"" + commit_msg +"\"");
os.system("git push -u origin main");
print(" ")
print("============== GIT SYNC COMPLETE! ==============")

