# notes-manager

Менеджер заметок для одного или не очень пользователя на сервере пользователя.

### apache conf:

```
<VirtualHost *:80>
    ServerName notes-manager
    DocumentRoot /var/www/notes-manager/public
    <Directory /var/www/notes-manager/public>
        AuthType Basic
        AuthName "Admin zone"
        AuthUserFile /var/www/notes-manager/.htpasswd
        Require valid-user
    </Directory>
</VirtualHost>
```