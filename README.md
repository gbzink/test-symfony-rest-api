CODIBLY - Zadanie rekrutacyjne
========================


Instrukcja
--------------

Projekt oparty o Symfony 3.4

Ściągnij deploy key: http://various.codiblycoders.com/codibly-hr do folderu ~/.ssh
Dodaj klucz: ssh-add ~./ssh/codibly-hr

Sklonuj repozytorium z zadaniem git@gitlab.com:codibly/codibly-hr.git

Utwórz brancha {imie-nazwisko}.

Po wykonaniu zadania wyślij zmiany do repozytorium.

Zadanie 1
--------------
Utwórz REST API, które posłuży do wysyłki maili. API powinno zwracać odpowiedzi w formacie JSON. Aplikacja powinna być pokryta testami. API będzie posiadać następujące funkcjonalności:

* Endpoint do definiowania nowego maila
    * zdefiniowanie jednego lub wielu odbiorców
    * zdefiniowanie nadawcy
    * zdefiniowanie statusu czy mail jest już wysłany lub czy jest do wysyłki
* Endpoint zwracający konkretny mail
* Endpoint zwracający listę wszystkich maili
* Endpoint do wysyłania wszystkich niewysłanych maili
* Przygotuj mechanizm wysyłki i zaprojektuj architekturę tak aby w łatwy sposób można było dodać i wykorzystać alternatywny mechanizm

Dodatkowo (nieobowiązkowo):
* możliwość dodawania załączników przy tworzeniu maila
* możliwość ustawienia priorytetów wysyłki

Zadanie 2
--------------
* opisz tekstowo co należy uwzględnić przy tworzeniu takiej aplikacji wiedząc, że będzie ona wysyłać tysiące maili za jednym razem


&nbsp;


W razie pytań dotyczących treści zadania możesz pisać do:
Radek Smoczyński - radoslaw.smoczynski@codibly.com
#   t e s t - s y m f o n y - r e s t - a p i  
 #   t e s t - s y m f o n y - r e s t - a p i  
 #   t e s t - s y m f o n y - r e s t - a p i  
 #   t e s t - s y m f o n y - r e s t - a p i  
 #   t e s t - s y m f o n y - r e s t - a p i  
 "# test-symfony-rest-api" 
