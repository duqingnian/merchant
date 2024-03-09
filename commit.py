#!/usr/bin/python
import os
from datetime import datetime

current_time = datetime.now()
formatted_time = current_time.strftime("%Y-%m-%d %H:%M:%S")
commit_msg = "python auto commit at:" + formatted_time

os.system("git pull origin main");
os.system("git add .");
os.system("git commit -m \"" + commit_msg +"\"");
os.system("git push -u origin main");
print(" ")
print("============== GIT SYNC COMPLETE! ==============")

