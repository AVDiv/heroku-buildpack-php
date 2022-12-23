location / {
	index  index.php index.html index.htm;
	# Uncomment this if statement to force SSL/redirect http -> https
	if ($http_x_forwarded_proto != "https") {
	  return 301 https://$host$request_uri;
	}
}

# for people with app root as doc root, restrict access to a few things
location ~ ^/(composer\.(json|lock|phar)$|Procfile$|<?=getenv('COMPOSER_VENDOR_DIR')?>/|<?=getenv('COMPOSER_BIN_DIR')?>/) {
	deny all;
}
