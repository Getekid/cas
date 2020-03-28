# phpbb3-CAS-Auth-plugin

## A plugin to enable phpCAS Authentication for phpbb 3.3.x

Adding this extention to your phpBB3 forum will enable phpCAS Authentication for your board.  

### How to install

#### Using Composer
Run `composer require getekid/cas` to install the latest version.

#### Downloading the package
1.  Download the zip file
2.  Extract the zip file contents in a new `root/ext/getekid/cas` directory in your phpbb3 installation
    - i.e. the files in the repo should exist directly in the `root/ext/getekid/cas` directory
3.  Install the phpCAS library (the steps required are below)
4.  Login to the ACP of your forum
5.  Go to the "Customize" tab
6.  Enable the extention (click confirm when asked)
7.  Go to the "General" tab
8.  Click on "Authentication" under "Client Communication". Cas should be available in the dropdown list.
9.  Select "Cas" and add the CAS data of your server (click Submit when finished entering the data)

phpCAS library

As all of the web plugin to enable CAS authentication, this one also requires the phpCAS library from Jasig to work (not included in this package for the user to get its from the official page). In order ro install it:

1.  Download the latest stable release from Jasig [wiki](https://wiki.jasig.org/plugins/servlet/mobile#content/view/737) or [Github](https://github.com/Jasig/phpCAS)
2.  Extract the tgz/zip
3.  Take the folder **containing** the "CAS.php" file, rename it to CAS and copy it to getekid/cas/auth/provider/ 

Enjoy
