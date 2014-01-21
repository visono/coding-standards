Vorwort
_______

Generell werden die Regeln aus dem PSR2 Standard verwendet. Ausnahmen sind unten definiert.
PSR Konventionen

- https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
- https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md

____
Von PSR abweichend ist definiert
- Es wird KEIN UTF8 verwendet
- Es werden TABS statt SPACES verwendet 

____
Zudem wurde zusätzlich festgelegt
- Keine Yoda-Schreibweise
- Keine strikte Prüfungen empty($x) === false sondern "weiche" empty($x) == false oder $x == "Hallo" - natürlich darf eine strikte Prüfung verwendet werden - muss aber nicht!
- Das Ausrufezeichen darf nicht alleinstehend in Vergleichen verwendet werden. Verboten: if(!$error). Erlaubt: if($error !== true).
- Für mehrzeilige Funktions-Aufrufe/Prüfungen/Arrays? ist die Einrückungen ein Tab unterhalb des Funktionsaufrufs, der erste Parameter ist in die neue Zeile zu setzen
