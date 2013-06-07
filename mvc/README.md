Chris - A PHP-based MVC-inspired CMF!
====================================

This document will show you how to install and how to configure the Chris framework to get your own webapplication up and running. 
All instructions from here and on will be in swedish!

## Installation av Chris

1. För att kunna installera Chris så behöver du klona det från webbtjänsten Github. För att själva kloningen skall gå att
genomföra så behöver du Git Bash eller Git GUI på din dator, de kan laddas ner på följande länk: http://git-scm.com/downloads
2. Du klonar den sedan till den mapp där du vill lägga din site, för tips och tutorials kring git och github, kolla följande 
länk: http://dbwebb.se/kunskap/kom-igang-med-git-och-github
3. För att databasen skall fungera så måste du göra den skrivbar, i Git Bash kan du använda följande kommando för att åstadkomma 
detta: "cd Chris; chmod 777 site/data". Annars kan du även välja att göra det manuellt via en sftp-server, exempelvis Filezilla om du har det.
4. För att hela siten skall fungera så måste du även ändra i den .htaccess fil som finns i ramverkets root. Det du behöver ändra i .htaccess filen
är RewriteBase funktionen som måste ställas in efter ditt egets projekts egenskaper. Ändra RewriteBase /change/this/to/site/base/url/if/needed/ till 
där mappen ligger på din server eller i dina lokala filer för att det skall fungera.
5. Det sista som måste göras är att initiera modulerna. Det gör du via module/install. Då skapas automatiskt två användare: root:root samt doe:doe. 
Det skapas även standardinnehåll i databasen för att visa på att det fungerar, detta standardinnehåll går att redigare samt radera om så önskas.
Även gästbokens databastabeller initieras via detta kommando.

## Ändra utseende på Chris/Ditt egna ramverk

### CSS
För att ändra utseendet på ditt ramverk så öppnar du root/site/themes/mytheme/style.css i en filredigerare, kvittar vilket, det viktiga är att du sedan uppdaterar
filen och laddar upp den till servern så att den uppdateras. I style.css kan du ändra utseendet på det mesta när det gäller ditt ramverk, saker såsom färger, 
typografi, layout och mycket mer, bara du sätter gränserna!

### Logo
För att ändra din logotyp så måste denna läggas till i root/site/themes/mytheme/. För att det ska vara så smidigt som möjligt bör den heta logo.png.

### Favicon
För att ändra din favicon så måste denna läggas till i root/site/themes/mytheme/. För att det ska vara så smidigt som möjligt bör den heta favicon.png.

### Titel
Om du vill ändra titlen på ramverket så gör man detta i root/site/config.php. Längst ner i den filen finns det en rad där det står 'header' => 'Chris'. 
Ändra ordet inom citattecknena (Chris) för att byta sidans titel.

### Footer
Om du vill ändra nogåonting i footern så går du tillväga på samma vis som när du ska byta titel. Längre ner i filen finner du en rad som ser ut som 
följer: 'footer' => '<p>Chris &copy;</p>' Detta byter du ut till det du önskar.

### Navigeringsmeny
För att lägga till ändra menyalternativen så är det återigen root/site/config.php du ska göra ändringar i. Det ställe du ska göra ändringar i är
i följande array som håller menyalternativen: 'my-navbar' => array( 'about' => array('label'=>'About Me', 'url'=>'my'), ). Här lägger du alltså till
och/eller tar bort menyalternativ.

### Skapa en blogg
I standardinstallationen av Chris så följer 3 menyalternativ och således 3 sektioner med. Dessa är About me (om mig), Blog (en bloggliknande sida) och Guestbook
(en gästbok). Således behöver man inte göra något för att skapa en blogg då den funktionen följer med i grundinstallationen. Via indexsidan i ramverket kan du
via content/create skapa blogginlägg. Type måste satt till post och filter ska vara plain om du bara skriver vanlig text. Andra alternativ är bbcode och htmlpurify.

### Skapa en sida
För att lägga till en ny sida så krävs det att man ändrar om i två olika filer: CCMycontroller.php, config.php. Du behöver också lägga till till en fil 
för att kunna visa sidan som du skapat. Detta skall ske i mappen root/site/src/CCMycontroller/.

Nedan följer en liten tutorial om hur man kan gå tillväga för att skapa en ny sida.
CCMycontroller.php

Om du vill lägga till en ny sida eller sektion till din hemsida så börjar du med att öppna root/site/src/CCMycontroller/CCMycontroller.php. 
I CCMycontroller.php så finns tre kommentarer som beskriver tre olika sektioner som finns på hemsidan, dessa heter lyder "The page about me", "The blog" 
och "The guestbook". Under dessa rubriker så finns det var sin publik funktion som sköter presentationen av var och en av dem. Här lägger du till 
en ny publik funktion för att börja skapa en ny sida. Här nedan finns ett exempel på hur koden för "About me" sidan ser ut, under kommentaren 
"The page about me":


/**
* The page about me
*/
 public function Index() {
    $content = new CMContent(5);
    $this->views->SetTitle('About me'.htmlEnt($content['title']))
                ->AddInclude(__DIR__ . '/page.tpl.php', array(
                  'content' => $content,
                ));
  }

Det som behöver ändras först är numret i $content = new CMContent(5). Numret bestämmer vilket content från datasbasen som ska representera sidan, med andra 
ord vilket innehållet fylls med. Du kan även lämna det tomt om du inte vill ta in något från databasen utan istället skriva ut annat innehåll själv.
För att skapa en ny sida bör du då gå till content/create och skapa en sida av typen page och sedan sätta in det numret i parentesen ovan för
att ditt önskade innehåll skall skrivas ut. Du får sedan ändra titeln till det du önskar att sidan skall heta. Sedan måste du även skapa en template (vy) där
innehållet skrivs ut. Säg att din titel är My work så bör templaten heta work.tpl.php. Då ändrar du även page.tpl.php till work.tpl.php i funktionen för att 
det ska fungera. I din work.tpl.php kan du bestämma vad som ska visas upp på sidan i fråga.

Föreställ dig att du skapar en sida som visar upp jobb du gjort, då tar man bort numret (numret hänvisar till en databastabell i CMContent, 
vilket håller i default texter för ramverket). Du kan använda titlen 'My work', sid-filen 'work.tpl.php' och rubriken "The page about my work":


/**
* The page about my work
*/
  public function Mywork() {
    $content = new CMContent();
    $this->views->SetTitle('My work'.htmlEnt($content['title']))
                ->AddInclude(__DIR__ . '/work.tpl.php', array(
                  'content' => $content,
                ));
  }

config.php

Nästa fil som behöver ändras är root/site/config.php. Öppna den så finns det en kodrad som lyder: $Chris->config['menus']. 
För att ändra webbsidans meny så behöver du gå ner till: 'my-navbar' => array(, varav därunder redan finns tre alternativ: 'home', 'blog' samt 'guestbook':
För att lägga till din sida så kan du exempelvis lägga till ett menyalternativ som ska stå för "My work" där du visar upp det du gjort.


     'my-navbar' => array(
         'home' => array('label'=>'About Me', 'url'=>'my'),
         'blog' => array('label'=>'My Blog', 'url'=>'my/blog'),
         'guestbook' => array('label'=>'Guestbook', 'url'=>'my/guestbook'),
		 'mywork' => array('label'=>'My work', 'url'=>'my/mywork'),