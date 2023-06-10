import subprocess
import os
import webbrowser
import time

# Command 1
directory1 = r'D:\Work Area\Project\XAMPP'
command1 = 'xampp_start.exe'
os.chdir(directory1)
subprocess.call(command1, shell=True)

# Command 2
directory2 = r'D:\Work Area\Project\POS - Github\laravel-pos-master'
command2 = 'npm run dev'
os.chdir(directory2)
subprocess.Popen(['cmd', '/k', command2], shell=True)

# Command 3
command3 = 'php artisan serve'
subprocess.Popen(['cmd', '/k', command3], shell=True)

# Wait for server to start
time.sleep(5)

# Open browser
url = 'http://127.0.0.1:8000/login'
webbrowser.open(url)