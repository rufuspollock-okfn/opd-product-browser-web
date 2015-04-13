<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		
		<title><?=$VALUE_SiteTitle?></title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Style-Type" content="text/css; charset=utf-8"> 
		<meta http-equiv="Content-Script-Type" content="text/javascript; charset=utf-8">
		<meta http-equiv="Content-Language" content="<?=SITE_LANGUAGE?>" />
		
		<? if(SITE_DESCRIPTION != "") { ?><meta http-equiv="description" name="description" content="The world's largest open product database joins Open Knowledge Foundation and you can get involved!"/><? } ?> 
		<? if(SITE_KEYWORDS != "") { ?><meta http-equiv="keywords" name="keywords" content="<?=SITE_KEYWORDS?>"/><? } ?>
		
		<meta http-equiv="revisit-after" name="Revisit-after" content="2 days" />
		<meta http-equiv="robots" name="Robots" content="all" />
		<meta name="robots" content="INDEX|FOLLOW" />
		
		<base href="<?=SITE_BASE?>" />
				
		<link type="image/gif" rel="icon" href="images/favicon.ico"  />
		<link rel="stylesheet" type="text/css" href="ressources/menu_assets/Style.css" />
		
		<style type="text/css" translate="none"> 
		
			@import url('http://product.okfn.org/wp-content/themes/wordpress-theme-okfn/fonts/stylesheet.css');
		
			body {
				font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				font-size: 12px;

				margin-bottom: 0px;
				margin-left: 0px;
				margin-right: 0px;
				margin-top: 0px;

				padding-top: 0px;				
				

				display: block;
				
				font-size: 14px;		
				
			}
			
			.p3 {
				margin-right: auto;
				margin-left: auto;	
				width: 970px;
			}


			.titre-barre-gauche {
				color:#cc2d32;	
				
				font-weight:bold;
				font-size:18px;
				padding-left:40px; 
				background-image: url(images/bc_01_ar.png);
				background-repeat: no-repeat;
				background-position: 0px 0px;					
			}
			
			.sous-titre-barre-gauche {

				color:#e18137;
										
				padding-left:40px; 
				background-image: url(images/bc_02.png);
				background-repeat: no-repeat;
				background-position: 0px 0px;	
					
			}
			
			#content {
				width:1000px;
				
				
			}
			
			a { text-decoration: none;color:#000000;}	
			
			a:visited {text-decoration: none;color:#000000;}
			
			a:active {text-decoration: none;color:#000000;}
			
			img{ 
				border:0px;
			}

			#news2 {
				margin-top: 10px;
				border: #f0eeee solid 5px;
			}
			
			#news {
				border: #F7F7F7 solid 5px;  
				background-color: #F7F7F7;
			}
			
			#news li { 
				background-image:none;
			}
			
			#search-gtin {
				margin-top:10px;
			}

			.search-bouton {
			
				padding:3px 0 3px 0;
				font:Bold 13px Arial;
				background:#d34836;
				color:#fff;
				width:20px;
				border-radius:2px;
				border:none;	
			}

			.search-texte {
				margin-left:10px;
				padding:3px 0 3px 0;
				width:120px;
				border:#d34836 solid 1px;	
			}
			

			ul { list-style-image: none; }
			
			#count-gtin {list-style-type:none;padding:0px;margin:10px 0px 2px 0px; height:30px}
			#count-gtin .d0 {float:left;background:url(images/filmstrip.png) 0 0 no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .d1 {float:left;background:url(images/filmstrip.png) 0 -180px no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .d2 {float:left;background:url(images/filmstrip.png) 0 -360px no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .d3 {float:left;background:url(images/filmstrip.png) 0 -540px no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .d4 {float:left;background:url(images/filmstrip.png) 0 -720px no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .d5 {float:left;background:url(images/filmstrip.png) 0 -900px no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .d6 {float:left;background:url(images/filmstrip.png) 0 -1080px no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .d7 {float:left;background:url(images/filmstrip.png) 0 -1260px no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .d8 {float:left;background:url(images/filmstrip.png) 0 -1440px no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .d9 {float:left;background:url(images/filmstrip.png) 0 -1620px no-repeat;width:16px;height:30px;margin:0px 1px 0px 0px;}
			#count-gtin .seperator {float:left;background:url(images/comma.png) 0px 20px no-repeat;width:4px;height:30px}
			
			#search-gtin-top {
				padding-left:0px;
				float:right;
			}
			
			#result-gtin {
			}
			
			#result-gtin td {
				padding:10px;
				vertical-align:top;
			}
			
			#navigate-gpc td {
				padding:10px;
				vertical-align:top;
			}
			
			#gpc-list {
				
			}
			
			.reseaux-sociaux {
				padding: 5px, 5px;
				margin:5px;
			}
			
			#tab-transparent td {
				background-color:#FFFFFF;
			}

			#tab-listing th {
				color:#FFFFFF;
				background-color:#CCCCCC;
				font-size: 11px;
				padding:3px 5px 3px 5px;
			}
			
			#corps .entete-tableau{


			}
			
			#tab-listing td {
				padding:3px 5px 3px 5px;
			}
			
			
			
			#tab-listing a { text-decoration: none;color:#000000;}	
			
			#tab-listing a:visited {text-decoration: none;color:#000000;}
			
			#tab-listing a:active {text-decoration: none;color:#000000;}

			#volet_droit {
				width:100px;
				padding-left:30px; 
				padding-right:30px; 
				vertical-align:top;
			}

			#bloc-forum {
				font-weight:bold;
				text-align:center;
			}
			
			#bloc-lang {

			}
			
			#bloc-lang img {
				padding-right:5px;
			}	
			
			#bloc-lang div {
				padding-bottom:3px;
				font-size: 13px;
			}	
			
			#haut-corps {
				border-bottom:#CCCCCC 1px solid;
				padding-bottom:2px;
				height:30px;
			}
			
			#haut-corps div {			
				display:inline-block;
				vertical-align:middle;
				padding-right:10px;
			}
							
			#corps {
				width:600px;
				padding-left:30px; 
				vertical-align:top;
				font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				font-size:12px;

			}
			
			#corps a { text-decoration: none;color:#cc2d32;}	
			
			#corps a:visited {text-decoration: none;color:#cc2d32;}
			
			#corps a:active {text-decoration: none;color:#cc2d32;}

			#corps ol, ul, li {
				font-size: 12px;
			}

<? if(SITE_LANGUAGE == 'ar') { ?>


			
			#corps ul {
				list-style-type:disc;
				padding: 0px;
				margin: 0px;
			}
			
			#corps li {
			
				padding-right:30px;
				margin-right: 10px;		
				
				padding-top:0px; 
				padding-left: 30px; 
				padding-bottom:5px;
				
				background-image: url(images/puce_03.png);
				background-repeat: no-repeat;
				background-position: right top, 0px 0px;			
			}	
			
			#corps li li {
			
				padding-right:18px; 
				margin-right: 2px;	
				padding-top:0px; 
				
				background-image: url(images/puce_03.png);
				background-repeat: no-repeat;
				background-position: right top, 0px 0px;			
			}			

			#corps h1 {

				color:#cc2d32;	
			
				padding-right:38px; 
				margin-right: 2px;	
				
				background-image: url(images/bc_01_ar.png);
				background-repeat: no-repeat;
				background-position: right center, 0px 0px;			
			}
			
			#corps h2 {
	
				color:#e18137;
										
				padding-right:40px; 
				margin-right: 30px;	
				
				background-image: url(images/bc_02_ar.png);
				background-repeat: no-repeat;
				background-position: right center, 0px 0px;	
			}
			
			#corps h3 {
			
				/*color:#b3ce3f;*/	
				color:#879b30;
				
				padding-right:40px; 
				margin-right: 60px;	
				
				background-image: url(images/bc_03_ar.png);
				background-repeat: no-repeat;
				background-position: right center,  0px 0px;	
			}
			





<? } else { ?>


			#corps ul {
				list-style-type:disc;
				padding: 0px;
				margin: 0px;
			}
			
			#corps li {
			
				padding-right:40px;
				padding-top:0px; 
				padding-left: 30px; 
				padding-bottom:5px;

				background-image: url(images/puce_03.png);
				background-repeat: no-repeat;
				background-position: 10px 0px;			
			}	
			
			#corps li li {
			
				padding-left:20px; 
				padding-top:0px; 
				background-image: url(images/puce_03.png);
				background-repeat: no-repeat;
				background-position: 2px 0px;			
			}			

			#corps h1 {

				color:#cc2d32;	
			
				padding-left:40px; 
				background-image: url(images/bc_01.png);
				background-repeat: no-repeat;
				background-position: 2px 0px;			
			}
			
			#corps h2 {
	
				color:#e18137;
										
				padding-left:70px; 
				background-image: url(images/bc_02.png);
				background-repeat: no-repeat;
				background-position: 30px 0px;	
			}
			
			#corps h3 {
			
				/*color:#b3ce3f;*/	
				color:#879b30;
				
				padding-left:100px; 
				background-image: url(images/bc_03.png);
				background-repeat: no-repeat;
				background-position: 60px 0px;	
			}
			


			#navigate-gpc h2 {
			
				/*color:#b3ce3f;*/	
				color:#879b30;
				
				padding-left:40px; 
				background-image: url(images/bc_03.png);
				background-repeat: no-repeat;
				background-position: 0px 0px;	
			}


			#result-gtin h4 {
			
				/*color:#b3ce3f;*/	
				color:#879b30;

				padding-left:40px; 
				background-image: url(images/bc_03.png);
				background-repeat: no-repeat;
				background-position: 0px 0px;	
			}
			
			#result-gtin h4 b {
			
				/*color:#b3ce3f;*/	
				color:#000000;
				
			}


	
<? } ?> 
	

		
			#corps td {

				background-color:#F7F7F7;
			}


			#footer {

				margin-top:15px;

				padding-bottom:2px;
				padding-top:5px;
				
				text-align:center;
				vertical-align:middle;
				
				border-top:#CCCCCC 1px solid;

			}

	
			
			/* Starter CSS for Flyout Menu */
			#cssmenu {
			  padding: 0;
			  margin: 0;
			  border: 0; }
			
			#cssmenu ul, li {
			  list-style: none;
			  margin: 0;
			  padding: 0; }
			
			#cssmenu ul {
			  position: relative;
			  z-index: 597;
			  float: left; }
			
			#cssmenu ul li {
			  float: left;
			  min-height: 1px;
			  line-height: 1em;
			  vertical-align: middle; }
			
			#cssmenu ul li.hover,
			#cssmenu ul li:hover {
			  position: relative;
			  z-index: 599;
			  cursor: default; }
			
			#cssmenu ul ul {
			  visibility: hidden;
			  position: absolute;
			  top: 100%;
			  left: 0;
			  z-index: 598;
			  width: 100%; }
			
			#cssmenu ul ul li {
			  float: none; }
			
			#cssmenu ul li:hover > ul {
			  visibility: visible; }
			
			#cssmenu ul ul {
			  top: 0;
			  left: 100%; }
			
			#cssmenu ul li {
			  float: none; }
			
			/* Custom Stuff */
			#cssmenu {
			  -moz-border-radius: 5px;
			  -webkit-border-radius: 5px;
			  border-radius: 5px;
			  -moz-background-clip: padding;
			  -webkit-background-clip: padding-box;
			  background-clip: padding-box;
			  -moz-box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.15);
			  -webkit-box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.15);
			  box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.15);
			  width: 200px; }
			  #cssmenu span, #cssmenu a {
				display: inline-block;
				font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				font-size: 12px;
				text-decoration: none; }
			  #cssmenu:after, #cssmenu ul:after {
				content: '';
				display: block;
				clear: both; }
			  #cssmenu > ul > li:first-child {
				-moz-border-radius: 5px 5px 0 0;
				-webkit-border-radius: 5px 5px 0 0;
				border-radius: 5px 5px 0 0;
				-moz-background-clip: padding;
				-webkit-background-clip: padding-box;
				background-clip: padding-box; }
			  #cssmenu > ul > li:last-child {
				-moz-border-radius: 0 0 5px 5px;
				-webkit-border-radius: 0 0 5px 5px;
				border-radius: 0 0 5px 5px;
				-moz-background-clip: padding;
				-webkit-background-clip: padding-box;
				background-clip: padding-box; }
			  #cssmenu > ul > li ul ul {
				-moz-border-radius: 0 6px 6px 0;
				-webkit-border-radius: 0 6px 6px 0;
				border-radius: 0 6px 6px 0;
				-moz-background-clip: padding;
				-webkit-background-clip: padding-box;
				background-clip: padding-box; }
			  #cssmenu > ul > li ul ul li:first-child {
				-moz-border-radius: 0 5px 0 0;
				-webkit-border-radius: 0 5px 0 0;
				border-radius: 0 5px 0 0;
				-moz-background-clip: padding;
				-webkit-background-clip: padding-box;
				background-clip: padding-box; }
			  #cssmenu > ul > li ul ul li:last-child {
				-moz-border-radius: 0 0 5px 0;
				-webkit-border-radius: 0 0 5px 0;
				border-radius: 0 0 5px 0;
				-moz-background-clip: padding;
				-webkit-background-clip: padding-box;
				background-clip: padding-box; }
			  #cssmenu ul, #cssmenu li {
				width: 100%; }
			  #cssmenu li {
				background: #dddddd url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAJCAMAAAA8eE0hAAAAUVBMVEX////MzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzNzc3l5eXg4ODZ2dnMzMzi4uLS0tLe3t7Q0NDV1dXj4+PW1tbk5OTc3NzPz8/R0dH0Zv5RAAAAC3RSTlMAM2YekAmlPHuEAwArv7wAAAA/SURBVHheY2Dl5mdigABGKV5BNnYok4dHQpKFGcrkEefj5gAzQUBABM7kFYQyRcX4mUBMkEpOLrA2IWGwfgYAn0UDZszv8IwAAAAASUVORK5CYII=) repeat-x;
				background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #e5e5e5), color-stop(1, #dddddd));
				background-image: -webkit-linear-gradient(top, #e5e5e5, #dddddd);
				background-image: -moz-linear-gradient(top, #e5e5e5, #dddddd);
				background-image: -ms-linear-gradient(top, #e5e5e5, #dddddd);
				background-image: -o-linear-gradient(top, #e5e5e5, #dddddd);
				background-image: linear-gradient(#e5e5e5, #dddddd); }
				#cssmenu li:hover {
				  background: #f6f6f6; }
			  #cssmenu a {
				color: #666666;
				line-height: 160%;
				padding: 11px 28px 11px 28px;
				width: 144px; }
			  #cssmenu ul ul {
				border: 1px solid #dddddd;
				-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
				-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
				box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15); }
				#cssmenu ul ul li {
				  background: #f6f6f6; }
				  #cssmenu ul ul li:hover {
					background: #dddddd; }
					#cssmenu ul ul li:hover a {
					  color: #AE0001; }
				  #cssmenu ul ul li ul li {
					background: #dddddd; }
					#cssmenu ul ul li ul li:hover {
					  background: #b7b7b7; }
			  #cssmenu .has-sub {
				position: relative; }
				#cssmenu .has-sub:after, #cssmenu .has-sub > ul > .has-sub:hover:after {
				  content: '';
				  display: block;
				  width: 10px;
				  height: 9px;
				  position: absolute;
				  right: 5px;
				  top: 50%;
				  margin-top: -5px;
				  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAJCAMAAAA8eE0hAAAAUVBMVEX////MzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzNzc3l5eXg4ODZ2dnMzMzi4uLS0tLe3t7Q0NDV1dXj4+PW1tbk5OTc3NzPz8/R0dH0Zv5RAAAAC3RSTlMAM2YekAmlPHuEAwArv7wAAAA/SURBVHheY2Dl5mdigABGKV5BNnYok4dHQpKFGcrkEefj5gAzQUBABM7kFYQyRcX4mUBMkEpOLrA2IWGwfgYAn0UDZszv8IwAAAAASUVORK5CYII=);
				  -moz-transform: rotate(360deg);
				  -o-transform: rotate(360deg);
				  -ms-transform: rotate(360deg);
				  -webkit-transform: rotate(360deg);
				  transform: rotate(360deg); }
				#cssmenu .has-sub > ul > .has-sub:after, #cssmenu .has-sub:hover:after {
				  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAJCAMAAAA8eE0hAAAAUVBMVEX////d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3e3t729vbx8fHq6urd3d3z8/Pj4+Pv7+/h4eHm5ub09PTn5+f19fXt7e3g4ODi4uLUsVdlAAAAC3RSTlMAM2YekAmlPHuEAwArv7wAAAA/SURBVHheY2Dl5mdigABGKV5BNnYok4dHQpKFGcrkEefj5gAzQUBABM7kFYQyRcX4mUBMkEpOLrA2IWGwfgYAn0UDZszv8IwAAAAASUVORK5CYII=); }



		</style>

	</head>


		<style type="text/css">
				
	
				

				
				.p2 {
					color: rgb(255, 255, 255);
					display: block;
					font-family: OpenSans, "Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size: 14px;
					height: 65px;
					line-height: 20px;
					margin-bottom: 15px;
					margin-top: 0px;
					
				}

				.navbar {
					color: rgb(119, 119, 119);
					display: block;
					font-family: OpenSans, "Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size: 14px;
					height: 65px;
					line-height: 20px;
					margin-bottom: 0px;
					overflow-x: visible;
					overflow-y: visible;
					
				}
				
				.navbar-inner {
					-webkit-background-clip: border-box;
					-webkit-background-origin: padding-box;
					-webkit-background-size: auto;
					-webkit-box-shadow: rgba(0, 0, 0, 0) 0px 1px 2px 0px, rgba(0, 0, 0, 0) 0px -1px 0px 0px inset;
					background-attachment: scroll;
					background-clip: border-box;
					background-color: rgba(0, 0, 0, 0);
					background-image: -webkit-linear-gradient(top, rgb(255, 255, 255) 0px, rgb(243, 243, 243) 50%, rgb(237, 237, 237) 51%, rgb(255, 255, 255) 100%);
					background-origin: padding-box;
					background-repeat: repeat;
					background-size: auto;
					border-bottom-color: rgb(229, 229, 229);
					border-bottom-left-radius: 0px;
					border-bottom-right-radius: 0px;
					border-bottom-style: solid;
					border-bottom-width: 1px;
					border-image-outset: 0px;
					border-image-repeat: stretch;
					border-image-slice: 100%;
					border-image-source: none;
					border-image-width: 1;
					border-left-color: rgb(51, 51, 51);
					border-left-style: none;
					border-left-width: 0px;
					border-right-color: rgb(51, 51, 51);
					border-right-style: none;
					border-right-width: 0px;
					border-top-color: rgb(51, 51, 51);
					border-top-left-radius: 0px;
					border-top-right-radius: 0px;
					border-top-style: none;
					border-top-width: 0px;
					box-shadow: rgba(0, 0, 0, 0) 0px 1px 2px 0px, rgba(0, 0, 0, 0) 0px -1px 0px 0px inset;
					color: rgb(51, 51, 51);
					display: block;
					font-family: OpenSans, "Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size: 14px;
					height: 66px;
					line-height: 20px;
					min-height: 40px;
					padding-left: 0px;
					padding-right: 0px;
					
				}
				
				.container {
					color: rgb(51, 51, 51);
					display: block;
					font-family: OpenSans, "Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size: 14px;
					height: 66px;
					line-height: 20px;
					/*
					margin-left: 481.5px;
					margin-right: 481.5px;
					*/
					margin: 0 auto;
					max-width: 940px;
					width: 940px;
				}
				
				.navbar .brand {
					color: rgb(51, 51, 51);
					cursor: auto;
					display: block;
					float: left;
					font-family: OpenSans, "Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size: 20px;
					font-weight: 200;
					height: 65px;
					line-height: 65px;
					margin-bottom: 0px;
					margin-left: 0px;
					margin-right: 0px;
					margin-top: 0px;
					padding-bottom: 0px;
					padding-left: 0px;
					padding-right: 10px;
					padding-top: 0px;
					text-decoration: none;
					text-shadow: rgb(255, 255, 255) 0px 1px 0px;
					
					
				}
				.navbar a {
					font-family: OpenSans, "Helvetica Neue", Helvetica, Arial, sans-serif;
				}
				.navbar .brand img {
					border-bottom-color: rgb(51, 51, 51);
					border-bottom-style: none;
					border-bottom-width: 0px;
					border-image-outset: 0px;
					border-image-repeat: stretch;
					border-image-slice: 100%;
					border-image-source: none;
					border-image-width: 1;
					border-left-color: rgb(51, 51, 51);
					border-left-style: none;
					border-left-width: 0px;
					border-right-color: rgb(51, 51, 51);
					border-right-style: none;
					border-right-width: 0px;
					border-top-color: rgb(51, 51, 51);
					border-top-style: none;
					border-top-width: 0px;
					color: rgb(51, 51, 51);
					cursor: auto;
					display: block;
					float: left;
					font-family: OpenSans, "Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size: 20px;
					font-weight: 200;
					height: 35px;
					line-height: 65px;
					margin-right: 12px;
					margin-top: 15px;
					max-width: 100%;
					text-shadow: rgb(255, 255, 255) 0px 1px 0px;
					vertical-align: middle;
					
				}
				
				.nav-collapse.collapse {
-webkit-transition-delay: 0s;
-webkit-transition-duration: 0.35s;
-webkit-transition-property: height;
-webkit-transition-timing-function: ease;
color: rgb(51, 51, 51);
display: block;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 0px;
line-height: 20px;
overflow-x: visible;
overflow-y: visible;
position: relative;
transition-delay: 0s;
transition-duration: 0.35s;
transition-property: height;
transition-timing-function: ease;
	
				}
				
				.nav {
color: rgb(51, 51, 51);
display: block;
float: right;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 66px;
left: 0px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
margin-bottom: 0px;
margin-left: 0px;
margin-right: 0px;
margin-top: 0px;
padding-bottom: 0px;
padding-left: 0px;
padding-right: 0px;
padding-top: 0px;
position: relative;
width: 477px;
z-index: 999;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
					
				}
				
				#menu-item-1 {

color: rgb(51, 51, 51);
display: list-item;
float: left;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 66px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
text-align: left;
z-index: auto;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}
				
				#menu-item-1 a {

color: rgb(93, 93, 93);
cursor: auto;
display: block;
float: none;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 20px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
padding-bottom: 22px;
padding-left: 9px;
padding-right: 9px;
padding-top: 24px;
text-align: left;
text-decoration: none solid rgb(93, 93, 93);
text-shadow: none;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;

				}
				
				
				#menu-item-2 {
-webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px 0px inset;
background-color: rgb(237, 237, 237);
box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px 0px inset;
color: rgb(51, 51, 51);
display: list-item;
float: left;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 66px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
text-align: left;
z-index: auto;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}

				#menu-item-2  a {				
-webkit-box-shadow: rgba(0, 0, 0, 0.121569) 0px 3px 8px 0px inset;
background-color: rgb(229, 229, 229);
box-shadow: rgba(0, 0, 0, 0.121569) 0px 3px 8px 0px inset;
color: rgb(93, 93, 93);
cursor: auto;
display: block;
float: none;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 20px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
padding-bottom: 22px;
padding-left: 9px;
padding-right: 9px;
padding-top: 24px;
text-align: left;
text-decoration: none solid rgb(93, 93, 93);
text-shadow: none;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}
				
				#menu-item-3 {
color: rgb(51, 51, 51);
display: list-item;
float: left;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 66px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
position: relative;
text-align: left;
z-index: 1000;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}
				
				#menu-item-3 a {
color: rgb(93, 93, 93);
cursor: auto;
display: block;
float: none;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 20px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
padding-bottom: 22px;
padding-left: 9px;
padding-right: 9px;
padding-top: 24px;
text-align: left;
text-decoration: none solid rgb(93, 93, 93);
text-shadow: none;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;

				}

				#menu-item-4 {
color: rgb(51, 51, 51);
display: list-item;
float: left;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 66px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
position: relative;
text-align: left;
z-index: 1000;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;

				}
				
				#menu-item-4 a {
color: rgb(93, 93, 93);
cursor: auto;
display: block;
float: none;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 20px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
padding-bottom: 22px;
padding-left: 9px;
padding-right: 9px;
padding-top: 24px;
text-align: left;
text-decoration: none solid rgb(93, 93, 93);
text-shadow: none;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}
				

				
				
				#menu-item-5 {
color: rgb(51, 51, 51);
display: list-item;
float: left;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 66px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
text-align: left;
z-index: auto;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}

				#menu-item-5  a {				

color: rgb(93, 93, 93);
cursor: auto;
display: block;
float: none;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 20px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
padding-bottom: 22px;
padding-left: 9px;
padding-right: 9px;
padding-top: 24px;
text-align: left;
text-decoration: none solid rgb(93, 93, 93);
text-shadow: none;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}
				
				#menu-item-6 {
color: rgb(51, 51, 51);
display: list-item;
float: left;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 66px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
position: relative;
text-align: left;
z-index: 1000;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}

				#menu-item-6  a {				
color: rgb(85, 85, 85);
cursor: auto;
display: block;
float: none;
font-family: OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 20px;
line-height: 20px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
padding-bottom: 22px;
padding-left: 9px;
padding-right: 9px;
padding-top: 24px;
text-align: left;
text-decoration: none solid rgb(85, 85, 85);
text-shadow: none;
font-family:OpenSans, 'Helvetica Neue', Helvetica, Arial, sans-serif;

				}
			
				.okfn-ribbon {
				position: relative;
				float: right;
				width: 48px;
				height: 40px;
				margin-left: 5px;
				}
			
				.okfn-ribbon a {
					background-image: url(http://assets.okfn.org/web/images/okf-ribbon.png);
					background-repeat: no-repeat;
					background-position: center -27px;
					width: 48px;
					height: 73px;
					display: block;
					cursor: pointer;
					text-indent: -999px;
					overflow: hidden;
					position: absolute;
					z-index: 1;
				}
				
				
				.p2 .search-form {
				color: rgb(255, 255, 255);
				display: none;
				font-family: OpenSans, "Helvetica Neue", Helvetica, Arial, sans-serif;
				font-size: 14px;
				height: auto;
				line-height: 20px;
				margin-bottom: 20px;
				margin-left: 0px;
				margin-right: 0px;
				margin-top: 0px;
				width: auto;
				
				}
				
				.p4 {
				
					-webkit-background-clip: border-box;
					-webkit-background-origin: padding-box;
					-webkit-background-size: auto;
					background-attachment: scroll;
					background-clip: border-box;
					background-color: rgb(239, 239, 239);
					background-image: none;
					background-origin: padding-box;
					background-size: auto;
					border-top-color: rgb(229, 229, 229);
					border-top-style: solid;
					border-top-width: 1px;
					color: rgb(64, 64, 64);
					display: block;
					font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
					font-size: 14px;
					height: 91px;
					line-height: 20px;
					margin-top: 10px;
					padding-bottom: 0px;
					padding-left: 0px;
					padding-right: 0px;
					padding-top: 0px;
					text-shadow: none;

					
				}
				
				.p4 .inner {
					
					-webkit-background-clip: border-box;
					-webkit-background-origin: padding-box;
					-webkit-background-size: auto;
					background-attachment: scroll;
					background-clip: border-box;
					background-color: rgba(0, 0, 0, 0);
					background-image: none;
					background-origin: padding-box;
					background-size: auto;
					color: rgb(192, 192, 192);
					display: block;
					font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
					font-size: 11px;
					height: 0px;
					line-height: 20px;
					min-height: 0px;
					padding-bottom: 30px;
					padding-left: 0px;
					padding-right: 0px;
					padding-top: 10px;
					text-shadow: none;

				}
				
				.okf-footer {
				
					border-top-color: rgba(127, 127, 127, 0.298039);
					border-top-style: dotted;
					border-top-width: 1px;
					color: rgb(64, 64, 64);
					display: block;
					font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
					font-size: 12px;
					height: 20px;
					line-height: 20px;
					padding-bottom: 15px;
					padding-left: 0px;
					padding-right: 0px;
					padding-top: 15px;
					text-shadow: none;

					
				}
				
				.okf-footer .container {
				
					color: rgb(64, 64, 64);
					display: block;
					font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
					font-size: 12px;
					height: 20px;
					line-height: 20px;
					margin-left: 481.5px;
					margin-right: 481.5px;
					padding-bottom: 0px;
					padding-left: 0px;
					padding-right: 0px;
					padding-top: 0px;
					text-shadow: none;
					width: 940px;
					
				}
				
				.okf-footer .container ul {
					color: rgb(64, 64, 64);
					display: block;
					font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
					font-size: 12px;
					height: 20px;
					line-height: 20px;
					list-style-type: disc;
					margin-bottom: 0px;
					margin-left: 0px;
					margin-right: 0px;
					margin-top: 0px;
					padding-bottom: 0px;
					padding-left: 0px;
					padding-right: 0px;
					padding-top: 0px;
					text-shadow: none;
					width: 940px;
				}
				
				.okf-footer .container ul li {
					border-right-color: rgba(127, 127, 127, 0.298039);
					border-right-style: solid;
					border-right-width: 1px;
					color: rgb(64, 64, 64);
					display: inline-block;
					font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
					font-size: 12px;
					height: 14px;
					line-height: 14px;
					list-style-type: disc;
					margin-bottom: 0px;
					margin-left: 0px;
					margin-right: 5px;
					margin-top: 0px;
					padding-bottom: 0px;
					padding-left: 0px;
					padding-right: 7px;
					padding-top: 0px;
					text-align: left;
					text-shadow: none;
					width: 73px;
				}
				
				.okf-footer .container ul li a {
					color: rgb(64, 64, 64);
					cursor: auto;
					display: inline;
					font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
					font-size: 12px;
					height: auto;
					line-height: 14px;
					list-style-type: disc;
					opacity: 1;
					outline-color: rgb(64, 64, 64);
					outline-style: none;
					outline-width: 0px;
					text-align: left;
					text-decoration: none;
					text-shadow: none;
					width: auto;

				}
				
				.okf-footer .container ul li:last-child {
				padding: 0;
				margin: 0;
				border: none;
				}
				
        </style>
    

	<body>








				
                    	<div class="p2">
                          <div class="navbar">
                            <div class="navbar-inner">
                              <div class="container">
                                        
                                          <div class="okfn-ribbon"><a href="http://okfn.org/" data-toggle="collapse" data-target="#okf-panel" title="Part of the Open Knowledge Foundation Network">An Open Knowledge Foundation Site</a></div>                    
                                                  <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar collapsed">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </a>
                              <a title="Home" 
                                  class="brand" 
                                  href="http://product.okfn.org">
                                  
                                              
                                              <img src="http://product.okfn.org/files/2013/11/cropped-openproduct_301.png" alt="logo">
                                
                                              Open Product Data                      </a>
                              
                                        
                                  <nav class="nav-collapse collapse">
                                  		<ul id="nav" class="nav">
                                        	<li id="menu-item-1" ><a href="http://product.okfn.org/">Home</a></li> 	
                                            <li id="menu-item-2" ><a title="POD Product Open Data" href="http://www.product-open-data.com">Browse Data</a></li> 
                                            <li id="menu-item-3" ><a href="http://product.okfn.org/advisory-board/">Community</a></li>
                                        	<li id="menu-item-4" ><a href="http://product.okfn.org/bsin/">Projects</a></li> 
                                            <li id="menu-item-5" ><a href="http://product.okfn.org/blog/">Blog</a></li> 
                                            <li id="menu-item-6" ><a href="http://product.okfn.org/barcode-gs1/">Resources</a></li>
                                        </ul>      
                                  </nav>
                                <!-- Disabled until I've got separate images and confirmed link addresses -->
                              </div>
                            </div>
                            
                          </div>
                    
                          <form action="http://okfn.org/search/" method="post" class="search-form" role="search">
                            <label for="search-terms" class="accessibly-hidden">Search for:</label>
                            <input type="text" id="search-terms" name="search-terms" value="" />
                    
                            <label for="search-which" class="accessibly-hidden">Search these:</label><select name="search-which" id="search-which" style="width: auto"><option value="members">Members</option><option value="groups">Groups</option><option value="blogs">Blogs</option><option value="posts">Posts</option></select>
                            <input type="submit" name="search-submit" id="search-submit" value="Search" />
                            <input type="hidden" id="_wpnonce" name="_wpnonce" value="de19eb5ca3" /><input type="hidden" name="_wp_http_referer" value="/" />      </form><!-- #search-form -->
                                      
                          <div class="sub-header">
                            <div class="container">
                              <div class="row">
                                <div class="span8">
                                              </div>
                                <div class="span4">
                                              </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
               
                   
                   
                    	<div class="p3">


	
	
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	


        




		
		<div id="content">
			<table border="0">
				<tr>
					<td width="200px" style="vertical-align:top;padding-left:0px;">
				
					<a href='<?=LINK_HOME?><?=EXTENSION?>'>	<img src="images/pod_logo_200px.png" name="<?=$VALUE_SiteName?>" border="0" style="padding-bottom:10px;"/> </a>


							
						<!------------------------- MENU ----------------------------------------------------->		
								
						<div id='cssmenu'>
							<ul>
							   
							  <!--
                               <li class='has-sub '><a href='<?=LINK_BASE?>#'><span><?=MENU_GS1?></span></a>
									<ul>
									   <li><a href='<?=LINK_GS1_PRESENTATION?><?=EXTENSION?>'>		<span><?=MENU_GS1_PRESENTATION?>			</span></a></li>
									   <li><a href='<?=LINK_GS1_CODIFICATION?><?=EXTENSION?>'>		<span><?=MENU_GS1_CODIFICATION?>			</span></a></li>
									   <li><a href='<?=LINK_GS1_GPC?><?=EXTENSION?>'>					<span><?=MENU_GS1_GPC?>						</span></a></li>
									</ul>
							   </li>
                               -->
                              
							    <!--
                               <li class='has-sub '><a href='<?=LINK_BASE?>#'><span><?=MENU_WEB?></span></a>
									<ul>
									   <li><a href='<?=LINK_WEB_ECOMMERCE?><?=EXTENSION?>'>			<span><?=MENU_WEB_ECOMMERCE?>				</span></a></li>
									   <li><a href='<?=LINK_WEB_PRICING?><?=EXTENSION?>'>				<span><?=MENU_WEB_PRICING?>					</span></a></li>
									   <li><a href='<?=LINK_WEB_MANUFACTURER?><?=EXTENSION?>'>		<span><?=MENU_WEB_MANUFACTURER?>			</span></a></li>
									   
									</ul>
							   </li>
                                --> 
                              
                                <!--
							   <li class='has-sub '><a href='<?=LINK_BASE?>#'><span><?=MENU_RESSOURCES?></span></a>
									<ul>
									   <li><a href='<?=LINK_POD_REPOSITORY?><?=EXTENSION?>'>			<span><?=MENU_POD_REPOSITORY?>			</span></a></li>
									   <li><a href='<?=LINK_POD_MANAGER?><?=EXTENSION?>'>				<span><?=MENU_POD_MANAGER?>				</span></a></li>
									   <li><a href='<?=LINK_POD_GALLERY?><?=EXTENSION?>'>				<span><?=MENU_POD_GALLERY?>				</span></a></li>
									   <li><a href='<?=LINK_POD_RSS?><?=EXTENSION?>'>					<span><?=MENU_POD_RSS?>					</span></a></li>
									</ul>
							   </li>
                                -->
							   
                               <!-- <li><a href='supporters/'>		<span>Supporters		</span></a></li>-->
                               
                               
                               
                               <li><a href='<?=LINK_HOME?><?=EXTENSION?>'><span><?=MENU_HOME?>		</span></a></li>
                               <!--<li><a href='smartphone/'>				<span><?=MENU_WEB_APPS?>	</span></a></li>-->
							   <li><a href='navigate/'>		<span>Browse Data		</span></a></li>
                               <li><a href='data-quality/'>		<span>Data Quality		</span></a></li>
                               <li><a href='download/'>		<span>Download Data		</span></a></li>
                               <!--<li><a href='tweets/'>		<span>Tweets		</span></a></li>
                               <li><a href='<?=LINK_ABOUT_CONTACT?><?=EXTENSION?>'>			<span><?=MENU_ABOUT_CONTACT?>			</span></a></li>-->
	
							</ul>
						</div>
						<!------------------------- MENU ----------------------------------------------------->		
						
						<!------------------------- SEARCH --------------------------------------------------->	
						
                        <div id="bloc-forum" style="margin-top:10px;">
							<a href="https://twitter.com/openproductdata" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @openproductdata</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </div>
                          
                   
                        <div>
                            <ul id="count-gtin">
                                <li class="d<?=$VALUE_CountGTIN[0]?>"></li>
                                <li class="d<?=$VALUE_CountGTIN[1]?>"></li>
                                <li class="seperator"></li>
                                <li class="d<?=$VALUE_CountGTIN[2]?>"></li>
                                <li class="d<?=$VALUE_CountGTIN[3]?>"></li>
                                <li class="d<?=$VALUE_CountGTIN[4]?>"></li>
                                <li class="seperator"></li>
                                <li class="d<?=$VALUE_CountGTIN[5]?>"></li>
                                <li class="d<?=$VALUE_CountGTIN[6]?>"></li>
                                <li class="d<?=$VALUE_CountGTIN[7]?>"></li>
                                <li class="seperator"></li>
                                <li class="d<?=$VALUE_CountGTIN[8]?>"></li>
                                <li class="d<?=$VALUE_CountGTIN[9]?>"></li>
                                <li class="d<?=$VALUE_CountGTIN[10]?>"></li>
                            </ul>
                        </div>
                        
                        GTIN codes available
                        <br/>
						<!--
						<br/>
						<img src="images/ecologie.jpg" />
						<div style="width:100%; text-align:center;" ><b><?=SITE_ECO_SLOGAN?></b></div>
						-->
						
                        

              			
                        
						
						
                        
						<a href="https://play.google.com/store/apps/details?id=org.okfn.pod" target="_blank" rel="nofollow">
      					<img  src="images/Google-Play-200.png" style="margin-top:10px;" alt=""/>
                        </a>
                        
<br/>
<img  src="images/ecologie.jpg" style="margin-top:10px;" alt=""/>

						
						
					</td>
					<td id="corps" >
					
	
						<!------------------------- HEADER ----------------------------------------------------->	
	
	
	
						<!--<div id="haut-corps">-->
						<div >	
                      

								
						<!--						
						<div id="search-gtin-top" >
							
							<form name="formulaire" enctype="multipart/form-data" method="post" action="search/" >	
							<img align="center" src="images/search.png" />	<b>Search a GTIN-13 Code</b>
								<input name="gtin" class="search-texte" type="text" value="" size="13" />  
								<input type="button" class="search-bouton"  onclick="submit()" value=">" /> 	
							</form>
						</div>
                        -->

                            <div id="search-gtin" style="font-size:28px;">
                                <form name="formulaire" enctype="multipart/form-data" method="post" action="search/" >	
                                    <b>Search a GTIN-13 Code</b>
                                    <input name="gtin" class="search-texte" type="text" value="" size="13" style="font-size:20px;width:230px;"/>  
                                    <input type="button" class="search-bouton" onclick="submit()" value=">" style="font-size:20px;width:30px;"/> 	
                                </form>
                            </div>
                            <hr/>
							
								<!--
							<div>			
								<a href="https://groups.google.com/forum/#!forum/product-open-data" target="_blank">
									<img src="images/pod-forum-03.png" />
								</a>
							</div>	
							<div>
								<a href="https://groups.google.com/forum/#!forum/product-open-data" target="_blank">
									<?=SITE_GO_FORUM?>
								</a>
							</div>
							-->
						</div>
						<!------------------------- HEADER ----------------------------------------------------->	
						
						<!------------------------- CORPS ----------------------------------------------------->	
						<div <?=SITE_DIRECTION?> >
						<!--COUPER_ICI-->
						</div>
						<!------------------------- CORPS ----------------------------------------------------->
				
					</td>
					<td id="volet_droit">	
                    
                    <a href="http://www.okfn.org" target="_blank" rel="nofollow" >
           <img src="images/logos/logo-okfn-text.jpg" style="margin-bottom:10px;" />
         </a>
                    
                        <!-- Open Data Link -->
                        <a href="http://opendefinition.org/" target="_blank" rel="nofollow"><img alt="This material is Open Data" border="0" src="images/od_80x15_blue.png" /></a>
                        <!-- /Open Data Link -->  
                        <br/>
                    
						<img src="images/world-01.jpg" /> 
						
                       
							


						
										
						<div id="bloc-slot">
                        	Top 20 of prefix assigned per country<br/><br/>
                            <span style="font:'Courier New', Courier, monospace;font-size:10px;">
                            <table border="0">
							<tr><td width="30px"><img src="<?=DOSSIER_IMG_COUNTRY?>us.png" /> </td><td width="120px">GS1 US </td><td width="30px"> (110)</td></tr>
							<tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>fr.png" /> </td><td>GS1 FR </td><td>(80)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>de.png" /> </td><td>GS1 DE </td><td>(41)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>it.png" /> </td><td>GS1 IT </td><td>(40)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>at.png" /> </td><td>GS1 AT </td><td>(20)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>jp.png" /> </td><td>GS1 JP </td><td>(20)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>au.png" /> </td><td>GS1 AU </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>be.png" /> </td><td>GS1 BE </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>ch.png" /> </td><td>GS1 CH </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>dk.png" /> </td><td>GS1 DK </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>es.png" /> </td><td>GS1 ES </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>fi.png" /> </td><td>GS1 FI </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>gb.png" /> </td><td>GS1 GB </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>nl.png" /> </td><td>GS1 NL </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>no.png" /> </td><td>GS1 NO </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>nz.png" /> </td><td>GS1 NZ </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>ru.png" /> </td><td>GS1 RU </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>se.png" /> </td><td>GS1 SE </td><td>(10)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>cn.png" /> </td><td>GS1 CN </td><td>(6)</td></tr>
                            <tr><td><img src="<?=DOSSIER_IMG_COUNTRY?>br.png" /> </td><td>GS1 BR </td><td>(2)</td></tr>
                            </table>
                            </span>
						</div>
						<br/>

						<div id="bloc-forum">
							<a href="https://twitter.com/openproductdata" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @openproductdata</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script><br/><br/	
                            
                          </div>
                          <br/><br/>

					</td>
				</tr>
				
			</table>

		</div>	
        
    </div>
         
    <div class="p4">
        <div class="inner">
          <div class="container">
            
            <div id="row">
                      </div>
            
          </div><!-- /container --> 
        </div><!-- /inner -->
         
        <div class="okf-footer">
          <div class="container">
            <ul>
                      <li><a href="http://okfn.org/terms-of-use/">Terms of use</a></li>
                              <li><a href="http://okfn.org/privacy-policy/">Privacy policy</a></li>
                              <li><a href="http://okfn.org/ip-policy/">IP Policy</a></li>
                            </ul>
          </div>
        </div>
    </div>
	  
	</body>

<? if ($_SERVER['HTTP_HOST'] != 'localhost') {?> 
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37935806-1']);
  _gaq.push(['_setDomainName', 'product-open-data.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 <? } ?>

</script>
</html>
