# Yii2 practice

```
<VirtualHost *:%httpport%>

    DocumentRoot    "%hostdir%"
    ServerName      "%host%"
    ServerAlias     "%host%" %aliases%
    ScriptAlias     /cgi-bin/ "%hostdir%/cgi-bin/"
</VirtualHost>
```

admin/12345678