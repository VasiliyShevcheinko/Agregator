# Agregator

<h2>Installation</h2>

<p>1. Clone the Project from GitHub.ru using the command: <code>git clone https://github.com/VasiliyShevcheinko/Agregator.git</code> or download by link: https://github.com/VasiliyShevcheinko/Agregator</p>
<p>2. Installs the project dependencies using the command: <code>composer install</code> inside project directory.</p>
<p>3. Your server should look into the directory public where the file index.php is located.</p>
<p>4. If Apache server is used, must be enabled mod_rewrite and the options: <samp>Options Indexes FollowSymLinks</samp>, "AllowOverride All" for the directory with the project must be set in /etc/apache2/apache2.conf</p>

<h2>Service extension</h2>

<p> To add a new source, you need to implement the source class inherited from src/Custom/AbstractCollector class. Your class should be located src/Custom/Collector/ directory. It must contain the source address and implement the "parse" method.
  In controller src/Controller/SourcesController, you need to add an action with the name of the new source and write the path following the example of the existing ones. 
  To display data from a new source, you need to add the view file to templates/sources/*.html.twig To make the new source available for use, you need to add a link to it on the sources page. To do this, you need to add the name of the new source and the path from SourcesController to array $sources in AgregatorController. </p>
