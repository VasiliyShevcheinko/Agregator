# Agregator

<h2>Installation</h2>

1 Clone the Project from GitHub.ru using the command <span style="font-style:italic">git clone https://github.com/VasiliyShevcheinko/Agregator.git</span> or download by link <a href='https://github.com/VasiliyShevcheinko/Agregator'>https://github.com/VasiliyShevcheinko/Agregator</a><br>
2 Installs the project dependencies using the command 'composer install' inside project directory.<br>
3 Your server should look into the directory public where the file index.php is located.<br>
4 If Apache server is used, must be enabled mod_rewrite and the options "Options Indexes FollowSymLinks", "AllowOverride All" for the directory with the project must be    set in /etc/apache2/apache2.conf

<h2>Service extension</h2>

To add a new source, you need to implement the source class inherited from src/Custom/AbstractCollector class. Your class should be located src/Custom/Collector/ directory. It must contain the source address and implement the "parse" method.
In controller src/Controller/SourcesController, you need to add an action with the name of the new source and write the path following the example of the existing ones. 
To display data from a new source, you need to add the view file to templates/sources/*.html.twig 
To make the new source available for use, you need to add a link to it on the sources page. To do this, you need to add the name of the new source and the path from SourcesController to array $sources in AgregatorController. 
