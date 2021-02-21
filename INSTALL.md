# Getting Started

## Download XAMPP

1. Open the "Apache Friends" website: <https://www.apachefriends.org/download.html>
2. Click the `Download` button for the Windows version (or whatever version you need) of XAMPP and save the file on your computer.
Note: If you have special version requirements for PHP, then download the version youíre required to install.
If you donít have a version requirement, then download the oldest version, as it may help you to avoid issues trying to install a PHP based software.
In addition, these instructions have been tested to work for XAMPP version 7.3.22 and earlier versions, but you can also use them to install later versions.
3. Double-click the downloaded file to launch the installer.
4. Click the `OK` button.
5. Click the `Next` button.
6. XAMPP offers a variety of components that you can install, such as MySQL, phpMyAdmin, PHP, Apache, and more.
You must select to install MySQL, PHP, and Apache.
7. Click the `Next` button.
8. Use the default installed location. (Or choose another folder to install the software in the ìSelect a folderî field.)
9. Click the `Next` button.
10. Select the language for the XAMPP Control Panel.
11. Click the `Next` button.
12. Clear the Learn more about Bitnami for XAMPP option.
13. Click the `Next` button.
14. Click the `Next` button again.
15. Click the `Allow access` button to allow the app through the Windows Firewall (if applicable).
16. Click the `Finish` button.

## Running XAMPP on Windows
1. Launch the XAMPP control pannel.
2. Click `start` for both Apache and MySQL
3. Click on Explorer.
4. Navigate to the htdocs folder in this directory.
5. Copy the path name of the htdocs folder. (Can be copied from the path bar at the top).
6. Paste the path name preceding with cd into your windows terminal such as command prompt.
It should look like: cd C:\xampp\htdocs
7. Clone the github repository by using the git clone command: `git clone https://github-repo-link.com`
8. Use the dir or ls command to list all files in the directory and cd into the repository folder.
9. At this point you can now edit the files for the project and make changes as well as push and pull from github.
10. To view the webpage, simply type `localhost` in your browser of choice.


## Running XAMPP on Mac OS X

1. Launch App
2. In the General tab, click `start`
3. There will be a red circle at the top right corner of the menu, when that turns green you can navigate to the Services tab and click `Start All`

4. Go to Volumes tab and click `mount` (this mounts the directory onto your local machine)

5. In the volumes tab, click `Explore`

6. Click `cmd+f` on your keyboard or manually search for the file `htdocs`
7. Copy path name of folder and save it somewhere on your computer for easy access (the path name will be used in terminal to cd into to open and edit files easily)

8. In terminal, cd into the directory - this is the pathname you copied. Your code should look something like this:
`$cd /Users/NAME/.bitnami/stackman/machines/xampp/volumes/root/htdocs`

9. Clone your github repository in here:`$git clone https://github-repo-link.com`

10. LS into the repository: `$ls repository-name`

11. At this point, you can edit your files and push it to the repo.

12. To view your webpages, in XAMPP's startup menu, in the General tab, click `Go to Application`

## Adding the link to the navbar on XAMPP

1. When xampp is running, go to your htdocs folder by clicking `Explore` in the Volumes tab.

2. Once inside htdocs, open the `Dashboard` folder.

3. Open the `index.html` file in a text editor.

4. On line 55, add `<li class=""><a target="_blank" href="your repo link here">Repo Name</a></li>`

When you're at the webpage for xampp, your `Repo Name` should be in the navbar now for quick access.

## What Text Editor to use

You can use any text editor you prefer to edit your webpages on. Some examples are notepad++, Sublime Text, and Visual Studio Code.

## phpMyAdmin File Permissions for Mac OS X

For Mac OS X users, when clicking on `Go to Application` it will take you to tha dashboard. When you click onto phpMyAdmin, you will encounter an error.
To fix this:

1. In XAMPP's startup menu, hit `Explore` ***(You can hit `cmd+f` on your keyboard and search for `httpd-xampp.conf` OR follow the steps below to find the file)***

2. Open `etc` folder

3. Open `Extra` folder

4. Open `httpd-xampp.conf` file in text editor

5. At line 20 change to `Require all granted`

6. Save changes

7. phpMyAdmin should now work
