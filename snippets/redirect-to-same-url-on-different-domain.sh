RewriteCond %{HTTP_HOST} ^old\.domain\.com$ [NC]
RewriteRule ^(.*)$ http://new.domain.com/$1 [R=301,L]
