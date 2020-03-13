arbetsprov
==========

Lösning på en uppgift jag fick göra på en konsultintervju som ägde rum i juli 2012.

### Uppgift
Din uppgift går ut på att skapa ett inmatningsformulär som ska spara inmatad data i en databas. 

Genom ett enkelt gränssnitt ska man sedan kunna lista informationen i tabellform men även kunna få det presenterat som en xml-fil enligt formatet nedan. Detta betyder att formuläret måste kunna ta denna datan som är definerad i xmlen som input. 

Det ska även finnas möjlighet att ta bort rader ur tabellen via gränssnittet. Systemet ska ha stöd för ett oändligt antal rader med information. 

XML-formatet ska se ut såhär:
```xml
<programs>
   <program>
      <date>2009-04-16T17:33:00+00:00</date>
      <start_time>17:00</start_time>
      <leadtext>Fran är en något udda barnflicka. Hon kommer från den tuffa New York-stadsdelen Queens och är en kvinna med starka åsikter, ett ansikte som skulle platsa på Vogues omslag, samt en röst som kan spräcka glas!</leadtext>
      <name>Program 1</name>
      <b-line>Tysk thrillerserie</b-line>
      <synopsis>Maxwell ringer Fran och säger att han gjorde ett stort misstag för några månader sen. Fran blir alldeles till sig och hoppas att han ska förklara sin kärlek till henne. Istället handlar det bara om en skattedetalj. Fran flyttar ut och Sylvia tar över jobbet. Del 16:25</synopsis>
      <url>http://www.domain.tld/programname</url>
   </program>
   <program>
      <date>2007-08-13T12:16:00+00:00</date>
      <start_time>21:00</start_time>
      <leadtext>Om familjerna Horton, Brady, Black, Kiriakis och deras vänner, grannar och rivaler i Salem, USA. Familjen Horton består bl a av Alice, sonen Mickey och barnbarnen Jennifer och Mike. Familjen Brady består bl a av Shawn och Caroline, som är familjens överhuvuden, samt Bo, Carrie, Samantha (Sami), Marlena, Roamn och John. Intriger, romanser och spänning präglar denna serier som startade i USA 1965 och har därmed varit under inspelning i 40 år.</leadtext>
      <name>Program 2</name>
      <b-line>Drama från 2003</b-line>
      <synopsis>Gänget berättar historier om hur de träffade varandra och reaktionen från Teds nya flickvän får nio av tio på knäpphetsskalan. Del 5:24</synopsis>
      <url>http://www.domain.tld/programname</url>
   </program>
   <program>......</program>
</programs>
```
#### Regler
    • Det finns inga krav på en funktionell design, bara det finns ett system som fungerar enligt kraven ovan med en enkel navigering för listande och skapande av nytt innehåll. 
    • Viktigt är att den XML som skapas är välformaterad och inte innehåller några valideringsfel.
    • Koden ska innehålla kommentarer (gärna Doxygen).
    • Koden ska vara av sådan kvalitet att den kan användas i en produktionsmiljö.
    • Det är ej tillåtet att använda något ramverk, all kod skall vara skriven av dig.
