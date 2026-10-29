# laravel_app: własność nieruchomości egzekwowana na serwerze

Branch: `wersja-inzynierska-2026`. Stan bazowy: `master` / `76f7ce0ce1daf4323193303f16346ab46b5ae606`. Data wykonania: 29.10.2026.

To autorski wariant rozwojowy konkretnego fragmentu projektu. Branch zachowuje pełne drzewo kodu z wersji bazowej i zawiera opisane poniżej zmiany. [Wcześniejszy audyt](https://github.com/MichalGarnuch/laravel_app/tree/audyt-edukacyjny-2026) jest na osobnym branchu. Nie wykonywano merge ani wdrożenia.

## Błąd granicy uprawnień

Lista ograniczona w menu nie zabezpiecza adresu `properties/{id}`. Użytkownik może zmienić identyfikator ręcznie. Uprawnienie do odczytu, edycji i usunięcia musi wynikać z powiązania rekordu z tożsamością na serwerze.

Dodałem nullable `properties.user_id` z kluczem obcym do `users` i zakazem kaskadowego usuwania. `PropertyPolicy` dopuszcza odczyt, aktualizację i usunięcie wyłącznie właścicielowi. `viewAny` i `create` pozwalają wejść do własnego zestawu i tworzyć rekordy; same nie dają dostępu do cudzych obiektów. Zbiorcze usuwanie jest wyłączone.

## Dwie ścieżki do tych samych danych

`PropertyController` filtruje index po identyfikatorze zalogowanego użytkownika. Przy tworzeniu właściciel pochodzi z sesji, nie z formularza. Akcje na istniejącym rekordzie wywołują `Gate::authorize`. Laravel odkrywa politykę przez standardową konwencję `Property`→`PropertyPolicy`.

Filament jest drugą ścieżką: jego resource ma ograniczone zapytanie, a `CreateProperty` dopisuje właściciela po stronie serwera. Zabezpieczenie tylko zwykłego kontrolera zostawiłoby dostęp przez panel. Dane biznesowe nadal wymagają własnej walidacji; polityka rozstrzyga, kto może je zmienić.

## Migracja danych — wymagana decyzja przed wdrożeniem

Nowa migracja dodaje nullable ownera, aby nie zgadywać właścicieli istniejących nieruchomości. Rekordy z `user_id=NULL` nie są widoczne dla zwykłych użytkowników. Przed wdrożeniem administrator musi przypisać je na podstawie wiarygodnej ewidencji i sprawdzić liczbę nieprzypisanych rekordów. Nie wolno ustawić wszystkich na konto pierwszego użytkownika tylko po to, żeby zniknął błąd.

W tej sesji nie wykonywano migracji na zewnętrznej bazie. W środowisku testowym `RefreshDatabase` tworzy bazę SQLite w pamięci. Test tworzy dwóch użytkowników, nieruchomość pierwszego i sprawdza 403 dla drugiego oraz 200 dla właściciela. Wyłączone Vite dotyczy tylko testu HTTP, nie zabezpieczeń aplikacji.

## Kierunek rozwoju

Model jeden właściciel→rekord jest świadomym uproszczeniem. Jeżeli firma ma zespoły zarządzające wspólnymi obiektami, kolejnym modelem powinny być organizacje, członkostwa i role do zasobów, zamiast kolejnych wyjątków w kontrolerze. Potrzebne są testy Filament, eksportów, relacji oraz bulk actions. Ochrona samej nieruchomości nie dowodzi izolacji wszystkich powiązanych najemców i płatności.

## Weryfikacja wykonana w tej sesji

| Sprawdzenie | Wynik i znaczenie |
|---|---|
| PHPUnit --filter PropertyIsolationTest | PASS: 1 test HTTP, 2 asercje; SQLite w pamięci |
| php -l zmienionych plików | PASS |
| composer install + package:discover | PASS w środowisku roboczym |

### Granice weryfikacji

Nie wykonano pełnej baterii Laravel ani testu przeglądarkowego Filament. Brak backfill produkcyjnych właścicieli, testów MySQL i izolacji wszystkich relacji domeny. Migracja może zmienić widoczność wcześniejszych rekordów do czasu poprawnego przypisania.

## Mapa zmian

- [`app/Policies/PropertyPolicy.php`](app/Policies/PropertyPolicy.php)
- [`database/migrations/2026_10_29_000001_add_property_owner.php`](database/migrations/2026_10_29_000001_add_property_owner.php)
- [`tests/Feature/PropertyIsolationTest.php`](tests/Feature/PropertyIsolationTest.php)
- [`app/Filament/Resources/Properties/Pages/CreateProperty.php`](app/Filament/Resources/Properties/Pages/CreateProperty.php)
- [`app/Filament/Resources/Properties/PropertyResource.php`](app/Filament/Resources/Properties/PropertyResource.php)
- [`app/Http/Controllers/PropertyController.php`](app/Http/Controllers/PropertyController.php)
- [`app/Models/Property.php`](app/Models/Property.php)
