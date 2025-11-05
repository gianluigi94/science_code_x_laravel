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
    'valore' => 'privacy e cookie policy',
]);
TraduzioneModel::create([
    'chiave' => 'ui.footer.privacy.label',
    'id_lingua' => 2,
    'valore' => 'privacy & cookies policy',
]);
TraduzioneModel::create([
    'chiave' => 'ui.footer.privacy.title',
    'id_lingua' => 1,
    'valore' => 'leggi l’informativa',
]);
TraduzioneModel::create([
    'chiave' => 'ui.footer.privacy.title',
    'id_lingua' => 2,
    'valore' => 'read the policy',
]);
TraduzioneModel::create([
    'chiave' => 'ui.footer.contatti.label',
    'id_lingua' => 1,
    'valore' => 'vedi i nostri contatti',
]);
TraduzioneModel::create([
    'chiave' => 'ui.footer.contatti.label',
    'id_lingua' => 2,
    'valore' => 'see our contact',
]);
TraduzioneModel::create([
    'chiave' => 'ui.footer.contatti.title',
    'id_lingua' => 1,
    'valore' => 'vedi contatti',
]);
TraduzioneModel::create([
    'chiave' => 'ui.footer.contatti.title',
    'id_lingua' => 2,
    'valore' => 'view contacts',
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



    }
}
