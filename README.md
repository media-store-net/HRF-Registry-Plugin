# HRF Registry Plugin

##Description

**Funktionaler Ablauf:**

Ein **Registrierungsformular** steht in einem **Shortcode** zur Verfügung und kann somit auf einer beliebigen Seite von Wordpress eingebunden werden.
- Wenn ein User das Formular ausgefüllt und abgeschickt hat, wird im ersten Schritt eine Bestätigungsmail für den Kunden generiert, 
in der er als Inhaber seiner Email-Adresse identifiziert wird. **(double-opt-in)**
- Ist die Inhaberschaft des Users bestätigt, wird eine zweite Email generiert die an den Administrator geht, dieser hat als erstes
die Einsicht in die Daten des Kunden und 2 Links um den User freizuschalten oder abzulehnen.
- Wird der User seitens Administrator freigeschaltet, wird der User im System angelegt und bekommt eine Email mit seinen Zugangsdaten.
- Wird der User abgelehnt, werden alle erfassten Daten des Users aus DB gelöscht und der User bekommt eine Email mit den Kontaktdaten zur direkten Kontaktaufnahme.
- Der geschützte Bereich für die User kann sowohl als Zusatzplugin oder Page Template realisiert werden.


## Requirements

* PHP >= 5.4.0

## Change Log

- v1.0 Initial Commit 


## Coding Guidelines

The coding is a mix between PSR-2 and Wordpress PHP guidelines.

## License

**Wordpress Plugin** is free software distributed under the terms of the MIT license.
