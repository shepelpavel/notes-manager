# pass-manager

Менеджер паролей для одного пользователя на сервере пользователя.

### apache conf:

```
<VirtualHost *:80>
    ServerName pass-manager
    DocumentRoot /var/www/pass-manager/public
    <Directory /var/www/pass-manager/public>
        AuthType Basic
        AuthName "Admin zone"
        AuthUserFile /var/www/pass-manager/.htpasswd
        Require valid-user
    </Directory>
</VirtualHost>
```