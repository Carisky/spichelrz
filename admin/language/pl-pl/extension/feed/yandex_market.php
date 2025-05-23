<?php
// *	@source		See SOURCE.txt for source and other copyright.
// *	@license	GNU General Public License version 3; see LICENSE.txt

// Heading
$_['heading_title'] = 'Yandex.Market';

//Tekst
$_['text_extension'] = 'Rozszerzenia';
$_['text_feed'] = 'Kanały promocji';
$_['text_success'] = 'Ustawienia zostały pomyślnie zmienione!';
$_['text_edit'] = 'Edycja';
$_['text_width'] = 'Szerokość';
$_['text_height'] = 'Wysokość';
$_['text_not_unload'] = 'Nie rozładowuj';
$_['text_product_id'] = 'Identyfikator produktu - id_produktu';
$_['text_name'] = 'Nazwa produktu - nazwa';
$_['text_meta_h1'] = 'Tag HTML H1 - meta_h1';
$_['text_meta_title'] = 'Znacznik tytułu HTML - meta_title';
$_['text_meta_keyword'] = 'Metatag słów kluczowych - meta_keyword';
$_['text_meta_description'] = 'Metatag „Opis” - meta_description';
$_['text_model'] = 'Kod produktu - model';
$_['text_sku'] = 'Artykuł (SKU, kod producenta) - sku';
$_['text_upc'] = 'UPC - upc';
$_['text_ean'] = 'EAN - ean';
$_['text_jan'] = 'JAN - styczeń';
$_['text_isbn'] = 'ISBN - isbn';
$_['text_mpn'] = 'MPN - mpn';
$_['text_location'] = 'Lokalizacja';
$_['text_simplified'] = 'Typ uproszczonego opisu';
$_['text_vendor_model'] = 'Typ opisu niestandardowego - sprzedawca.model';
$_['text_medicine'] = 'Leki - medycyna';
$_['text_books'] = 'Książki - książki';
$_['text_audiobooks'] = 'Audiobooki';
$_['text_artist_title'] = 'Produkcja muzyki i wideo - artysta.title';
$_['text_event_ticket'] = 'Bilety na wydarzenie - bilet na wydarzenie';
$_['text_tour'] = 'Wycieczki - wycieczka';

//Wpis
$_['entry_status'] = 'Stan';
$_['entry_secret_key'] = 'Tajny klucz';
$_['entry_data_feed'] = 'Adres';
$_['entry_shopname'] = 'Nazwa sklepu';
$_['entry_company'] = 'Firma';
$_['entry_id'] = 'Identyfikator oferty';
$_['entry_type'] = 'Typ wpisu';
$_['entry_name'] = 'Pobierz plakietkę z pola';
$_['entry_model'] = 'Pobierz znacznik modelu z pola';
$_['entry_vendorcode'] = 'Pobierz tag VendorCode z pola';
$_['entry_image'] = 'Produkt ze zdjęciami';
$_['entry_image_resize'] = 'Rozdzielczość obrazu';
$_['entry_image_quantity'] = 'Ilość zdjęć produktów';
$_['entry_main_category'] = 'Produkt z kategorią główną';
$_['entry_category'] = 'Kategorie';
$_['entry_manufacturer'] = 'Producenci';
$_['entry_currency'] = 'Waluta oferty';
$_['entry_in_stock'] = 'Stan „W magazynie”';
$_['entry_out_of_stock'] = 'Stan "Brak w magazynie"';
$_['entry_quantity_status'] = 'Prześlij, gdy ilość wynosi 0';

//Help
$_['help_secret_key'] = 'Klucz dostępu do pliku YML w celu ochrony przed atakami DDoS i pobrania bazy danych produktów.';
$_['help_shopname'] = 'Krótka nazwa sklepu (nazwa wyświetlana na liście produktów znalezionych na Yandex.Market. Nie powinna zawierać więcej niż 20 znaków).';
$_['help_company'] = 'Pełna nazwa firmy będącej właścicielem sklepu. Niepublikowane, wykorzystywane do wewnętrznej identyfikacji.';
$_['help_id'] = 'Identyfikator może zawierać tylko cyfry i litery łacińskie. Maksymalna długość identyfikatora to 20 znaków. Domyślnie identyfikator produktu.';
$_['help_type'] = 'Typ struktury pliku YML dla konkretnego tematu produktu.';
$_['help_name'] = 'Domyślna nazwa produktu.';
$_['help_model'] = 'Domyślny kod produktu.';
$_['help_vendorcode'] = 'Domyślny kod SKU (kod producenta).';
$_['help_image'] = 'Jeśli tak, produkty bez zdjęć nie zostaną wyładowane.';
$_['help_image_resize'] = 'Yandex wymaga rozdzielczości obrazu co najmniej 250x250px. Zalecana jest rozdzielczość 600 x 600 pikseli. Maksymalny rozmiar 3500x3500px.';
$_['help_image_quantity'] = 'Ile zdjęć produktów wyeksportować. Yandex przyjmuje nie więcej niż 10.';
$_['help_main_category'] = 'Jeśli tak, produkty nie posiadające kategorii głównej nie zostaną wyładowane.';
$_['help_category'] = 'Sprawdź kategorie, z których chcesz eksportować oferty dla Yandex.Market. Jeśli opcja nie jest zaznaczona, wszystkie towary zostaną rozładowane.';
$_['help_manufacturer'] = 'Zaznacz producentów, od których chcesz eksportować oferty dla Yandex.Market. Jeśli opcja nie jest zaznaczona, wszystkie towary zostaną rozładowane.';
$_['help_currency'] = 'Yandex.Market akceptuje oferty w RUR, RUB i UAH. Wybierz walutę w jakiej będą przesyłane oferty.';
$_['help_in_stock'] = 'Jeśli produkt jest dostępny.';
$_['help_out_of_stock'] = 'Kiedy stan zapasów wynosi 0.';
$_['help_quantity_status'] = 'Jeśli tak, to produkty o zerowej ilości zostaną wyładowane w pliku YML.';
$_['help_yandex_market'] = 'Temat na <a target="_blank" href="//forum.opencart.pro/topic/1059-yandexmarket-20/">Forum</a>';

// Błąd
$_['error_image_width'] = 'Proszę określić szerokość!';
$_['error_image_height'] = 'Wprowadź wzrost!';
$_['error_image_width_min'] = 'Szerokość obrazu nie może być mniejsza niż 250 pikseli!';
$_['error_image_height_min'] = 'Wysokość obrazu nie może być mniejsza niż 250 pikseli!';
$_['error_image_width_max'] = 'Szerokość obrazu nie powinna przekraczać 3500 pikseli!';
$_['error_image_height_max'] = 'Wysokość obrazu nie powinna przekraczać 3500 pikseli!';
$_['error_permission'] = 'Nie masz uprawnień do wprowadzania zmian!';