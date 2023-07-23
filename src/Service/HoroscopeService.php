<?php

namespace App\Service;

class HoroscopeService
{
    // Méthode pour récupérer l'horoscope hebdomadaire pour un signe du zodiaque spécifique depuis l'API RSS
    public function getHoroscope($slug)
    {
        $url = 'https://www.asiaflash.com/horoscope/rss_hebdotay_complet_' . $slug . '.xml';

        // Récupérer le contenu du flux RSS
        $rssContent = file_get_contents($url);

        // Vérifier si le contenu a été récupéré correctement
        if ($rssContent === false) {
            throw new \Exception('Impossible de récupérer le contenu du flux RSS.');
        }

        // Créer un objet SimpleXMLElement pour parcourir le contenu XML
        $rss = new \SimpleXMLElement($rssContent);

        // Récupérer les informations de l'horoscope pour le signe donné (titre, description, etc.)
        $horoscopeData = [];
        foreach ($rss->channel->item as $item) {
            $horoscopeData[] = [
                'title' => $this->extractHoroscopeTitle((string) $item->title),
                'description' => (string) $item->description,
                'link' => (string) $item->link,
                'pubDate' => (string) $item->pubDate,
            ];
        }

        return $horoscopeData;
    }

    // Fonction pour extraire uniquement la période depuis la balise <title> de l'horoscope
    private function extractHoroscopeTitle(string $fullTitle): string
    {
        $pattern = '/(\b(?:Lundi|Mardi|Mercredi|Jeudi|Vendredi|Samedi|Dimanche)\s\d{1,2}\s--\s(?:Lundi|Mardi|Mercredi|Jeudi|Vendredi|Samedi|Dimanche)\s\d{1,2}\s(?:Janvier|Février|Mars|Avril|Mai|Juin|Juillet|Août|Septembre|Octobre|Novembre|Décembre)\s\d{4})/';
        preg_match($pattern, $fullTitle, $matches);

        return $matches[0] ?? 'Période indéterminée';
    }
}
