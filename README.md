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

## Hosting via GitHub Pages

GitHub Pages voert geen PHP uit, maar deze repository bevat een **statische export** van de site in de map [docs/](docs/), gegenereerd met [build.php](build.php). Die map kan GitHub Pages wél serveren.

**Eenmalig inschakelen:**
1. Ga naar https://github.com/HenriB04/StudioVendrig/settings/pages
2. Kies bij *Source*: **Deploy from a branch**
3. Kies branch **main** en map **/docs**, klik *Save*

Na een paar minuten staat de site live op **https://henrib04.github.io/StudioVendrig/**

**Na het aanpassen van inhoud** genereer je de statische versie opnieuw en push je:

```powershell
cd C:\StudioVendrig
C:\php\php.exe build.php
git add -A
git commit -m "Inhoud bijgewerkt"
git push
```

Let op: op de statische versie werkt het PHP-contactformulier niet; daar staat automatisch een e-mailknop voor in de plaats. Voor een live site mét werkend formulier is een PHP-host nodig (bijv. Vimexx, TransIP of gratis via InfinityFree) — upload dan gewoon de PHP-bestanden.
