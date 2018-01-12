<?
header('Content-Type: text/html; charset=utf-8');
$host = $_SERVER['HTTP_HOST'];
setlocale(LC_TIME, "es_ES.utf8");
date_default_timezone_set('Europe/Madrid');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Bienvenido a <? print $host; ?>! Hostinger - Hosting Web con PHP y MySQL.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://cdn.rawgit.com/hostinger/banners/master/hostinger_welcome/css/site.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="main">
    <div id="content">
        <div class="header">
            <a id="logo" href="http://www.hostinger.es/"><img src="http://www.hostinger.es/images/logo-es.png" alt="Hosting Web" /></a>
        </div>
        <div class="content">
            <h1>Tu cuenta ha sido creada!</h1>
            <p>El sitio <b><? print $host; ?></b> ha sido correctamente instalado en el servidor! Por favor elimina el archivo <b>default.php</b> de la carpeta  <b>public_html</b> y luego carga tu sitio usando un cliente FTP o el Administrador de Archivos.</p>
            <div class="clear"></div>
        </div>
        <div class="footer"></div>
        <div class="clear"></div>
    </div>
    <div id="footer">
        <div class="links">
            <a href="http://www.hostinger.es/hosting-web" target="_blank">Hosting Web</a>
            <span class="pipe">|</span>
            <a href="http://www.hostinger.es/hosting-gratis" target="_blank">Hosting Gratis</a>
            <span class="pipe">|</span>
            <a href="http://www.hostinger.es/forum" target="_blank">Foro de Soporte</a>
            <span class="pipe">|</span>
            <a href="http://cpanel.hostinger.es/" target="_blank">Iniciar Sesión</a>
        </div>
        <div class="copyright">Hostinger España &copy; <? print date('Y'); ?>. Todos los derechos reservados.</div>
        <div class="social-icons">
            <a href="http://www.facebook.com/Hostinger.es"><img src="https://raw.githubusercontent.com/hostinger/banners/master/hostinger_welcome/images/fb.gif" /></a>
            <a href="https://twitter.com/HostingerES"><img src="https://raw.githubusercontent.com/hostinger/banners/master/hostinger_welcome/images/twitter.gif" /></a>
        </div>
    </div>
</div>
</body>
</html>