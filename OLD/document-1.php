<?php 
	include('app/database/functions.php');
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Documentation</title>
  <meta name="viewport" content="width=device-width">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="/assets/images/fav.png">

  <!-- Custome Styles -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
  integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
</head>
<body>

	<div class="header">
		<h2>Documentation</h2>
	</div>

  <div class="nav-header">
    <div id="nav-list">
      <li class="nav-list-item"><a class="nav-list-link" href="/">Home</a></li>
      <li class="nav-list-item"><a class="nav-list-link" href="documentation.php">Documentation</a></li>
      <li class="nav-list-item"><a class="nav-list-link" href="about.php">About</a></li>
    </div>
    <hr style="width:50%">
    <div class="nav-list-log">
      <?php if(isLoggedIn()){?>
        <div id="profilelogout">
          <li class="nav-list-item"><a id="profile" href="profileinfo.php">Profile</a></li>
          <li class="nav-list-item"><a id="logout" href="/?logout='1'">Logout</a></li>
        </div>
		  <?php }else{ ?>
        <div id="loginreg">
          <li class="nav-list-item"><a id="login" href="login.php">Login</a></li>
          <li class="nav-list-item"><a id="register" href="register.php">Register</a></li>
        </div>
		  <?php } ?>
    </div>
  </div>
        <br><br><br>
        <a href="javascript:history.back()" name="btn" class="btn" >Back</a>
        <div class="main-content">
      <div class="content-header">
        <h2 style="text-align:center;">Creating Domain/Subdomains on Cloudflare</h2>
        <h4 style="text-align:center; color:gray;">Check it out</h4>
      </div>
<br>
<div class="steps">
<h3>
    Introdcution
</h3>
<p>
    This documentation will go over how to create a domain/subdomain on cloudflare. It will also go through how to edit and update all the necessary files needed. These steps are going to show you what to do after you have your cloudflare account set up and you have purchased a domain from cloudflare or your desired domain registrar.
</p>
<br>
<h3>
    Step 1:
</h3>
<p>
    You are going to need to create a directory in you /var/www directory connected with apache2. Do this by using this command, where you will change the domain.com with your desired domain/subdomain name:
</p>
<pre><code>
sudo mkdir -p /var/www/domain.com/public_html
</code></pre>
<br>
<h3>
    Step 2:
</h3>
<p>
You are going to need to change the permission of the folder. Do this by running the following command:
</p>
<pre><code>
sudo chmod -R 755 /var/www
</code></pre>
<br>
<h3>
    Step 3:
</h3>
<p>
It's time to create the Index Page for your website. You are going to need to create an index.html file for each domain.  This step is going to show you how to create one index.html for one domain, but you will do the same thing for each domain if you have multiple. 
<br><br>
Create index.html within your directory you created in step 1(you can use whatever text editor you want, I use nano).
</p>
<pre><code>
sudo nano /var/www/domain.com/public_html/index.html
</code></pre>
<br>
<p>
You can add any text that you want within the document but for a test document while we make sure that we can get the website up and running, you can put just a test line of text like this.
</p>
<pre><code>
testing for domain.com
</code></pre>
<br>
<p>
You will need to create an index.html file for each of the sites you are creating.
</p>
<br>
<h3>
    Step 4:
</h3>
<p>
Now its time to copy the config files for each site. You will do this by running the following command:
</p>
<pre><code>
cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/domain.com.conf
</code></pre>
<br>
<p>
You will need to do this for each of the sites that you are creating, just make sure you change the "domain.com" to your domain/subdomain name.
</p>
<br>
<h3>
    Step 5:
</h3>
<p>
Now it is time to edit the config file that you just copied for your site. You will do this by running this code(again using the text editor that you desire). 
</p>
<pre><code>
sudo nano /etc/apache2/sites-available/domain.com.conf
</code></pre>
<br>
<p>
Now inside your file, you will add/edit the lines.
</p>
<br>
<pre><code>
&lt;VirtualHost *:81> <br>
ServerAdmin webmaster@localhost<br>
ServerName domain.com<br>
ServerAlias www.domain.com<br>
DocumentRoot /var/www/domain.com/public_html<br>
ErrorLog ${APACHE_LOG_DIR}/error.log<br>
CustomLog ${APACHE_LOG_DIR}/access.log combined<br>
&lt;/VirtualHost>
</code></pre>
<br>
<p>
Update ServerName, ServerAlias, and DocumentRoot where it mentions domain.com, you change it with your domain/subdomain. You can also change to port number from :80 to whatever port you are porting your site off of. You will have to make sure that you edit your /etc/apache2/ports.conf. This file contains the ports that your IP address listens to. 
<br><br>
To edit this file, run the following command: 
</p>
<pre><code>
sudo nano /etc/apache2/ports.conf
</code></pre>
<br>
<p>
In this file where you see Listen 80, you will add whatever port you are wanting to Listen to. 
<br><br>
For an example, the grayed out "Listen 81" is what I added in because that is the port I want my Ipaddress to listen to.
</p>
<pre><code>
# If you just change the port or add more ports here, you will likely also<br>
# have to change the VirtualHost statement in<br>
# /etc/apache2/sites-enabled/000-default.conf<br>
<br>
Listen 80<br>
Listen 81<br>

&lt;IfModule ssl_module><br>
	Listen 443<br>
&lt;/IfModule><br>

&lt;IfModule mod_gnutls.c><br>
	Listen 443<br>
&lt;/IfModule><br>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
</code></pre>
<br>
<h3>
    Step 6:
</h3>
<p>
Now its time to enable your config files. You will first have to disable the 000-default.conf file. You will do this by running the following command:
</p>
<pre><code>
sudo a2dissite 000-default.conf
</code></pre>
<br>
<p>
You will now enable your conf files by running the following command:
</p>
<br>
<pre><code>
sudo a2ensite domain.com.conf
</code></pre>
<br>
<p>
You will now have to restart the apache2 service so it will register our changes.
</p>
<br>
<pre><code>
sudo systemctl restart apache2
</code></pre>
<br>
<h3>
    Step 7:
</h3>
<p>
This is an important step, we want to check whether or not our sites are up and running. You will do this but going to your ip address. For example if your ip address is 192.168.1.10 you will want to go to the port you used for the site, so it will be 192.168.1.10:80, where the :80 is your port you are trying to go to. Once you can see that they are working, then we will move on to the steps that lead us into the Cloudflare steps.
</p>
<br>
<h2>
Cloudflare Steps 
</h2>
<h3>
    Step 8:
</h3>
<p>
In this step, we are going to create a tunnel, but if you already have a tunnel created then you can jump to step () and you can skip the tunnel set up steps. To create a tunnel, you will run this command to get your connection authorized. 
</p>
<pre><code>
cloudflared tunnel login
</code></pre>
<br>
<p>
This will either redirect you or give you a link that you can copy which is where you will authorize your site for the tunnel login. After this step you will create the tunnel with the following command: 
</p>
<pre><code>
cloudflared tunnel create &lt;your tunnel name>
</code></pre>
<br>
<p>
In this command you will replace &lt;your tunnel name> with a desired name for your tunnel. It can be anything usually a one word name. This will create the tunnel within your cloudflare. You can check your tunnel list at your <a href="https://dash.teams.cloudflare.com/" target="_blank">https://dash.teams.cloudflare.com/</a> URL which you can access through your cloudflare dashboard or you can run a command to list the current tunnels you have running. Keep track of the tunnel ID(UUID), you will need this later on. It will also create a file that has your tunnel ID(UUID).json. This is what controls the tunnel credentials file for you and you will need it later on when we configure your config.yaml file. 
</p>
<pre><code>
cloudflared tunnel list
</code></pre>
<br>
<p>
This command will help you see if the tunnel you created was actually created. If not, just try again with the tunnel create command above. 
<br><br>
The next part of this step would be to create the config.yaml file, but if you already have one then you can just edit the file. I am going to show two different ways to have your config.yaml file. One will be to just have one site running on your tunnel and the second one will allow for you to have multiple domains/sub domains. If you don't have the command, run the following command:
</p>
<pre><code>
sudo nano config.yaml
</code></pre>
<br>
<p>
Once you get this file created, you will put this information in for a single domain/sub domain and just make sure you update it with the information you need, which I will point out for you.
</p>
<pre><code>
url: http://localhost:81<br>
tunnel: &lt;tunnel UUID><br>
credentials-file: /&lt;path_to_config.yaml>/&lt;tunnel UUID>.json<br>
</code></pre>
<br>
<p>
I am going to go through the parts of this config.yaml file. In the url you will keep "http://localhost:81", where the :81 is the port for this specific domain/sub domain that you used back in step 5.. In the tunnel line, you will put the tunnel UUID from when you created the tunnel. In the credentials line, you are going to place the full path of the credentials file. To find the exact path of your config.yaml file, you can run the following command:
</p>
<pre><code>
readlink -f config.yaml
</code></pre>
<br>
<p>
That was to set up the config.yaml file for a single domain/sub domain, but for multiple domains/sub domains to run through a single tunnel, we will use ingress. For this you will post in the following information:
</p>
<pre><code>
tunnel: &lt;tunnel UUID><br>
credentials-file: /&lt;path_to_config.yaml>/&lt;tunnel UUID>.json<br>

ingress:<br>
  - hostname: domain.us<br>
    service: http://localhost:80<br>
  - hostname: domain.subdomain.us<br>
    service: http://localhost:81<br>
# you'll always need this at the end as the "catch all" for if an endpoint is not found<br>
  - service: http_status:404
</code></pre>
<br>
<p>
You can see the difference between the single domain/sub domain config file and the multiple domain/sub domain config file. The main difference is that you don't have the URL line in the multiple domain/sub domain config file because you are using the ingress method. Under the ingress you will put hostname: which is going to be how you access it instead of the ip address(of course this hostname is going to have to be a domain that you have purchased, if you it's a sub domain, it will be a sub of the domain that you purchased). And then you will see the service line, this will be where you put "http://localhost:80", where the :80 is the port number that you used for that subdomain back in step 5. 
<br><br>
The next part of this step is routing your traffic. This will be done by using the following command: 
</p>
<pre><code>
cloudflared tunnel route dns &lt;TUNNEL NAME> &lt;hostname>
</code></pre>
<br>
<p>
In using this command, you will need to replace &lt;TUNNEL NAME> with the tunnel name you assigned to your tunnel when you created it above. And then the host name will be either the URL you put on the url line in the single domain/sub domain config file or the hostname in the ingress section in the multiple domain/sub domain config file. If you are creating a tunnel route for the single domain/sub domain you will just have to do this once, but if you are doing it for multiple domains/sub domains, then you will have to do a single command of the <code>cloudflared tunnel route dns &lt;NAME> &lt;hostname></code> for each domain/sub domain you have on the multiple config file.
<br><br>
We are going to now run your tunnel to make sure your domain/sub domains are up and running. You should be able to go to the domain or sub domain to get to the site to see if its working correctly. 
<br><br>
If you currently have a tunnel running, you will need to follow some steps but if you don't have a tunnel currently running, then skip to the next section. If you have a tunnel running, you will need to disable the Daemon that you have up and running. Run the next commands in a line:
</p>
<pre><code>
sudo systemctl stop cloudflared
</code></pre>
<br>
<pre><code>
sudo systemctl disable cloudflared
</code></pre>
<br>
<pre><code>
sudo rm /etc/cloudflared/config.yml
</code></pre>
<br>
<p>
This is going to remove the activated Daemon that you have running. Once you remove that, then you will be able to run you tunnel correctly. If you don’t have a tunnel currently running, then this is where you are going to need to be. To get your tunnel up and running manually, you will need to run this command:
</p>
<pre><code>
cloudflared tunnel --config /&lt;path_to_config.yaml>/config.yaml run
</code></pre>
<br>
<p>
Where you will replace &lt;path_to_config.yaml> with the path to your config.yaml file. And then this will run your tunnel and you should be able to get to your site via your domain or sub domain. If you are able to get to your domain/sub domain via domain.com or subdomain.domain.com, then you know its working and its time to put up your tunnel via a Daemon. To do this, you need to run the following simple code if you are in the directory that your config file is in:
</p>
<pre><code>
sudo cloudflared --config config.yaml service install
</code></pre>
<br>
<p>
Run the following code if you are not in the folder that includes your config.yaml file:
</p>
<pre><code>
sudo cloudflared --config /&lt;path_to_config.yaml>/config.yaml service install
</code></pre>
<br>
<p>
After running that script, then you will need to run the following commands in consistent to finish up the Daemon set-up:
</p>
<pre><code>
sudo systemctl start cloudflared
</code></pre>
<br>
<pre><code>
sudo systemctl enable cloudflared
</code></pre>
<br>
<p>
You should now be able to access your site anywhere on any network. If you want to go back and add another subdomain you can just go back and follow these steps.
<br><br>
If there are any questions that you have, please feel free to contact <a href="mailto:garr.morg@gmail.com" target="_blank">here</a>.
</p>
<br><br><br>






</div>



    </div>
</body>
</html>