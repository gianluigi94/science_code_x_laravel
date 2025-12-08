<?php

namespace Database\Seeders;

use App\Models\TraduzioneModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TraduzioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TraduzioneModel::create([
            'chiave' => 'ui.main.img.alt',
            'id_lingua' => 1,
            'valore' => 'Immagine di sfondo delle locandine',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.main.img.alt',
            'id_lingua' => 2,
            'valore' => 'Background image of the posters',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.main.email_button',
            'id_lingua' => 1,
            'valore' => 'Inizia',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.main.email_button',
            'id_lingua' => 2,
            'valore' => 'Get Started',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.main.cta',
            'id_lingua' => 1,
            'valore' => 'Approfitta dell\'offerta <strong>gratuita</strong> e immergiti in un universo di conoscenza.',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.main.cta',
            'id_lingua' => 2,
            'valore' => 'Take advantage of the <strong>free</strong> offer and dive into a universe of knowledge.',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.main.scendi',
            'id_lingua' => 1,
            'valore' => 'Scorri per registrarti',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.main.scendi',
            'id_lingua' => 2,
            'valore' => 'Scroll to register',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.main.sottotitolo',
            'id_lingua' => 1,
            'valore' => 'sottotitolo',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.main.sottotitolo',
            'id_lingua' => 2,
            'valore' => 'subtitle',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.prev_btn.title',
            'id_lingua' => 1,
            'valore' => 'Vedi precedente',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.prev_btn.title',
            'id_lingua' => 2,
            'valore' => 'See the previous',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.next_btn.title',
            'id_lingua' => 1,
            'valore' => 'Vedi prossima',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.next_btn.title',
            'id_lingua' => 2,
            'valore' => 'See the next',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.novita.label',
            'id_lingua' => 1,
            'valore' => 'Novità',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.novita.label',
            'id_lingua' => 2,
            'valore' => 'new',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.slide.alt',
            'id_lingua' => 1,
            'valore' => 'Slide «{{title}}»',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.slide.alt',
            'id_lingua' => 2,
            'valore' => 'Slide «{{title}}»',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.slide_tooltip.title',
            'id_lingua' => 1,
            'valore' => 'Vai a “{{title}}»',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.slide_tooltip.title',
            'id_lingua' => 2,
            'valore' => 'Go to “{{title}}»',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.slide.label',
            'id_lingua' => 1,
            'valore' => 'Vai alla slide {{n}}',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.slide.label',
            'id_lingua' => 2,
            'valore' => 'Go to slide {{n}}',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.video.error',
            'id_lingua' => 1,
            'valore' => 'Il tuo browser non supporta il video.',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.video.error',
            'id_lingua' => 2,
            'valore' => 'Your browser doesn’t support video.',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.prev_slide_tooltip.title',
            'id_lingua' => 1,
            'valore' => 'Vedi la locandina precedente: “{{title}}"',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.prev_slide_tooltip.title',
            'id_lingua' => 2,
            'valore' => 'See previous slide: “{{title}}"',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.next_slide_tooltip.title',
            'id_lingua' => 1,
            'valore' => 'Vedi la locandina successiva: “{{title}}".',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.next_slide_tooltip.title',
            'id_lingua' => 2,
            'valore' => 'See next slide: “{{title}}"',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.carosello.play_tooltip.title',
            'id_lingua' => 1,
            'valore' => 'Vai alla pagina: “{{title}}”',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello.play_tooltip.title',
            'id_lingua' => 2,
            'valore' => 'Go to page: “{{title}}”',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.lingua.button.title',
            'id_lingua' => 1,
            'valore' => 'Passa all\'inglese',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.lingua.button.title',
            'id_lingua' => 2,
            'valore' => 'Switch to Italian',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.caricamento.label',
            'id_lingua' => 1,
            'valore' => 'Caricamento...',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.caricamento.label',
            'id_lingua' => 2,
            'valore' => 'Loading...',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.titolo.1',
            'id_lingua' => 1,
            'valore' => 'Accedi',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.titolo.1',
            'id_lingua' => 2,
            'valore' => 'Sign in',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.titolo.2',
            'id_lingua' => 1,
            'valore' => 'allo streaming',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.titolo.2',
            'id_lingua' => 2,
            'valore' => 'to streaming',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.utente.label',
            'id_lingua' => 1,
            'valore' => 'Utente',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.utente.label',
            'id_lingua' => 2,
            'valore' => 'User',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.utente.placeholder',
            'id_lingua' => 1,
            'valore' => 'Inserisci la tua email',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.utente.placeholder',
            'id_lingua' => 2,
            'valore' => 'Enter your email',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.password.placeholder',
            'id_lingua' => 1,
            'valore' => 'Inserisci la tua password',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.password.placeholder',
            'id_lingua' => 2,
            'valore' => 'Enter your password',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.password.error',
            'id_lingua' => 1,
            'valore' => 'La password deve essere tra i 6 e i 20 caratteri.',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.password.error',
            'id_lingua' => 2,
            'valore' => 'The password must be between 6 and 20 characters.',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.utente.error',
            'id_lingua' => 1,
            'valore' => 'Inserisci una email corretta tra i 5 e i 40 caratteri.',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.utente.error',
            'id_lingua' => 2,
            'valore' => 'Enter a valid email between 5 and 40 characters.s',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.collegato',
            'id_lingua' => 1,
            'valore' => 'Resta collegato',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.collegato',
            'id_lingua' => 2,
            'valore' => 'Keep me signed in',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.bottone.label',
            'id_lingua' => 1,
            'valore' => 'Accedi',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.accesso.bottone.label',
            'id_lingua' => 2,
            'valore' => 'Sign in',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.menu_utente.profilo.label',
            'id_lingua' => 1,
            'valore' => 'profilo',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.menu_utente.profilo.label',
            'id_lingua' => 2,
            'valore' => 'profile',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.menu_utente.scollegati.label',
            'id_lingua' => 1,
            'valore' => 'scollegati',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.menu_utente.scollegati.label',
            'id_lingua' => 2,
            'valore' => 'log out',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.menu_utente.collegati.label',
            'id_lingua' => 1,
            'valore' => 'Accedi',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.menu_utente.collegati.label',
            'id_lingua' => 2,
            'valore' => 'Login',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.menu_utente.contattaci.label',
            'id_lingua' => 1,
            'valore' => 'contattaci',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.menu_utente.contattaci.label',
            'id_lingua' => 2,
            'valore' => 'contact us',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.scheda.anno.label',
            'id_lingua' => 1,
            'valore' => 'anno',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.anno.label',
            'id_lingua' => 2,
            'valore' => 'year',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.durata.label',
            'id_lingua' => 1,
            'valore' => 'durata',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.durata.label',
            'id_lingua' => 2,
            'valore' => 'duration',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.regista.label',
            'id_lingua' => 1,
            'valore' => 'regista',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.regista.label',
            'id_lingua' => 2,
            'valore' => 'director',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.riprendi.label',
            'id_lingua' => 1,
            'valore' => 'riprendi visione',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.riprendi.label',
            'id_lingua' => 2,
            'valore' => 'resume watching',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.riproduci.label',
            'id_lingua' => 1,
            'valore' => 'riproduci',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.riproduci.label',
            'id_lingua' => 2,
            'valore' => 'play',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.trailer.label',
            'id_lingua' => 1,
            'valore' => 'trailer',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.trailer.label',
            'id_lingua' => 2,
            'valore' => 'trailer',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.riprendi.title',
            'id_lingua' => 1,
            'valore' => 'riprendi la visione di: {{title}}',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.riprendi.title',
            'id_lingua' => 2,
            'valore' => 'resume watching: {{title}}',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.riproduci.title',
            'id_lingua' => 1,
            'valore' => 'riproduci dall\'inizio: {{title}}',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.riproduci.title',
            'id_lingua' => 2,
            'valore' => 'play from start: {{title}}',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.trailer.title',
            'id_lingua' => 1,
            'valore' => 'guarda il trailer di: {{title}}',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.trailer.title',
            'id_lingua' => 2,
            'valore' => 'watch the trailer: {{title}}',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.stagione.label',
            'id_lingua' => 1,
            'valore' => 'stagione',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.stagione.label',
            'id_lingua' => 2,
            'valore' => 'season',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.episodio.label',
            'id_lingua' => 1,
            'valore' => 'episodio',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.episodio.label',
            'id_lingua' => 2,
            'valore' => 'episode',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.numero_episodi.label',
            'id_lingua' => 1,
            'valore' => 'episodi totali',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.numero_episodi.label',
            'id_lingua' => 2,
            'valore' => 'total episodes',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.numero_stagioni.label',
            'id_lingua' => 1,
            'valore' => 'numero di stagioni',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.scheda.numero_stagioni.label',
            'id_lingua' => 2,
            'valore' => 'number of seasons',
        ]);






        TraduzioneModel::create([
            'chiave' => 'ui.tipi_contenuto.film_serie.label',
            'id_lingua' => 1,
            'valore' => 'film e serie',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tipi_contenuto.film_serie.label',
            'id_lingua' => 2,
            'valore' => 'movies & series',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tipi_contenuto.film.label',
            'id_lingua' => 1,
            'valore' => 'solo film',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tipi_contenuto.film.label',
            'id_lingua' => 2,
            'valore' => 'only movies',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tipi_contenuto.serie.label',
            'id_lingua' => 1,
            'valore' => 'solo serie',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tipi_contenuto.serie.label',
            'id_lingua' => 2,
            'valore' => 'only series',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.titolo_locandina.alt',
            'id_lingua' => 1,
            'valore' => 'titolo: {{title}}',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.titolo_locandina.alt',
            'id_lingua' => 2,
            'valore' => 'title: {{title}}',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.footer.privacy.label',
            'id_lingua' => 1,
            'valore' => 'Privacy e cookie policy',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.footer.privacy.label',
            'id_lingua' => 2,
            'valore' => 'Privacy & Cookies Policy',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.footer.privacy.title',
            'id_lingua' => 1,
            'valore' => 'Leggi l’informativa',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.footer.privacy.title',
            'id_lingua' => 2,
            'valore' => 'Read the policy',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.footer.contatti.label',
            'id_lingua' => 1,
            'valore' => 'Vedi i nostri contatti',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.footer.contatti.label',
            'id_lingua' => 2,
            'valore' => 'See our contact',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.footer.contatti.title',
            'id_lingua' => 1,
            'valore' => 'Vedi contatti',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.footer.contatti.title',
            'id_lingua' => 2,
            'valore' => 'View contacts',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.audio.unmute.title',
            'id_lingua' => 1,
            'valore' => 'attiva audio',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.audio.unmute.title',
            'id_lingua' => 2,
            'valore' => 'unmute audio',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.audio.mute.title',
            'id_lingua' => 1,
            'valore' => 'disattiva audio',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.audio.mute.title',
            'id_lingua' => 2,
            'valore' => 'mute audio',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.favorites.add.title',
            'id_lingua' => 1,
            'valore' => 'aggiungi ai preferiti',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.favorites.add.title',
            'id_lingua' => 2,
            'valore' => 'add to favourites',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.favorites.remove.title',
            'id_lingua' => 1,
            'valore' => 'rimuovi dai preferiti',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.favorites.remove.title',
            'id_lingua' => 2,
            'valore' => 'remove favourite',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.play.title',
            'id_lingua' => 1,
            'valore' => 'vai alla pagina “{{title}}”',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.tooltips.play.title',
            'id_lingua' => 2,
            'valore' => 'go to page “{{title}}”',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.carosello_due.scroll.title',
            'id_lingua' => 1,
            'valore' => 'scorri carosello',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.carosello_due.scroll.title',
            'id_lingua' => 2,
            'valore' => 'scroll carousel',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.search.title.label',
            'id_lingua' => 1,
            'valore' => 'cerca',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.search.title.label',
            'id_lingua' => 2,
            'valore' => 'search',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.search.placeholder.title',
            'id_lingua' => 1,
            'valore' => 'cerca',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.search.placeholder.title',
            'id_lingua' => 2,
            'valore' => 'search',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.header.categorie.label',
            'id_lingua' => 1,
            'valore' => 'le nostre categorie',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.header.categorie.label',
            'id_lingua' => 2,
            'valore' => 'our categories',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.catalogue.menutooltip.title',
            'id_lingua' => 1,
            'valore' => 'categorie',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.catalogue.menutooltip.title',
            'id_lingua' => 2,
            'valore' => 'categories',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.catalogue.filmreelalt.alt',
            'id_lingua' => 1,
            'valore' => 'pellicola',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.catalogue.filmreelalt.alt',
            'id_lingua' => 2,
            'valore' => 'film reel',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.audio.disattiva.label',
            'id_lingua' => 1,
            'valore' => 'disattiva audio',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.audio.disattiva.label',
            'id_lingua' => 2,
            'valore' => 'mute audio',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.audio.attiva.label',
            'id_lingua' => 1,
            'valore' => 'attiva audio',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.audio.attiva.label',
            'id_lingua' => 2,
            'valore' => 'unmute audio',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_1.icon.alt',
            'id_lingua' => 1,
            'valore' => 'Icona dispositivi',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_1.icon.alt',
            'id_lingua' => 2,
            'valore' => 'Devices icon',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_1',
            'id_lingua' => 1,
            'valore' => 'Guarda ovunque, su tutti i tuoi dispositivi',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_1',
            'id_lingua' => 2,
            'valore' => 'Stream anywhere, on all your devices',
        ]);

        TraduzioneModel::create([
            'chiave' => 'ui.cta_2.icon.alt',
            'id_lingua' => 1,
            'valore' => 'Icona stelle',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_2.icon.alt',
            'id_lingua' => 2,
            'valore' => 'Stars icon',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_2',
            'id_lingua' => 1,
            'valore' => 'Film e serie in anteprima, da 5 stelle',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_2',
            'id_lingua' => 2,
            'valore' => 'Unreleased 5-star movies and series',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_3.icon.alt',
            'id_lingua' => 1,
            'valore' => 'Icona pellicola',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_3.icon.alt',
            'id_lingua' => 2,
            'valore' => 'Film reel icon',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_3',
            'id_lingua' => 1,
            'valore' => 'Oltre 10 categorie scientifiche da esplorare',
        ]);
        TraduzioneModel::create([
            'chiave' => 'ui.cta_3',
            'id_lingua' => 2,
            'valore' => 'Over 10 scientific categories to explore',
        ]);

        // UTENTE BANNATO
        TraduzioneModel::create([
            'chiave'    => 'ui.toast.error.login.bannato',
            'id_lingua' => 1,
            'valore'    => 'Ti sono stati tolti i permessi per accedere, contatta l amministratore.',
        ]);

        TraduzioneModel::create([
            'chiave'    => 'ui.toast.error.login.bannato',
            'id_lingua' => 2,
            'valore'    => 'Your access permissions have been revoked, please contact the administrator.',
        ]);

        // PASSWORD / NOME UTENTE NON TROVATA
        TraduzioneModel::create([
            'chiave'    => 'ui.toast.error.login.mancante',
            'id_lingua' => 1,
            'valore'    => 'Password o nome utente non trovato sul database.',
        ]);

        TraduzioneModel::create([
            'chiave'    => 'ui.toast.error.login.mancante',
            'id_lingua' => 2,
            'valore'    => 'Password or username not found in the database.',
        ]);

        // LIMITE TENTATIVI TERMINATI
        TraduzioneModel::create([
            'chiave'    => 'ui.toast.error.login.max_acces',
            'id_lingua' => 1,
            'valore'    => 'Hai terminato i tentativi di accesso, riprova piu tardi.',
        ]);

        TraduzioneModel::create([
            'chiave'    => 'ui.toast.error.login.max_acces',
            'id_lingua' => 2,
            'valore'    => 'You have reached the maximum number of login attempts, please try again later.',
        ]);

        // PASSWORD DEPRECATA / SCADUTA
        TraduzioneModel::create([
            'chiave'    => 'ui.toast.erro.login.password_deprecata',
            'id_lingua' => 1,
            'valore'    => 'Hai inserito una password deprecata. Cambiala ora.',
        ]);

        TraduzioneModel::create([
            'chiave'    => 'ui.toast.erro.login.password_deprecata',
            'id_lingua' => 2,
            'valore'    => 'You have entered a deprecated password. Please change it now.',
        ]);




            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.bentornato',
                'id_lingua' => 1,
                'valore'    => '\nBENTORNATO!\n\nLa tua precedente sessione è scaduta,\nripeti l\'accesso e riprendi la visione dei tuoi contenuti preferiti\n\n',
            ]);

            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.bentornato',
                'id_lingua' => 2,
                'valore'    => '\nWELCOME BACK!\n\nYour previous session has expired,\nplease sign in again to resume watching your favorite content\n\n',
            ]);

            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.scollegato',
                'id_lingua' => 1,
                'valore'    => 'La sessione che non hai collegato in fase di accesso è scaduta.',
            ]);

            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.scollegato',
                'id_lingua' => 2,
                'valore'    => 'The session you did not link during sign-in has expired.',
            ]);
            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.collegato',
                'id_lingua' => 1,
                'valore'    => 'La sessione che avevi collegato in fase di accesso è scaduta.',
            ]);

            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.collegato',
                'id_lingua' => 2,
                'valore'    => 'The session you linked during sign-in has expired.',
            ]);
            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.inattivita',
                'id_lingua' => 1,
                'valore'    => 'La tua sessione è scaduta per inattivita.',
            ]);

            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.inattivita',
                'id_lingua' => 2,
                'valore'    => 'Your session has expired due to inactivity.',
            ]);
            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.generico',
                'id_lingua' => 1,
                'valore'    => 'La tua sessione è scaduta.',
            ]);

            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.generico',
                'id_lingua' => 2,
                'valore'    => 'Your session has expired.',
            ]);
            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.link',
                'id_lingua' => 1,
                'valore'    => 'Ripeti l\'accesso',
            ]);

            TraduzioneModel::create([
                'chiave'    => 'ui.toast.sessione.link',
                'id_lingua' => 2,
                'valore'    => 'Repeat sign in',
            ]);
    }
}
