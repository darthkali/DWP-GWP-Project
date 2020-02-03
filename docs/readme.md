[![CodeFactor](https://www.codefactor.io/repository/github/darthkali/dwp-gwp-project/badge/master?s=17405f65133fc8d0a0ea804b4fb6c4fac532809e)](https://www.codefactor.io/repository/github/darthkali/dwp-gwp-project/overview/master)

![CodeFactor](https://img.shields.io/badge/PHP-7.4.1-blue)
![CodeFactor](https://img.shields.io/badge/xampp-7.3.5-orange)
![CodeFactor](https://img.shields.io/badge/MariaDB-10.4.11-Yellow)



# Webseite des Fachschaftsrates der Angewandten Informatik
Im Rahmen des Projektes zum Thema Grundlagen und Dynamische Webentwicklung haben wir uns entschieden eine Webseite für den FSR AI zu erstellen.

## Getting Started

Hier erfahren Sie wie Sie die Webseite auf Ihrem System Installieren und starten können.

### Voraussetzungen

Was wird für die Installation / Ausführung der Webseite benötigt.

```
XAMPP Version: 7.3.5
Control Panel Version: 3.2.4  [ Compiled: Mar 7th 2019 ] (in XAMPP enthalten)
phpmyadmin
Internet Browser
```

### Installing

Einrichten von XAMPP

1. ##### Port anpassen (optional)

   ###### Wenn der Port (standard 80) bereits benutzt wird, z.b. von Skype, dann muss man hier eine Alternative einstellen

    * nach der httpd.conf suchen und den Port ändern:
        * über ControlPanel - Apache Konfig -> Apache(`httpd.conf`)
        * `C:\xampp\apache\conf\httpd.conf`
        * Suche nach dem EIntrag: Listen 80 (oder mit bereits anderer Portnummer)
        * ändern der Portnummer auf z.B.: 8085 (muss über 1024 sein)

    * Port im ControlPanel ändern
        * Im ControlPanel auf Konfig (Rechtes Menüband ganz oben) -> Dienste und Ports einstellen
        * hier im Reiter `Apache` den neuen Port eintragen

2. ##### ShortOpen Tags einstellen
   ###### Damit die in dem Projekt genutzten ShortOpenTags (`<? ?>` statt `<?php ?>`) funktionieren
   
    * Nach der php.ini suchen:
        * über ControlPanel - Apache Konfig -> PHP(`php.ini`)
        * `C:\xampp\php\php.ini`
    
    * Suche nach dem EIntrag: 
        * `short_open_tag=off`
        * ändern auf `short_open_tag=on`

3. ##### Projekt importieren
    * das Gesamte Projekt in den htdocs Ordner klonen oder aus dem Zip-Archiv entpacken (Standard: `C:\xampp\htdocs`)

4. ##### Datenbankimportieren
    * über ControlPanel - MySQL starten
    * MySql - `Admin` (ruft die phpmyadmin Seite auf)
    * Im der Oberen Menüleiste auf `Importieren` klicken
    * Auf `Datei auswählen` klicken
           
        * hier den SQL Script welcher sich im projektordner unter `..\FSAI-Site\src\database` befindet auswählen
    
    * Zeichencodierung: `utf-8`
    * Format: `SQL`

5. ##### Aufruf der Seite
    * Im Browser `localhost:8085/FSAI-Site` ausführen (Port muss ggf dem oben gewählten angepasst werden)

6. ##### Login
    * Es sind Standartmäßig 3 default User angelegt, welche sich später löschen lassen.
    * **Administrator**:----E-Mail: `admin@fh.de`-------PW: `Password.1`
    * **Mitglied**:----------E-Mail: `mitglied@fh.de`----PW: `Password.1`
    * **Nutzer**:------------E-Mail: `nutzer@fh.de`------PW: `Password.1`

## Built With

* [XAMPP](https://www.apachefriends.org/de/index.html) - Apache-Distribution, die MariaDB und PHP enthält.
* [PHP-Storm](https://www.jetbrains.com/phpstorm/) - IDE für HTML, CSS und PHP
* [Web-Storm](https://www.jetbrains.com/webstorm/) - IDE für JavaScript
* [Adobe XD](https://www.adobe.com/de/products/xd.html) - Tool für die Erstellung des Designs
* [Visio](https://products.office.com/de-de/visio) - Tool für die Erstellung der Diagramme / Charts / ...
* [MySQL-Workbench](https://www.mysql.com/de/products/workbench/) - Erstellung der Datenbank

## Authors

* **Danny Steinbrecher** - [Profil](https://github.com/darthkali)
* **Niclas Jarowsky** - [Profil](https://github.com/TotalFlash)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
