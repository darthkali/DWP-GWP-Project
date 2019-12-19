# Webseite des Fachschaftsrates der Angewandten Informatik
Im Rahmen des Projektes zum Thema Grundlagen und Dynamische Webentwicklung haben wir uns entschieden eine Webseite für den FSR AI zu erstellen.

## Getting Started

Hier erfahren Sie wie Sie die Webseite auf Ihrem System Installieren und starten können.

### Voraussetzungen

Was wird für die Installation / Ausführung der Webseite benötigt.

```
XAMPP Version: 7.3.5
Control Panel Version: 3.2.3  [ Compiled: Mar 7th 2019 ] (in XAMPP enthalten)
phpmyadmin
Internet Browser
```

### Installing

Einrichten von XAMPP

1. Port anpassen (optional)
  Wenn der Port (standard 80) bereits benutzt wird, z.b. von Skype, dann muss man hier eine Alternative einstellen
Nach der httpd.conf suchen:
* über ControlPanel - Apache Konfig -> Apache(httpd.conf)
* c:\xampp\apache\conf\httpd.conf

Suche nach dem EIntrag: Listen 80 (oder mit bereits anderer Portnummer)
Ändern der Portnummer auf z.B.: 8085 (über 1024)

Im ControlPanel auf Konfig (Rechtes Menüband ganz oben) -> Dienste und Ports einstellen
Hier im Reiter Apache den neuen Port eintragen

2. ShortOpen Tags einstellen
Nach der php.ini suchen:
* über ControlPanel - Apache Konfig -> PHP(php.ini)
* c:\xampp\php\php.ini

Suche nach dem EIntrag: short_open_tag=off suchen
Ändern auf short_open_tag=on

3. Projekt importieren
Das Gesamte Projekt in den htdocs Ordner Klonen (Standard: C:\xampp\htdocs)

4. Datenbankimportieren
über ControlPanel - MySQL starten
MySql - Admin (ruft die phpmyadmin seite auf)
Importieren
Datei auswählen (hier den SQL Script welcher sich im projektordner unter ..\FSAI-Site\src\database liegt auswählen)
Zeichencodierung: utf-8
Format: SQL

5. Aufruf der Seite
Im Browser localhost:8085/FSAI-Site ausführen (Port muss ggf dem oben gewählten angepasst werden)

6. Login
Es sind Standartmäßig 3 default User angelegt, welche sich später löschen lassen.
* Administrator:  E-Mail: admin@fh    PW: Admin@fh
* Mitglied:       E-Mail: mitglied@fh PW: Mitglied@fh
* Nutzer:         E-Mail: nutzer@fh   PW: Nutzer@fh

## Built With

* [PHP-Storm](https://www.jetbrains.com/phpstorm/) - IDE für HTML, CSS und PHP
* [Web-Storm](https://www.jetbrains.com/webstorm/) - IDE für JavaScript
* [Adobe XD](https://www.adobe.com/de/products/xd.html) - Tool für die Erstellung des Designs
* [Visio](https://products.office.com/de-de/visio) - Tool für die Erstellung der Diagramme / Charts / ...
* [MySQL-Workbench](https://www.mysql.com/de/products/workbench/) - Erstellung der Datenbank


## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Danny Steinbrecher** - [Profil](https://github.com/darthkali)
* **Niclas Jarowsky** - [Profil](https://github.com/TotalFlash)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
