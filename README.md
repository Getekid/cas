phpbb3-CAS-Auth-plugin
======================

A plugin to enable phpCAS Authentication for phpbb 3.3.x
----------------
Adding this extention to your phpBB3 forum will enable phpCAS Authentication for your board.  
**This is NOT a phpbb MOD**. In phpbb 3.3.x all the modifications to the board are made through extentions.  
   
In order to install the extention:

1.  Download the zip
2.  Extract it's contents in the root/ext directory of your phpbb3 installation (the "getekid" folder must the one in the ext directory)
3.  Install the phpCAS library (the steps required are below)
4.  Login to the ACP of your forum
5.  Go to the "Customize" tab
6.  Enable the extention (click confirm when asked)
7.  Go to the "General" tab
8.  Click on "Authentication" under "Client Communication". Cas should be available in the dropdown list.
9.  Select "Cas" and add the CAS data of your server (click Submit when finished entering the data)

phpCAS library

As all of the web plugin to enable CAS authentication, this one also requires the apereo library from Jasig to work (not included in this package for the user to get its from the official page). In order ro install it:

1st solusion:
   1.  Download the latest stable release from apereo :[Github](https://github.com/apereo/phpCAS)
   2.  Extract the tgz/zip
   3.  Take the folder **containing** the "CAS.php" file, rename it to CAS and copy it to getekid/cas/auth/provider/ 
2nd solusion for debian:
   => apt-get install php-cas
Enjoy
