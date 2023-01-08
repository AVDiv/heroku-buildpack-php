location / {
	index  index.php index.html index.htm;
	# Uncomment this if statement to force SSL/redirect http -> https
	try_files $uri $uri.html $uri/ @extensionless-php;
	if ($http_x_forwarded_proto != "https") {
	  return 301 https://$host$request_uri;
	}
}

# for people with app root as doc root, restrict access to a few things
location ~ ^/(composer\.(json|lock|phar)$|Procfile$|<?=getenv('COMPOSER_VENDOR_DIR')?>/|<?=getenv('COMPOSER_BIN_DIR')?>/|backend/|components/|\.gitignore/$|cookie_structure\.txt$) {
	# deny all;
	return 404;
}

# .php extensionless files
location @extensionless-php {
    if ( -f $document_root$uri.php ) {
        rewrite ^ $uri.php last;
    }
    return 404;
}
