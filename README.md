# Studio Vendrig — vernieuwde website

Een volledig vernieuwde look voor [www.studiovendrig.nl](https://www.studiovendrig.nl), gebouwd in **puur PHP** (geen frameworks, geen database). Alle inhoud van de originele website is behouden: alle projecten, teksten, nieuwsberichten, afbeeldingen en contactgegevens.

## Lokaal draaien (Windows)

Vereist: PHP (staat op deze laptop in `C:\php`).

```powershell
cd C:\StudioVendrig
C:\php\php.exe -S localhost:8000
```

Open daarna in je browser: **http://localhost:8000**

> Tip: voeg `C:\php` toe aan je PATH-omgevingsvariabele, dan volstaat `php -S localhost:8000`.

Stoppen doe je met `Ctrl+C` in het terminalvenster.

## Structuur

```
index.php            Homepage met hero-diavoorstelling
projecten.php        Projectenoverzicht, filterbaar per categorie
project.php?id=N     Projectdetail met galerij en lightbox
studio.php           Over Studio Vendrig
nieuws.php           Nieuwsarchief (+ ?id=N voor een artikel)
samenwerking.php     Studio In Motion
contact.php          Contactgegevens en contactformulier
includes/            Gedeelde header, footer, data en helpers
assets/              CSS, JavaScript, afbeeldingen en bijlagen
```

## Inhoud aanpassen

- **Projecten**: [includes/data.php](includes/data.php) — één array per project (titel, categorie, beschrijving, afbeeldingen).
- **Nieuws**: [includes/news.php](includes/news.php).
- **Contactgegevens & menu**: [includes/functions.php](includes/functions.php).
- **Vormgeving**: [assets/css/style.css](assets/css/style.css).

## Contactformulier

Berichten worden lokaal weggeschreven naar `berichten.log` (genegeerd door git). Op een echte host met een mailserver verstuurt `mail()` het bericht naar info@studiovendrig.nl.

## Hosting

GitHub kan de **code** hosten (deze repository), maar GitHub Pages voert geen PHP uit. Voor een live PHP-site is een PHP-host nodig, bijvoorbeeld een gratis/goedkope host als InfinityFree, of een Nederlandse hoster (Vimexx, TransIP, etc.). De site draait op elke standaard PHP-host: upload de bestanden en klaar — er is geen database of configuratie nodig.
